## truncate 释放表空间
- truncate操作,同没有where条件的delete操作十分相似,只是把表里的信息全部删除,但是表依然存在.
- 例如:

		truncate table  XX
- truncate不支持回滚,并且不能truncate一个带有外键的表,如果要删除首先要取消外键,然后再删除.
truncate table 后,有可能表空间仍没有释放,可以使用如下语句:

		alter table 表名称 deallocate   UNUSED KEEP 0;
- 注意如果不加`KEEP 0`的话,表空间是不会释放的.
例如:

		alter table F_MINUTE_TD_NET_FHO_B7 deallocate   UNUSED KEEP 0;
或者:
	
		TRUNCATE TABLE (schema)table_name DROP(REUSE) STORAGE;
才能释放表空间.
例如:

		truncate table  test1 DROP STORAGE;