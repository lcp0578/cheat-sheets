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
- nginx 和 php-fpm 通信
	- TCP方式
		- php-fpm配置
		
        		$ vim /usr/local/php/ete/php-fpm.conf
                
                listen=127.0.0.1:9000
		- nginx配置
	
                vim /usr/local/nginx/conf/nginx.conf

                fastcgi_pass 127.0.0.1:9000;
	- unix socke方式(推荐)
		- php-fpm配置
		
        		$ vim /usr/local/php/ete/php-fpm.conf
                
                [global]
                pid = /usr/local/php/var/run/php-fpm.pid
                error_log = /usr/local/php/var/log/php-fpm.log
                log_level = notice

                [www]
                listen = /tmp/php-cgi.sock
                listen.backlog = -1
                listen.allowed_clients = 127.0.0.1
                listen.owner = www
                listen.group = www
                listen.mode = 0666
                user = www
                group = www
                pm = dynamic
                pm.max_children = 60
                pm.start_servers = 30
                pm.min_spare_servers = 30
                pm.max_spare_servers = 60
                request_terminate_timeout = 100
                request_slowlog_timeout = 0
                slowlog = var/log/slow.log
                catch_workers_output = yes
                
		- nginx配置
	
                vim /usr/local/nginx/conf/nginx.conf

                fastcgi_pass  unix:/tmp/php-cgi.sock;