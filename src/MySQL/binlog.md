## bin log
- 关键配置`vim /etc/my.cnf`
``` conf
	[mysqld]
    binlog_format = row    //binlog日志格式，建议使用row
    log-bin = /data/mysql/mysql-bin.log    //binlog日志文件
    expire_logs_days = 7               //binlog过期清理时间
    max_binlog_size = 1G             //binlog每个日志文件大小
    binlog_cache_size = 4m             //binlog缓存大小
    max_binlog_cache_size = 512m        //最大binlog缓存大小
    binlog_row_image = full
```
- [binlog_format](binlog_format.md)  binlog_format模式
- 查看binlog信息
``` mysql
mysql> show variables like'log_bin%';
+---------------------------------+--------------------------------------+
| Variable_name                   | Value                                |
+---------------------------------+--------------------------------------+
| log_bin                         | ON                                   |
| log_bin_basename                | /usr/local/mysql/var/mysql-bin       |
| log_bin_index                   | /usr/local/mysql/var/mysql-bin.index |
| log_bin_trust_function_creators | OFF                                  |
| log_bin_use_v1_row_events       | OFF                                  |
+---------------------------------+--------------------------------------+
5 rows in set (0.01 sec)
```
- [github.com/danfengcao/binlog2sql](https://github.com/danfengcao/binlog2sql) 从MySQL binlog解析出你要的SQL