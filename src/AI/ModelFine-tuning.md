## DeepSeek 32b微调
- 操作系统Ubuntu 22.04 LTS
- 显卡：双RTX 3090 24GB
- Ollama私有化部署deepseek:32b
- 准备python 3.11环境
	- 安装python 3.11

			sudo apt install python3.11
			# 创建Python 3.11的符号链接
			sudo update-alternatives --install /usr/bin/python3 python3 /usr/bin/python3.10 1  # 保留系统默认
			sudo update-alternatives --install /usr/bin/python3 python3 /usr/bin/python3.11 2  # 添加新版本
			
			# 切换默认Python版本
			sudo update-alternatives --config python3  # 输入选择编号（例如2）
	- 创建隔离虚拟环境

			# 安装虚拟环境工具
			sudo apt install python3.11-venv
			
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
			Python 3.11.0rc1 (main, Aug 12 2022, 10:02:14) [GCC 11.2.0] on linux
			Type "help", "copyright", "credits" or "license" for more information.
			>>> import torch
			>>> print(torch.__version__)   
			2.6.0+cu124
			>>> print(torch.cuda.is_available())
			True
			>>> print(torch.version.cuda) 
			12.4
			>>> 
