## DeepSeek 32b微调
- 操作系统Ubuntu 22.04 LTS
- 显卡：双RTX 3090 24GB
- 内存：128G
- CPU：Intel(R) Core(TM) i9-14900K
- Ollama私有化部署deepseek:32b
- 准备python 3.10环境
	- 安装python 3.10

			sudo apt install python3.10
	- 创建隔离虚拟环境

			# 安装虚拟环境工具
			sudo apt install python3.10-venv
			
			# 创建并激活环境
			python3 -m venv ~/deepseek-env
			source ~/deepseek-env/bin/activate  # 激活后提示符会变化
- NVIDIA驱动与CUDA 12.2安装
	- 安装NVIDIA驱动（推荐版本535+）

			# 添加官方驱动仓库
			sudo add-apt-repository ppa:graphics-drivers/ppa
			sudo apt update
			
			# 安装驱动（适配CUDA 12.2）
			sudo apt install nvidia-driver-535 nvidia-dkms-535
			
			# 重启后验证
			sudo reboot
			nvidia-smi  # 应显示2张3090，驱动版本≥535.113.01
	- 安装CUDA 12.2工具包

			# 下载官方安装包（Linux x86_64）https://developer.nvidia.com/cuda-12-4-0-download-archive?target_os=Linux&target_arch=x86_64&Distribution=Ubuntu&target_version=22.04&target_type=runfile_local
			wget https://developer.download.nvidia.com/compute/cuda/12.4.0/local_installers/cuda_12.4.0_550.54.14_linux.run
			
			# 运行安装程序（关键选项）
			sudo sh cuda_12.4.0_550.54.14_linux.run
	- 配置环境变量

			# 编辑bashrc
			echo 'export PATH=/usr/local/cuda-12.4/bin:$PATH' >> ~/.bashrc
			echo 'export LD_LIBRARY_PATH=/usr/local/cuda-12.4/lib64:$LD_LIBRARY_PATH' >> ~/.bashrc
			source ~/.bashrc
			
			# 验证CUDA
			nvcc --version  # 应输出12.4
	- 安装cuDNN 9（适配CUDA 12.4）

			# 从NVIDIA官网下载.deb包，https://developer.download.nvidia.com/compute/cuda/repos/ubuntu2204/x86_64/
			# 假设已下载到本地，执行安装
			sudo dpkg -i libcudnn9-cuda-12_9.8.0.87-1_amd64.deb
			sudo dpkg -i libcudnn9-dev-cuda-12_9.8.0.87-1_amd64.deb
			
			# 验证安装
			cat /usr/include/cudnn_version.h | grep CUDNN_MAJOR -A 2  # 应显示 9
- PyTorch与依赖库适配
	- 安装PyTorch（CUDA 12.4版本）

			# 在虚拟环境中执行（需先激活环境），source ~/deepseek-env/bin/activate
			pip3 install torch torchvision torchaudio --index-url https://download.pytorch.org/whl/cu124
	- 环境验证

			# python3
			Python 3.10.12 (main, Aug 12 2022, 10:02:14) [GCC 11.2.0] on linux
			Type "help", "copyright", "credits" or "license" for more information.
			>>> import torch
			>>> print(torch.__version__)   
			2.6.0+cu124
			>>> print(torch.cuda.is_available())
			True
			>>> print(torch.version.cuda) 
			12.4
			>>> 
- 准备训练集与验证集
	- 训练集
	- 验证集
		- 验证集的根本意义在于评估模型对未见过但同分布数据的处理能力，而不是简单检查答案是否正确。
		- 验证集的三大核心意义
		<table>
		<tr>
			<th>维度</th>	
			<th>作用机制</th>
			<th>您的案例说明</th>
		</tr>
		<tr>
			<td>泛化能力评估</td>
			<td>测试模型对同类问题不同表述的理解能力</td>
			<td>即使训练集没有"紫家峪水库的建成月"这条记录，但如果有其他水库的建成月数据，模型应能推断回答格式（数值+单位）</td>
		</tr>
		<tr>
			<td>过拟合检测</td>
			<td>监控训练损失与验证损失的差异</td>
			<td>如果训练集准确率100%但验证集只有60%，表明模型死记硬背而非真正理解数据结构</td>
		</tr>
		<tr>
			<td>超参数调优</td>
			<td>通过验证集表现选择最佳学习率、批次大小等参数</td>
			<td>对比不同学习率(1e-5 vs 3e-5)在验证集上的表现，选择泛化性更好的参数</td>
		</tr>
		</table>
