## MySQL8 authentication plugin
- MySQL default authentication-plugin
	- MySQL8之前版本，采用：mysql_native_password
	- MySQL8 采用：caching_sha2_password
- MySQL客户端提示连接失败解决办法
	- 修改默认配置
	
    		default-authentication-plugin=mysql_native_password
    - 重新设置root密码
    
    		use mysql;
            ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'new password';
            FLUSH PRIVILEGES;
- PHP报错：SQLSTATE[HY000] [2054] The server requested authentication method unknown to the client
	- 错误原因：由于MySQL 8默认使用了新的密码验证插件：caching_sha2_password，而之前的PHP版本中所带的mysqlnd无法支持这种验证。
	- 升级PHP，查看phpinfo的mysqlnd的Loaded plugins部分，是否包含caching_sha2_password
	- 目前开始支持的版本：PHP 7.1.16及以上版本和PHP 7.2.4及以上版本。[www.php.net/manual/zh/mysqli.requirements.php](https://www.php.net/manual/zh/mysqli.requirements.php)