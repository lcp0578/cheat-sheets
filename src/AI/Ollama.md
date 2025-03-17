## Ollama手动安装
- 下载安装包，上传至服务器
	- https://github.com/ollama/ollama/releases
- 解压安装包


		tar -zxf ollama-linux-amd64.tgz -C /usr/local
- 添加环境变量

		vim /root/.bashrc
		export OLLAMA_HOST=http://127.0.0.1:11434
- 创建开机自启配置

		# vim  /etc/systemd/system/ollama.service
		[Unit]
		Description=Ollama Service
		After=network-online.target
		
		[Service]
		ExecStart=/usr/local/bin/ollama serve
		User=ollama
		Group=ollama
		Restart=always
		RestartSec=3
		Environment="PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/snap/bin"
		
		[Install]
		WantedBy=default.target
- 创建ollama用户

		useradd -m ollama
- 设置开机启动

		systemctl enable ollama
- 配置启动环境变量

		systemctl set-environment OLLAMA_HOST=http://127.0.0.1:11434
- 启动服务

		systemctl start ollama
- 查看服务状态

		# systemctl status ollama
		● ollama.service - Ollama Service
		     Loaded: loaded (/etc/systemd/system/ollama.service; enabled; vendor preset: enabled)
		     Active: active (running) since Mon 2025-03-17 06:46:01 UTC; 8min ago
		   Main PID: 7119 (ollama)
		      Tasks: 17 (limit: 154112)
		     Memory: 22.8M
		        CPU: 388ms
		     CGroup: /system.slice/ollama.service
		             └─7119 /usr/local/bin/ollama serve
		
		Mar 17 06:46:01 jicheng systemd[1]: Started Ollama Service.
		Mar 17 06:46:01 jicheng ollama[7119]: 2025/03/17 06:46:01 routes.go:1230: INFO server config env="map[CUDA_VISIBLE_DEVICES: GPU_DEVI>
		Mar 17 06:46:01 jicheng ollama[7119]: time=2025-03-17T06:46:01.440Z level=INFO source=images.go:432 msg="total blobs: 0"
		Mar 17 06:46:01 jicheng ollama[7119]: time=2025-03-17T06:46:01.440Z level=INFO source=images.go:439 msg="total unused blobs removed:>
		Mar 17 06:46:01 jicheng ollama[7119]: time=2025-03-17T06:46:01.441Z level=INFO source=routes.go:1297 msg="Listening on 127.0.0.1:114>
		Mar 17 06:46:01 jicheng ollama[7119]: time=2025-03-17T06:46:01.441Z level=INFO source=gpu.go:217 msg="looking for compatible GPUs"
		Mar 17 06:46:01 jicheng ollama[7119]: time=2025-03-17T06:46:01.811Z level=INFO source=types.go:130 msg="inference compute" id=GPU-96>
		Mar 17 06:46:01 jicheng ollama[7119]: time=2025-03-17T06:46:01.811Z level=INFO source=types.go:130 msg="inference compute" id=GPU-be>
		Mar 17 06:46:28 jicheng ollama[7119]: [GIN] 2025/03/17 - 06:46:28 | 200 |      29.614µs |       127.0.0.1 | GET      "/api/version"
		
- 如果异常则查看日志

		journalctl -u service-name.service | tail -n 10

- 查看版本

		# ollama -v
		ollama version is 0.6.1
