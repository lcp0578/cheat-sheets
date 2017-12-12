## MySQL sql_mode
- MySQL 5.7 默认sql_mode包含ONLY_FULL_GROUP_BY

		[Err] 1055 - Expression #1 of ORDER BY clause is not in GROUP BY clause and contains nonaggregated column 'information_schema.PROFILING.SEQ' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
- 查看sql_mode

		select @@global.sql_mode; 
- 修改/etc/my.conf
	
		[mysqld] #必须写到此模块下，才可生效
		....
		sql_mode ='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';