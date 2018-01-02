## root password
- 设置跳过验证

		[mysqld]
		....
		skip-grant-tables
	重新启动mysql服务
- 更新密码

		mysql> SET PASSWORD FOR "root"@"localhost" = PASSWORD("lcp0578");
		ERROR 1290 (HY000): The MySQL server is running with the --skip-grant-tables opt
		ion so it cannot execute this statement
		mysql> UPDATE user SET authentication_string=Password("lcp0578") WHERE User="roo
		t";
		Query OK, 1 row affected, 1 warning (0.00 sec)
		Rows matched: 1  Changed: 1  Warnings: 1
		
		mysql>
		mysql> flush privileges;
		Query OK, 0 rows affected (0.01 sec)
- 如果提示密码过期

	Your password has expired. To log in you must change it using a client that supports expired passwords.

		$ mysqladmin -u root -p password
		Enter password: *******
		New password: *******
		Confirm new password: *******
		Warning: Since password will be sent to server in plain text, use ssl connection to ensure password safety.