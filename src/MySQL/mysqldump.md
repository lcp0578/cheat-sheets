## mysqldump

- 命令行导入导出SQL

	导出数据：
	
		mysqldump -u username -p --default-character-set=utf8 databasename > path/databaseName.sql
	    mysqldump -u username -p --default-character-set=utf8 databasename tableName > path/tableName.sql
	
	导入数据：
	
	    mysql -u username -p --default-character-set=utf8 databasename < path/tableName.sql