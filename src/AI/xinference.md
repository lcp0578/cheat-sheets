##  Xorbits Inference (Xinference) 开源模型平台

#### xinference
- Xorbits Inference (Xinference) 是一个开源平台，用于简化各种 AI 模型的运行和集成。借助 Xinference，您可以使用任何开源 LLM、嵌入模型和多模态模型在云端或本地环境中运行推理，并创建强大的 AI 应用。
- 设置PyPI镜像源

		pip config set global.index-url https://mirrors.aliyun.com/pypi/simple/
- 安装命令

		pip install "xinference[all]"
- 分步安装
	- 安装核心库。首先，只安装不包含复杂后端依赖的核心 Xinference 包。

			pip install xinference -i https://mirrors.aliyun.com/pypi/simple/
	- 按需安装后端。然后，根据您计划使用的模型，选择性地安装一个或多个后端。
		- 安装 Transformers 后端 (支持大多数常见模型)

				pip install "xinference[transformers]" -i https://mirrors.aliyun.com/pypi/simple/

		- 如果需要 vLLM 后端 (用于高性能推理)

				pip install "xinference[vllm]" -i https://mirrors.aliyun.com/pypi/simple/

		- 如果您需要 GGML 格式的模型

				pip install "xinference[ggml]" -i https://mirrors.aliyun.com/pypi/simple/
		- 如果您需要特定的嵌入模型，可以按需安装

				pip install "xinference[embedding]" -i https://mirrors.aliyun.com/pypi/simple/
- 配置XINFERENCE_HOME
	- `vim ~/.bashrc`

			export XINFERENCE_HOME=/home/main_data/Xinference
	- `source ~/.bashrc`

- 使用命令启动

		# XINFERENCE_MODEL_SRC=modelscope xinference-local -H 0.0.0.0 --port 9997
		/usr/local/lib/python3.10/dist-packages/torch/cuda/__init__.py:63: FutureWarning: The pynvml package is deprecated. Please install nvidia-ml-py instead. If you did not install pynvml directly, please report this to the maintainers of the package that installed pynvml for you.
		  import pynvml  # type: ignore[import]
		/usr/local/lib/python3.10/dist-packages/torch/cuda/__init__.py:63: FutureWarning: The pynvml package is deprecated. Please install nvidia-ml-py instead. If you did not install pynvml directly, please report this to the maintainers of the package that installed pynvml for you.
		  import pynvml  # type: ignore[import]
		2025-11-28 18:47:12,521 xinference.core.supervisor 124924 INFO     Xinference supervisor 0.0.0.0:54882 started
		2025-11-28 18:47:12,547 xinference.core.worker 124924 INFO     Starting metrics export server at 0.0.0.0:None
		2025-11-28 18:47:12,549 xinference.core.worker 124924 INFO     Checking metrics export server...
		2025-11-28 18:47:13,844 xinference.deploy.local 124803 INFO     No response from process after 10 seconds
		2025-11-28 18:47:14,489 xinference.core.worker 124924 INFO     Metrics server is started at: http://0.0.0.0:31841
		2025-11-28 18:47:14,489 xinference.core.worker 124924 INFO     Purge cache directory: /home/main_data/Xinference/cache
		2025-11-28 18:47:14,491 xinference.core.worker 124924 INFO     Connected to supervisor as a fresh worker
		2025-11-28 18:47:14,514 xinference.core.worker 124924 INFO     Xinference worker 0.0.0.0:54882 started
		2025-11-28 18:47:21,079 xinference.api.restful_api 124803 INFO     Starting Xinference at endpoint: http://0.0.0.0:9997
		2025-11-28 18:47:21,250 uvicorn.error 124803 INFO     Uvicorn running on http://0.0.0.0:9997 (Press CTRL+C to quit)
