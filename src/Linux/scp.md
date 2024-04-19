## scp 与 pscp
- 命令功能
	- scp是 secure copy的缩写, scp是linux系统下基于ssh登陆进行安全的远程文件拷贝命令。linux的scp命令可以在linux服务器之间复制文件和目录。
- 命令格式： 

		//本地文件上传
		scp local_file remote_username@remote_ip:remote_folder 
        scp -P 62222 -r images root@192.168.2.164:/data/maps // -r 代表是文件夹 -P是端口号
        //远程文件下载
        scp root@remote_ip:/remote_folder/remote_file.tar ./local_folder
- pscp是putty安装包所带的远程文件传输工具，它通过ssh协议传输，用于Windows系统平台往Linux系统平台之间传输文件。
- 报错`no matching host key type found. Their offer: ssh-rsa,ssh-dss`
	- 原因：OpenSSH 7.0以后的版本不再支持ssh-dss (DSA)算法
	- 解决办法
		- 在每次指令后加上-oHostKeyAlgorithms=+ssh-dss或者-oHostKeyAlgorithms=+ssh-dsa
		- 在~/.ssh目录下修改config文件

				Host *
				HostkeyAlgorithms +ssh-rsa
				PubkeyAcceptedKeyTypes +ssh-rsa
