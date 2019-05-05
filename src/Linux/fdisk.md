## scp
- 命令功能
	scp是 secure copy的缩写, scp是linux系统下基于ssh登陆进行安全的远程文件拷贝命令。linux的scp命令可以在linux服务器之间复制文件和目录。
- 命令格式： 

		//本地文件上传
		scp local_file remote_username@remote_ip:remote_folder 
        scp -P 62222 -r images root@192.168.2.164:/data/maps // -r 代表是文件夹 -P是端口号
        //远程文件下载
        scp root@remote_ip:/remote_folder/remote_file.tar ./local_folder