## Innodb

- 关于直接复制数据库的data文件
	- MyISAM引擎可是正常使用。
	- Innodb会报错，Table xxx doesn't exist in engine，需要复制ibdata1文件。  
	相关资料：  
	[mysql-innodb-lost-tables-but-files-exist](https://superuser.com/questions/675445/mysql-innodb-lost-tables-but-files-exist)  
	[innodb-error-tablespace-id-in-file](http://www.chriscalender.com/tag/innodb-error-tablespace-id-in-file/)