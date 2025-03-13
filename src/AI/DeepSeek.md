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
	- 正式部署

			yarn install && yarn build && yarn start
	- 也使用pm2守护进程
		- 启动应用

				# pm2 start "yarn start" --name nextchat-prod 
				
				                        -------------
				
				__/\\\\\\\\\\\\\____/\\\\____________/\\\\____/\\\\\\\\\_____
				 _\/\\\/////////\\\_\/\\\\\\________/\\\\\\__/\\\///////\\\___
				  _\/\\\_______\/\\\_\/\\\//\\\____/\\\//\\\_\///______\//\\\__
				   _\/\\\\\\\\\\\\\/__\/\\\\///\\\/\\\/_\/\\\___________/\\\/___
				    _\/\\\/////////____\/\\\__\///\\\/___\/\\\________/\\\//_____
				     _\/\\\_____________\/\\\____\///_____\/\\\_____/\\\//________
				      _\/\\\_____________\/\\\_____________\/\\\___/\\\/___________
				       _\/\\\_____________\/\\\_____________\/\\\__/\\\\\\\\\\\\\\\_
				        _\///______________\///______________\///__\///////////////__
				
				
				                          Runtime Edition
				
				        PM2 is a Production Process Manager for Node.js applications
				                     with a built-in Load Balancer.
				
				                Start and Daemonize any application:
				                $ pm2 start app.js
				
				                Load Balance 4 instances of api.js:
				                $ pm2 start api.js -i 4
				
				                Monitor in production:
				                $ pm2 monitor
				
				                Make pm2 auto-boot at server restart:
				                $ pm2 startup
				
				                To go further checkout:
				                http://pm2.io/
				
				
				                        -------------
				
				[PM2] Spawning PM2 daemon with pm2_home=/root/.pm2
				[PM2] PM2 Successfully daemonized
				[PM2] Starting /usr/bin/bash in fork_mode (1 instance)
				[PM2] Done.
				┌────┬────────────────────┬──────────┬──────┬───────────┬──────────┬──────────┐
				│ id │ name               │ mode     │ ↺    │ status    │ cpu      │ memory   │
				├────┼────────────────────┼──────────┼──────┼───────────┼──────────┼──────────┤
				│ 0  │ nextchat-prod      │ fork     │ 0    │ online    │ 0%       │ 29.8mb   │
				└────┴────────────────────┴──────────┴──────┴───────────┴──────────┴──────────┘
	
		- 查看应用日志


				# pm2 logs nextchat-prod
				[TAILING] Tailing last 15 lines for [nextchat-prod] process (change the value with --lines option)
				/root/.pm2/logs/nextchat-prod-out.log last 15 lines:
				0|nextchat | $ next start
				0|nextchat |    ▲ Next.js 14.1.1
				0|nextchat |    - Local:        http://localhost:3000
				0|nextchat | 
				0|nextchat | [Next] build mode standalone
				0|nextchat | [Next] build with chunk:  true
				0|nextchat | info Visit https://yarnpkg.com/en/docs/cli/run for documentation about this command.
				0|nextchat | yarn run v1.22.22
				0|nextchat | $ next start
				0|nextchat |    ▲ Next.js 14.1.1
				0|nextchat |    - Local:        http://localhost:3000
				0|nextchat | 
				0|nextchat | [Next] build mode standalone
				0|nextchat | [Next] build with chunk:  true
				0|nextchat | info Visit https://yarnpkg.com/en/docs/cli/run for documentation about this command.
				
				/root/.pm2/logs/nextchat-prod-error.log last 15 lines:
				0|nextchat |   path: '/home/wwwroot/DeepSeek/NextChat_main/.next/prerender-manifest.json'
				0|nextchat | }
				0|nextchat | error Command failed with exit code 1.
				0|nextchat | Error: ENOENT: no such file or directory, open '/home/wwwroot/DeepSeek/NextChat_main/.next/prerender-manifest.json'
				0|nextchat |     at async open (node:internal/fs/promises:639:25)
				0|nextchat |     at async Object.readFile (node:internal/fs/promises:1246:14)
				0|nextchat |     at async setupFsCheck (/home/wwwroot/DeepSeek/NextChat_main/node_modules/next/dist/server/lib/router-utils/filesystem.js:181:40)
				0|nextchat |     at async initialize (/home/wwwroot/DeepSeek/NextChat_main/node_modules/next/dist/server/lib/router-server.js:58:23)
				0|nextchat |     at async Server.<anonymous> (/home/wwwroot/DeepSeek/NextChat_main/node_modules/next/dist/server/lib/start-server.js:247:36) {
				0|nextchat |   errno: -2,
				0|nextchat |   code: 'ENOENT',
				0|nextchat |   syscall: 'open',
				0|nextchat |   path: '/home/wwwroot/DeepSeek/NextChat_main/.next/prerender-manifest.json'
				0|nextchat | }
				0|nextchat | error Command failed with exit code 1.
	
		- 重启应用
		
				# pm2 restart nextchat-prod
				Use --update-env to update environment variables
				[PM2] Applying action restartProcessId on app [nextchat-prod](ids: [ 0 ])
				[PM2] [nextchat-prod](0) ✓
				┌────┬────────────────────┬──────────┬──────┬───────────┬──────────┬──────────┐
				│ id │ name               │ mode     │ ↺    │ status    │ cpu      │ memory   │
				├────┼────────────────────┼──────────┼──────┼───────────┼──────────┼──────────┤
				│ 0  │ nextchat-prod      │ fork     │ 16   │ online    │ 0%       │ 19.5mb   │
				└────┴────────────────────┴──────────┴──────┴───────────┴──────────┴──────────┘
				
		- 查看应用信息

				# pm2 info nextchat-prod
				 Describing process with id 0 - name nextchat-prod 
				┌───────────────────┬─────────────────────────────────────────┐
				│ status            │ online                                  │
				│ name              │ nextchat-prod                           │
				│ namespace         │ default                                 │
				│ version           │ N/A                                     │
				│ restarts          │ 16                                      │
				│ uptime            │ 5s                                      │
				│ script path       │ /usr/bin/bash                           │
				│ script args       │ -c yarn start                           │
				│ error log path    │ /root/.pm2/logs/nextchat-prod-error.log │
				│ out log path      │ /root/.pm2/logs/nextchat-prod-out.log   │
				│ pid path          │ /root/.pm2/pids/nextchat-prod-0.pid     │
				│ interpreter       │ none                                    │
				│ interpreter args  │ N/A                                     │
				│ script id         │ 0                                       │
				│ exec cwd          │ /home/wwwroot/DeepSeek/NextChat_main    │
				│ exec mode         │ fork_mode                               │
				│ node.js version   │ N/A                                     │
				│ node env          │ N/A                                     │
				│ watch & reload    │ ✘                                       │
				│ unstable restarts │ 0                                       │
				│ created at        │ 2025-03-13T02:37:42.134Z                │
				└───────────────────┴─────────────────────────────────────────┘
				 Divergent env variables from local env 
				
				
				 Add your own code metrics: http://bit.ly/code-metrics
				 Use `pm2 logs nextchat-prod [--lines 1000]` to display logs
				 Use `pm2 env 0` to display environment variables
				 Use `pm2 monit` to monitor CPU and Memory usage nextchat-prod
