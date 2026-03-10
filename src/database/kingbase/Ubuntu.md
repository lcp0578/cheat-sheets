## 在Ubuntu命令行安装KingbaseES
- 创建用户及安装目录
	
		# useradd -m kingbase #创建用户
		# passwd kingbase #设置密码
		# mkdir /home/KingbaseES
		# chown -R kingbase:kingbase /home/KingbaseES
- 解决切换kingbase后shell配置不完整导致无法补全问题
	- 查看kingbase用户的默认Shell

			grep kingbase /etc/passwd
	- 如果输出为 /bin/sh 或其他非Bash Shell（如 /bin/dash），需修改为Bash：

			sudo usermod -s /bin/bash kingbase
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
		- 删除行首的`#`


				sudo vim /etc/locale.gen 
				zh_CN.UTF-8 UTF-8
				zh_HK.UTF-8 UTF-8
				zh_SG.UTF-8 UTF-8
				zh_TW.UTF-8 UTF-8
		- 保存文件后运行

				sudo locale-gen

- 准备授权文件

		/home/KingbaseES/license.dat
- 执行安装
	
		# su - kingbase
		$ sh setup.sh -i console
		
- 验证是否能连接数据库

		./ksql -p 54326 -U system test
- 设置大小写敏感性
	- 大小写敏感性是实例级参数，只有在初始化数据库时才能进行设置，一旦设置后，无法进行修改。
	- 查看数据库模式与大小写敏感性

			test=# show database_mode;
			 database_mode 
			---------------
			 pg
			(1 row)
			
			test=# show enable_ci;
			 enable_ci 
			-----------
			 off
			(1 row)

		- off ： 表示大小写不敏感
		- on ： 表示大小写敏感
- 重新初始化数据库
	- 会清空数据
	- 需要删除data文件
	- `initdb`在安装目录下的：Server/bin中

			initdb -U SYSTEM -W "xxxxxx" --case-insensitive -D /home/KingbaseES_R3/data -E UTF-8
		- `-U`：指定管理员用户名，一般使用 SYSTEM 即可；
		- `-W`：指定管理员密码，根据需要自行设置；
		- `--case-insensitive`：表示大小写不敏感，需要大小写敏感的话去掉该参数即可；
		- `-D`：指定data目录，指定为原来的data目录路径即可；
		- `-E`：指定编码。
	- 重新设置数据库模式，并指定管理用户

			./initdb -D /home/KingbaseES/data -U system --pwprompt --dbmode=pg
- If you want to register KingbaseES V8 as OS service, please run

		/home/KingbaseES/install/script/root.sh