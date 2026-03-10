## Nginx版本介绍
- Nginx官网提供了三个类型的版本
	- Mainline version：Mainline 是 Nginx 目前主力在做的版本，可以说是开发版
	- Stable version：最新稳定版，生产环境上建议使用的版本
	- Legacy version：遗留的老版本的稳定版
- 隐藏nginx版本号
	- `vim nginx.conf`
	
    		http {
            	...
            	server_tokens off; #添加此行
                ...
            }
	- `vim fastcgi.conf`
	
    		stcgi_param SERVER_SOFTWARE nginx; #原：stcgi_param SERVER_SOFTWARE nginx/$nginx_version;