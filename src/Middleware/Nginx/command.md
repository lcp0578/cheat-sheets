## Nginx启动、重启、停止命令
- 启动

		 # /usr/local/nginx/sbin/nginx 
         //指定配置文件
         # /usr/local/nginx/sbin/nginx -c /usr/local/nginx/conf/nginx.conf
- 重启

		//校验配置文件是否有语法错误
        # /usr/local/nginx/sbin/nginx -t
        # /usr/local/nginx/sbin/nginx -t -c /usr/nginx/conf/nginx.conf
        //重启
        # /usr/local/nginx/sbin/nginx -s reload
- 另外一种重启方式

		//查看主进程ID
		# ps -ef|grep nginx
        # kill -HUP 主进程号或进程号文件路径
- 停止

		# kill -TERM 主进程号
        //或者
        # kill -INT 主进程号