## MySQL sql_mode
- MySQL 5.7 默认sql_mode包含ONLY_FULL_GROUP_BY

		[Err] 1055 - Expression #1 of ORDER BY clause is not in GROUP BY clause and contains nonaggregated column 'information_schema.PROFILING.SEQ' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
- 查看sql_mode

		select @@global.sql_mode; 
        select @@sql_mode;
        mysql> select @@sql_mode;
        +---------------------------------------------------------+
        | @@sql_mode                                              |
        +---------------------------------------------------------+
        | ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE, |
  	    |NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,                 |
        |NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION               |
        +---------------------------------------------------------+
        1 row in set (0.00 sec)
- sql_mode值含义
	- ONLY_FULL_GROUP_BY：  
	对于GROUP BY聚合操作，如果在SELECT中的列，没有在GROUP BY中出现，那么将认为这个SQL是不合法的，因为列不在GROUP BY从句中
	- STRICT_TRANS_TABLES：  
	在该模式下，如果一个值不能插入到一个事务表中，则中断当前的操作，对非事务表不做任何限制
	- NO_ZERO_IN_DATE：  
	在严格模式，不接受月或日部分为0的日期。如果使用IGNORE选项，我们为类似的日期插入'0000-00-00'。在非严格模式，可以接受该日期，但会生成警告。
	- NO_ZERO_DATE：  
	在严格模式，不要将 '0000-00-00'做为合法日期。你仍然可以用IGNORE选项插入零日期。在非严格模式，可以接受该日期，但会生成警告
	- ERROR_FOR_DIVISION_BY_ZERO：  
	在严格模式，在INSERT或UPDATE过程中，如果被零除(或MOD(X，0))，则产生错误(否则为警告)。如果未给出该模式，被零除时MySQL返回NULL。如果用到INSERT IGNORE或UPDATE IGNORE中，MySQL生成被零除警告，但操作结果为NULL。
	- NO_AUTO_CREATE_USER    **注意：MySQL8移除了此模式**
	防止GRANT自动创建新用户，除非还指定了密码。
	- NO_ENGINE_SUBSTITUTION：  
	如果需要的存储引擎被禁用或未编译，那么抛出错误。不设置此值时，用默认的存储引擎替代，并抛出一个异常
- 修改/etc/my.conf
	
		[mysqld] #必须写到此模块下，才可生效
		....
		sql_mode ='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
- 设置NO_ZERO_DATE

        ERROR 1292 (22007): Incorrect datetime value: '0000-00-00 00:00:00'