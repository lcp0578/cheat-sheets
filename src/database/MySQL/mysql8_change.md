## MySQL8 变化
- my.cnf的变化
	- Symbolic links现在默认就是禁用了，无需再去标记禁用了。如果你标记的话，会有个提醒：

            Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release
	- `expire-logs-days` 参数已经去掉，取而代之的是 `binlog_expire_logs_seconds`，单位是秒
	- SQL Mode的 `NO_AUTO_CREATE_USER`也没有了。
	
    		In MySQL 8.0.11, several deprecated features related to account management have been removed, such as use of the GRANT statement to modify nonprivilege characteristics of user accounts, the NO_AUTO_CREATE_USER SQL mode, the PASSWORD() function, and the old_passwords system variable.
			Using GRANT to create users. Instead, use CREATE USER. Following this practice makes the NO_AUTO_CREATE_USER SQL mode immaterial for GRANT statements, so it too is removed.
            The PASSWORD() function. Additionally, PASSWORD() removal means that SET PASSWORD ... = PASSWORD('auth_string') syntax is no longer available.
	- 默认加密方式为`caching_sha2_password`
	
    		[mysqld]
    		default_authentication_plugin=mysql_native_password #更换为原来的加密方式
- X Plugin默认跟随启动。
	- 跟随启动后，如果你是用socket，它会在相同目录生成mysqlx.sock。并且他的连接方式强制要SSL。
    
    		This means that the first use of an account must be done using an SSL connection with the X Plugin authentication cache enabled. Once this initial authentication over SSL has succeeded non-SSL connections can be used.
- utf8mb4默认编码使用的是utf8mb4_0900_ai_ci
- 在MySQL 8.0中，proc表和event表都不再使用，并且定义触发器、存储过程的数据字典表不会被导出。所以在8.0中使用`mysqldump`、`mysqlpump`导出数据的时候，如果需要导出触发器、存储过程等内容，一定需要加上`--routines`和`--events`选项。
- 创建用户和授权，mysql8.0需要先创建用户和设置密码,然后才能授权。
	- 先创建一个用户

			create user 'hong'@'%' identified by '123456';
	- 进行授权

			grant all privileges on *.* to 'hong'@'%' with grant option;