- 完整训练脚本

		#!/usr/bin/env python3
		import os
		os.environ["TOKENIZERS_PARALLELISM"] = "false"  # 禁用tokenizer并行
		os.environ["NCCL_P2P_DISABLE"] = "1"           # 提升3090多卡稳定性
		
		import re
		import json
		import torch
		from datetime import datetime
		from datasets import load_dataset
		from transformers import (
		    AutoModelForCausalLM,
		    AutoTokenizer,
		    Trainer,
		    TrainingArguments,
		    DataCollatorForLanguageModeling,
		    set_seed,
		)
		from peft import LoraConfig, get_peft_model
		from sklearn.metrics import accuracy_score
		
		# ====================== 配置区（根据需求调整） ======================
		MODEL_NAME = "deepseek-ai/deepseek-32b"      # 基础模型
		DATA_PATHS = {
		    "train": "./train.jsonl",
		    "val": "./val.jsonl"
		}
		OUTPUT_DIR = f"./output-{datetime.now().strftime('%Y%m%d-%H%M')}"  # 动态输出目录
		
		# LoRA配置（针对数值型问答优化）
		LORA_CONFIG = LoraConfig(
		    r=32,                    # 秩维度（24GB显存可支持较大值）
		    lora_alpha=64,           # 缩放因子（通常为2*r）
		    target_modules=["q_proj", "v_proj", "k_proj", "o_proj"],  # 适配更多层
		    lora_dropout=0.05,
		    bias="none",
		    task_type="CAUSAL_LM",
		)
		
		# 训练参数（双3090优化）
		TRAIN_ARGS = {
		    "per_device_train_batch_size": 6,    # 每卡batch_size
		    "per_device_eval_batch_size": 12,    # 验证时batch_size翻倍
		    "gradient_accumulation_steps": 4,    # 总batch_size=6*2*4=48
		    "learning_rate": 2e-5,               # 数值型任务建议稍高学习率
		    "num_train_epochs": 8,               # 小数据集需要更多epoch
		    "weight_decay": 0.01,
		    "warmup_ratio": 0.05,
		    "logging_steps": 10,
		    "eval_steps": 50,
		    "save_steps": 200,
		    "bf16": True,                        # 3090必须启用BF16
		    "tf32": True,                        # 启用TF32加速
		    "gradient_checkpointing": True,      # 显存优化
		    "deepspeed": "./ds_config.json",     # DeepSpeed配置文件
		    "report_to": ["tensorboard"],
		    "dataloader_num_workers": 24,        # 利用i9-14900K 24核
		}
		
		# ========================== 核心逻辑 ==========================
		class CustomTrainer(Trainer):
		    def compute_metrics(self, eval_pred):
		        """自定义数值准确率计算"""
		        preds, labels = eval_pred
		        # 仅计算assistant部分的预测
		        preds = preds.argmax(-1)
		        
		        # 生成文本并提取数值
		        num_correct = 0
		        for i in range(preds.shape[0]):
		            pred_text = self.tokenizer.decode(preds[i], skip_special_tokens=True)
		            true_text = self.tokenizer.decode(labels[i], skip_special_tokens=True)
		            
		            # 使用正则提取数值
		            pred_num = re.findall(r"\d+\.?\d*", pred_text)
		            true_num = re.findall(r"\d+\.?\d*", true_text)
		            
		            if pred_num and true_num:
		                try:
		                    if abs(float(pred_num[0]) - float(true_num[0])) < 1e-4:
		                        num_correct +=1
		                except:
		                    pass
		        return {"num_acc": num_correct/preds.shape[0]}
		
		def main():
		    # 初始化设置
		    set_seed(42)
		    
		    # ================ 数据预处理 ================
		    # 加载数据集
		    dataset = load_dataset("json", data_files=DATA_PATHS)
		    
		    # 添加特殊token
		    tokenizer = AutoTokenizer.from_pretrained(
		        MODEL_NAME,
		        trust_remote_code=True,
		        use_fast=True,
		    )
		    tokenizer.add_special_tokens({
		        "additional_special_tokens": ["<|user|>", "<|assistant|>"]
		    })
		    
		    # 数据格式化函数
		    def format_conversation(examples):
		        texts = []
		        for conv in examples["conversations"]:
		            text = ""
		            for turn in conv:
		                role = "<|user|>" if turn["role"] == "user" else "<|assistant|>"
		                text += f"{role}\n{turn['content']}\n"
		            texts.append(text.strip())
		        return {"text": texts}
		    
		    # 应用格式化
		    dataset = dataset.map(
		        format_conversation,
		        batched=True,
		        remove_columns=["conversations"],
		        num_proc=24  # 利用多核CPU
		    )
		    
		    # Tokenization
		    def tokenize_func(examples):
		        tokenized = tokenizer(
		            examples["text"],
		            truncation=True,
		            max_length=1024,
		            padding="max_length",
		            return_offsets_mapping=True
		        )
		        
		        # 创建loss mask（只计算assistant部分）
		        labels = tokenized["input_ids"].copy()
		        assistant_token = tokenizer.encode("<|assistant|>", add_special_tokens=False)[0]
		        
		        for i in range(len(labels)):
		            positions = [idx for idx, tid in enumerate(tokenized.input_ids[i]) 
		                        if tid == assistant_token]
		            if positions:
		                start = positions[-1] + 1
		                labels[i][:start] = [-100] * start
		            else:
		                labels[i] = [-100] * len(labels[i])
		        
		        tokenized["labels"] = labels
		        return tokenized
		    
		    tokenized_dataset = dataset.map(
		        tokenize_func,
		        batched=True,
		        num_proc=24,
		        remove_columns=["text"]
		    )
		
		    # ================ 模型配置 ================
		    # 加载基础模型
		    model = AutoModelForCausalLM.from_pretrained(
		        MODEL_NAME,
		        torch_dtype=torch.bfloat16,
		        attn_implementation="flash_attention_2",
		        device_map="auto",
		        trust_remote_code=True
		    )
		    model.resize_token_embeddings(len(tokenizer))  # 适配新增token
		    
		    # 应用LoRA
		    model = get_peft_model(model, LORA_CONFIG)
		    model.print_trainable_parameters()
		    
		    # ================ 训练配置 ================
		    # 数据收集器
		    data_collator = DataCollatorForLanguageModeling(
		        tokenizer=tokenizer,
		        mlm=False
		    )
		    
		    # 训练参数
		    training_args = TrainingArguments(
		        output_dir=OUTPUT_DIR,
		        **TRAIN_ARGS,
		        evaluation_strategy="steps",
		        load_best_model_at_end=True,
		        metric_for_best_model="num_acc",
		        greater_is_better=True,
		    )
		    
		    # 初始化Trainer
		    trainer = CustomTrainer(
		        model=model,
		        args=training_args,
		        train_dataset=tokenized_dataset["train"],
		        eval_dataset=tokenized_dataset["val"],
		        data_collator=data_collator,
		        tokenizer=tokenizer,
		    )
		    
		    # 开始训练
		    trainer.train()
		    
		    # 保存最终模型
		    trainer.save_model(f"{OUTPUT_DIR}/final_model")
		
		if __name__ == "__main__":
		    main()
