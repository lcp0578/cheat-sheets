## mysqldump

- 命令行导入导出SQL

	导出数据：
	
		mysqldump -u username -p databasename > path/databaseName.sql
	    mysqldump -u username -p databasename tableName > path/tableName.sql
	
	导入数据：
	
	    mysql -u username -p databasename < path/tableName.sql