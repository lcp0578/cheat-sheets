## phpStudy
- 新增php版本
	- 下载php源码  
	win版php下载地址：http://windows.php.net/download/
	- 放置php源码  
	phpStudy/php/php-7.2.0 或者 php-7.2.0-nts
	- 重启phpStudy,点击切换版本，进行切换
- 升级MySQL
	- 备份原来MySQL目录
	- 下载新版MySQL源码包  
	下载地址：https://dev.mysql.com/downloads/mysql/
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
	MySQL安装后，在MySQL/data目录下会有一个xxx.err设置了一个随机密码，并记录在此。

			2017-12-27T16:02:13.651728Z 0 [Warning] TIMESTAMP with implicit DEFAULT value is deprecated. Please use --explicit_defaults_for_timestamp server option (see documentation for more details).
			2017-12-27T16:02:16.163872Z 0 [Warning] InnoDB: New log files created, LSN=45790
			2017-12-27T16:02:16.670901Z 0 [Warning] InnoDB: Creating foreign key constraint system tables.
			2017-12-27T16:02:16.895913Z 0 [Warning] No existing UUID has been found, so we assume that this is the first time that this server has been started. Generating a new UUID: 4f889663-eb1f-11e7-b4b7-f0def180f094.
			2017-12-27T16:02:16.931916Z 0 [Warning] Gtid table is not ready to be used. Table 'mysql.gtid_executed' cannot be opened.
			2017-12-27T16:02:16.988919Z 1 [Note] A temporary password is generated for root@localhost: smN9#Q-ivU,%
	- 查看安装的MySQL版本
	

			mysql> select version();
			+-----------+
			| version() |
			+-----------+
			| 5.7.20    |
			+-----------+
			1 row in set (0.00 sec)
			
			mysql>