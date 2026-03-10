## PostgreSQL 将表中的字段由varchar类型改为int类型
- 字段 “xxxx” 不能自动转换成类型 integer HINT: 指定一个USING表达式来执行转换
- 因为该字段上面有约束，也就是说这个字段的默认值为null，而null是无法转换成整型。
- 处理方法
	- 将这个字段的默认值改为0
	- 使用using，如果表中字段没有数据则可以直接使用using 0，如果表中有字段则使用 using 字段::int4