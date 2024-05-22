## nginx与php-fpm通信与php-fpm重启
- 有两种通信方式
	- UNIX Domain Socket方式
		- UNIX Domain Socket不经过网络，只是在系统内部进行通信，适用于php和nginx都装在同一台linux服务器上
		- php-fpm.conf
		
				 listen = /tmp/php-fpm.sock
		- nginx.conf
		
				fastcgi_pass unix:/tmp/php-fpm.sock;
	- tcp方式
		- tcp通信协议的也就是fastcgi_pass模式的既适用于php和nginx都装在同一台linux服务器上，同时又适用于不在同一台服务器上的，一般在同一个局域网中，也就是127.0.0.1的意义了
		- php-fpm.conf
		
				listen = 127.0.0.1:9000
		- nginx.conf
		
				fastcgi_pass 127.0.0.1:9000;
- php-fpm重启
	- 找到pid位置，php-fpm.conf

			[global]
			; Pid file
			; Note: the default prefix is /usr/local/php/var
			; Default Value: none
			pid = run/php-fpm.pid #因此pid即为/usr/local/php/var/run/php-fpm.pid
	- 重启

			kill -USR2 `cat /usr/local/php/var/run/php-fpm.pid`
	- 关闭

			kill -INT `cat /usr/local/php/var/run/php-fpm.pid`