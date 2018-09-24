## SQL errors
- ORA-00904: invalid column name
	- 一个有效的列名必须是以字母开头,小于30个字符,并且只包含字母,数字或一些特殊的符号$,_,#.
	- 如果还包含其它的字符,那么这段字符必须用双引号引起来.
	- 列名不能是关键字.
- ORA-01861: literal does not match format string
	- update_at < to_date('2007-09-07 00:00:00','yyyy-mm-dd hh24:mi:ss') 