## 私有化部署DeepSeek
- 准备好Ubuntu操作系统
- 安装ollama
	- https://github.com/ollama/ollama
	- `curl -fsSL https://ollama.com/install.sh | sh`
- 安装deepseek-r1:671b
	- `ollama run deepseek-r1:671b`
- 查看本地模型列表

		# ollama list
		NAME              ID              SIZE      MODIFIED     
		deepseek-r1:8b    28f8fd6cdc67    4.9 GB    22 hours ago
- 部署会话客户端Chatbot-Next-Web
	- 需要先安装node、yarn。
		- 安装新版本node
			- `curl -sL https://deb.nodesource.com/setup_20.x -o /tmp/nodesource_setup.sh`
			- `sudo bash /tmp/nodesource_setup.sh`
			- 查看node版本
			
					# node -v
					v20.18.3
		- 安装yarn

				npm install --global yarn
				# yarn --version
				1.22.22

	- https://github.com/ChatGPTNextWeb/NextChat

			git clone https://github.com/ChatGPTNextWeb/ChatGPT-Next-Web
			cd ChatGPT-Next-Web
	- 配置环境变量

			# vim .env.local 
			OPENAI_API_KEY=ollama
			BASE_URL=http://localhost:11434
			CUSTOM_MODELS=+deepseek-r1:8b
			DEFAULT_MODEL=deepseek-r1:8b
			DEFAULT_INPUT_TEMPLATE=human:{prompt}\nassistant:
			#HIDE_USER_API_KEY=1
			DISABLE_GPT4=1
	- 开发模式下，安装并运行

			yarn install && yarn dev
