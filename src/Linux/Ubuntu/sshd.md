## 开启sshd服务
- 安装
	
		sudo apt-get install openssh-server
	然后确认sshserver是否启动了：

		ps -e |grep ssh
- 配置

		/etc/ssh/sshd_config
	在这里可以定义SSH的服务端口，默认端口是22，你可以自己定义成其他端口号，如222。
- 重启

	然后重启SSH服务：

		sudo /etc/init.d/ssh stop
 		sudo /etc/init.d/ssh start