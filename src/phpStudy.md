## phpStudy
- 新增php版本
	- 下载php源码  
	win版php下载地址：http://windows.php.net/
	- 放置php源码  
	phpStudy/php/php-7.2.0 或者 php-7.2.0-nts
	- 重启phpStudy,点击切换版本，进行切换
- 升级MySQL
	- 备份原来MySQL目录
	- 下载新版MySQL源码包  
	下载地址：https://dev.mysql.com/downloads/file/?id=467269
	- 解压放置到phpStudy目录下，命名为MySQL
	- 修改my.ini
	
			[mysqld]

			# Remove leading # and set to the amount of RAM for the most important data
			# cache in MySQL. Start at 70% of total RAM for dedicated server, else 10%.
			# innodb_buffer_pool_size = 128M
			
			# Remove leading # to turn on a very important data integrity option: logging
			# changes to the binary log between backups.
			# log_bin
			
			# These are commonly set, remove the # and set as required.
			# basedir = .....
			# datadir = .....
			# port = .....
			# server_id = .....
			port=3306
			basedir="D:/phpStudy/MySQL/" #实际目录
			datadir="D:/phpStudy/MySQL/data/"
	- 为MySQL设置环境变量，修改PATH
	- 初始化数据库
	
			mysqld --initialize
	- 安装mysqld服务
	
			mysqld --install
	- 启动mysqld服务
	
			net start MySQL		
	- 修改MySQL密码
	
			mysqladmin -u root -p password "password"