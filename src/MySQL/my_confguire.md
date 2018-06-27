## my confguire(mysql.ini or my.cnf)
- 配置日志和慢日志

        [mysqld]
        port=3306
        ....
        ....
        ....
        # all query log
        general_log_file = "F:/xampp/mysql/query.log" //log path
        general_log      = 1

        # slow query log
        slow_query_log_file = "F:/xampp/mysql/query_slow.log"  //log path
        slow_query_log = 1 
        long_query_time = '0.8'  // Set the amount of time a query needs to run before being logged
- skip-name-resolve解决MySQL局域网建立连接延迟巨大的问题
mysql会在用户登录过程中对客户端IP进行DNS反查，不管你是使用IP登录还是域名登录，这个反查的过程都是在的。所以如果你的mysql所在的服务器的DNS有问题或者质量不好，那么就有可能造成我遇到的这个问题，DNS解析出现问题。

        [mysqld]
        skip-name-resolve
增加skip-name-resolve有可能导致账号失效，比如原来的账号是root@localhost，然后其实我使用mysql -h127.0.0.1 -uroot 是可以登录的。但是一旦加上了skip-name-resolve，就不能登录的了。需要加上账号root@127.0.0.1