## GROUP BY 报错
- column "t1.col_1" must appear in the GROUP BY clause or be used in an aggregate function
- 列“t1.col_1”必须出现在GROUP BY子句中或在聚合函数中使用。
- 原因
	- 聚合查询时，SELECT子句中可以有3种内容：
		- 在GROUP BY子句中出现的列名
		- 使用聚合函数（SUM、MAX、AVG等）
		- 常量
	- MySQL支持select list中非聚集列可以不出现在group by中。
	- sql标准是必须出现在group by中。
- 解决办法
	- 在kingbase.conf加上配置

			sql_mode= ''
	- kingbase 为兼容mysql ，设置了个参数sql_mode参数，目前只支持ONLY_FULL_GROUP_BY选项。如果sql_mode中不包含ONLY_FULL_GROUP_BY，group by语句可以不符合sql标准。 也就是与mysql结果相同。 