- DeepSpeed配置文件 `ds_config.json`

		{
		  "train_batch_size": "auto",
		  "train_micro_batch_size_per_gpu": "auto",
		  "gradient_accumulation_steps": "auto",
		  "steps_per_print": 50,
		  "bf16": {
		    "enabled": true
		  },
		  "zero_optimization": {
		    "stage": 3,
		    "offload_optimizer": {
		      "device": "cpu",
		      "pin_memory": true
		    },
		    "offload_param": {
		      "device": "cpu",
		      "pin_memory": true
		    },
		    "overlap_comm": true,
		    "contiguous_gradients": true,
		    "reduce_bucket_size": 1e8,
		    "stage3_prefetch_bucket_size": 2e8,
		    "stage3_param_persistence_threshold": 1e5
		  },
		  "flops_profiler": {
		    "enabled": true,
		    "profile_step": 100
		  }
		}
- 启动训练
	- 设置优化参数

			export NCCL_ALGO=Tree
			export CUDA_LAUNCH_BLOCKING=1
			export OMP_NUM_THREADS=24

	- 启动命令

			CUDA_VISIBLE_DEVICES=0,1 deepspeed --num_gpus 2 --master_port 29501 \
			  train.py \
			  --deepspeed ds_config.json 
- 实时监控
	- GPU监控（新终端）

			watch -n 1 "nvidia-smi --query-gpu=utilization.gpu,memory.used,power.draw --format=csv"

	- 训练指标跟踪（新终端）

			tensorboard --logdir=./output-*/runs --port 6006 --bind_all

	- 精度监控（新终端）

			tail -f ./output-*/trainer_log.jsonl | jq 'select(.eval_num_acc != null) | {step, eval_loss, eval_num_acc}'