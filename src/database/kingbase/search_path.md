## search_path 搜索路径
- 什么是数据库搜索路径？
	- 数据库搜索路径是数据库管理系统（DBMS）用于查找表、视图、函数和其他数据库对象的路径。它类似于操作系统中的环境变量 PATH，指示DBMS在执行SQL查询时依次搜索哪些模式（schema）。这对于避免对象名称冲突和优化查询效率非常重要。
- 作用和重要性
	- 数据库搜索路径允许用户在不指定模式的情况下访问数据库对象。这样可以简化SQL查询，使代码更具可读性和维护性。例如，如果一个数据库包含多个模式，搜索路径能帮助DBMS优先查找特定模式中的对象，从而避免名称冲突和提高查询效率。
- 查看当前搜索路径

		test=# SHOW search_path;
		   search_path   
		-----------------
		 "$user", public
		(1 row)
- 搜索路径不对会导致doctrine数据库同步异常

		alter system set search_path to "$user", public, sys_catalog,pg_catalog;
		select pg_reload_conf();