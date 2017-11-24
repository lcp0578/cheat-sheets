## MySQL grant
- 授权

		GRANT ALL PRIVILEGES ON *.* TO 'username'@'ip address' IDENTIFIED BY 'user password';
		GRANT ALL PRIVILEGES ON db_name.* TO 'username'@'ip address' IDENTIFIED BY 'user password';
		GRANT ALL PRIVILEGES ON db_name.table_name TO 'username'@'ip address' IDENTIFIED BY 'user password';
		// 赋予部分权限
		GRANT select,insert,update,delete ON db_name.* TO 'username'@'ip address' IDENTIFIED BY 'user password' WITH GRANT OPTION; 
- 取消授权

		REVOKE ALTER ON *.* FROM 'username'@'ip address' IDENTIFIED BY 'user password';
		REVOKE select,insert,update,delete ON db_name.* FROM 'username'@'ip address' IDENTIFIED BY 'user password';
- 刷新权限，让修改生效

		FLUSH PRIVILEGES;
- 查看某个用户的权限

		mysql> show grants for lcpeng;
		+------------------------------------+
		| Grants for lcpeng@%                |
		+------------------------------------+
		| GRANT USAGE ON *.* TO 'lcpeng'@'%' |
		+------------------------------------+
		1 row in set (0.00 sec)
		
		
		mysql> show grants for lcpeng@192.168.3.128;
		+----------------------------------------------------------------------------------------------------------+
		| Grants for lcpeng@192.168.3.128                                                                         |
		+----------------------------------------------------------------------------------------------------------+
		| GRANT USAGE ON *.* TO 'lcpeng'@'192.168.3.128'                                                          |
		| GRANT SELECT, INSERT, UPDATE, DELETE ON `chengshi_wuye`.* TO 'lcpeng'@'192.168.3.128' WITH GRANT OPTION |
		+----------------------------------------------------------------------------------------------------------+
		2 rows in set (0.00 sec)
		
		mysql> 

		mysql> SELECT * FROM information_schema.user_privileges WHERE grantee LIKE "'lcpeng'%";
		+---------------------------+---------------+----------------+--------------+
		| GRANTEE                   | TABLE_CATALOG | PRIVILEGE_TYPE | IS_GRANTABLE |
		+---------------------------+---------------+----------------+--------------+
		| 'lcpeng'@'10.25.88.145'   | def           | USAGE          | NO           |
		| 'lcpeng'@'10.25.88.146'   | def           | USAGE          | NO           |
		| 'lcpeng'@'%'              | def           | USAGE          | NO           |
		+---------------------------+---------------+----------------+--------------+
		3 rows in set (0.00 sec)