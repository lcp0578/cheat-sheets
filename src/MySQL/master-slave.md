## MySQL master-slave


### master server
- 修改my.conf

		# vim /etc/my.conf
		[mysqld]
		server-id=220
		log-bin=mysql-bin
		binlog-do-db=mybbs
        binlog-do-db=需要复制的数据库名，如果复制多个数据库，重复设置这个选项即可
		binlog-ignore-db=不需要复制的数据库名，如果复制多个数据库，重复设置这个选项即可
- 创建从库连接主库用户

		# mysql -u root -p
		
		mysql> CREATE USER 'mysql221'@'192.168.252.221' IDENTIFIED BY 'mysql_221';
		mysql> GRANT REPLICATION SLAVE ON *.* TO 'mysql221'@'192.168.252.221'; 
		mysql> CREATE USER 'mysql222'@'192.168.252.222' IDENTIFIED BY 'mysql_222';
		mysql> GRANT REPLICATION SLAVE ON *.* TO 'mysql221'@'192.168.252.222'; 

	PS: 此处ON后必须是*.*,否则，Incorrect usage of DB GRANT and GLOBAL PRIVILEGES。  
	因为replication slave 的级别是global，所以不能只作用于某一数据库，而是全局。所以需要在my.cnf中添加binlog-do-db=xxx来限制数据库。
### slave server
- 修改my.conf

		# vim /etc/my.cnf
		[mysqld]
		server-id=221(222的同样需要设置)
- 配置与主库通信（在从库中执行）

		mysql> CHANGE MASTER TO MASTER_HOST='192.168.252.220', MASTER_USER='mysql221', MASTER_PASSWORD='mysql_221', MASTER_LOG_FILE='mysql-bin.000001', MASTER_LOG_POS=0;
	PS: 其中：MASTER_LOG_FILE='mysql-bin.000001', MASTER_LOG_POS=0;可以在主库使用命令`show master status;`进行查看，可做调整。
- 启动从库复制线程

		mysql> START SLAVE;
- 查看复制状态

		mysql>  show slave status\G
		*************************** 1. row ***************************
               Slave_IO_State: Waiting for master to send event
                  Master_Host: 192.168.252.220
                  Master_User: replication
                  Master_Port: 3306
                Connect_Retry: 60
              Master_Log_File: mysql-bin.000001
          Read_Master_Log_Pos: 629
               Relay_Log_File: master2-relay-bin.000003
                Relay_Log_Pos: 320
        Relay_Master_Log_File: mysql-bin.000001
             Slave_IO_Running: Yes
            Slave_SQL_Running: Yes
		...............
	检查主从复制通信状态

	- Slave_IO_State #从站的当前状态 
	- Slave_IO_Running： Yes #读取主程序二进制日志的I/O线程是否正在运行 
	- Slave_SQL_Running： Yes #执行读取主服务器中二进制日志事件的SQL线程是否正在运行。与I/O线程一样 
	- Seconds_Behind_Master #是否为0，0就是已经同步了
- 清空所有binlog

		reset master; # 清空所有 binlog 文件

### 参考资料
https://jasonhzy.github.io/2016/02/05/master-slave/  
https://www.hi-linux.com/posts/61083.html

