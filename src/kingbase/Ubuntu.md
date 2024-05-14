## 在Ubuntu命令行安装KingbaseES
- 创建用户及安装目录
	
		# useradd -m kingbase #创建用户
		# passwd kingbase #设置密码
		# mkdir /home/KingbaseES
		# chown -R kingbase:kingbase /home/KingbaseES
- 挂载安装包

		# mount KingbaseES_V008R006C008B0014_Lin64_install.iso /mnt
		mount: /mnt: WARNING: source write-protected, mounted read-only.
		# cd /mnt/
		# ll
		total 12
		dr-xr-xr-x  3 root root 2048 Sep  2  2023 ./
		drwxr-xr-x 19 root root 4096 Apr  2 15:41 ../
		dr-xr-xr-x  2 root root 2048 Sep  2  2023 setup/
		-r-xr-xr-x  1 root root 3933 Sep  2  2023 setup.sh*
		# cp -r setup* /home/kingbase #复制到kingbase的home目录
		# chown -R kingbase:kingbase /home/kingbase
- 需要设置语言包
	- 1.安装基本的软件包（第2步安装 zh_CN 中文字符集时要用到）

			sudo apt-get update   //ubuntu系统更新软件包列表
			sudo apt-get install  -y language-pack-zh-hans
			sudo apt-get install -y language-pack-zh-hant
	- 2.安装字符集

			cd /usr/share/locales 

			sudo ./install-language-pack zh_CN  //开始安装zh_CN中文字符集
- 准备授权文件

		/home/KingbaseES/license.dat
- 执行安装
	
		# su - kingbase
		$ sh setup.sh -i console
		
- 验证是否能连接数据库

		./ksql -p 54326 -U system test