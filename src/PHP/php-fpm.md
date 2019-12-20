## php-fpm
- 启动、重启、终止操作
	- 使用信号控制，master进程可以理解以下信号
		- INT, TERM 立刻终止
		- QUIT 平滑终止
		- USR1 重新打开日志文件
		- USR2 平滑重载所有worker进程并重新载入配置和二进制模块
	- php-fpm 关闭：

			kill -INT 'cat /usr/local/php/var/run/php-fpm.pid'
	- php-fpm 重启：

			kill -USR2 'cat /usr/local/php/var/run/php-fpm.pid'