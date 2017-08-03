## my confguire(mysql.ini or my.cnf)

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