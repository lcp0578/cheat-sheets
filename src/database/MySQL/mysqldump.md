## mysqldump

- 命令行导入导出SQL

	导出数据：
	
		mysqldump -u root -p --default-character-set=utf8 databasename > path/databaseName.sql
	    mysqldump -u root -p --default-character-set=utf8 databasename tableName > path/tableName.sql
	
	导入数据：
	
	    mysql -u root -p --default-character-set=utf8 databasename < path/tableName.sql
	PS: 如果sql文件比较大，会报字符集错误，其实不然，是单独的SQL太大导致。故需要修改配置
		
		[mysqld]
 		# 设置最大包,限制server接受的数据包大小，避免超长SQL的执行有问题默认值为16M，当MySQL客户端或mysqld服务器收到大于max_allowed_packet字节的信息包时，将发出“信息包过大”错误，并关闭连接。对于某些客户端，如果通信信息包过大，在执行查询期间，可能会遇到“丢失与MySQL服务器的连接”错误。默认值16M
		max_allowed_packet = 1000M
		# 包消息缓冲区初始化为net_buffer_length字节，但需要时可以增长到max_allowed_packet字节
		net_buffer_length = 64K