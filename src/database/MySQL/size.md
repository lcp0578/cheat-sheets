## MySQL数据块、表占用空间大小计算
- 计算某一库中所有表大小

		SELECT TABLE_NAME, concat(truncate(data_length/1024/1024,2),' MB') as data_size,
		concat(truncate(index_length/1024/1024,2),' MB') as index_size
		 FROM information_schema.tables where TABLE_SCHEMA = 'database_name'
		 GROUP BY TABLE_NAME
		 ORDER BY data_length DESC;
- 计算各个数据库占用空间

		SELECT 
		table_schema as '数据库',
		sum(table_rows) as '记录数',
		sum(truncate(data_length/1024/1024, 2)) as '数据容量(MB)',
		sum(truncate(index_length/1024/1024, 2)) as '索引容量(MB)',
		sum(truncate(DATA_FREE/1024/1024, 2)) as '碎片占用(MB)'
		from information_schema.tables
		group by table_schema
		order by sum(data_length) desc, sum(index_length) desc;