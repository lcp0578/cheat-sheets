## Kingbase锁表后解锁操作
- 说明：数据库某张重要表异常锁住，任何跟这张表有关的增删改查操作，都一直请求中，导致所有关联查询这张表的页面接口超时。
- 解决方法：
	- 1.根据被锁表的表名，查询出oid（表名区分大小写）

			select oid from sys_class where relname = '表名';
	- 2.根据查询出的oid，查询出pid

			select pid from sys_locks where relation = 'oid';
	- 3.根据pid，强制结束该进程

			select sys_terminate_backend(pid);
- 补充：
	- 1.若不知道哪张表被锁，可以通过下面sql分析

			SELECT *
			FROM sys_stat_activity
			WHERE 
			pid != (SELECT sys_backend_pid())
			AND datname = '数据库名' AND usename = '模式名';
	- 2.获取批量可执行sql，执行即可

			SELECT 
			'select sys_terminate_backend(' || pid || ');' 
			FROM sys_locks where relation = 'oid';
