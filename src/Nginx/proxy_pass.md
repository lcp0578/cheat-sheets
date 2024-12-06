## proxy_pass
> https://www.cnblogs.com/luxianghao/p/6807081.html

- 配置转发，配置header

		server
		    {
		        listen 8091;
		        listen [::]:8091;
		
		        location /
		        {
		            proxy_pass http://191.168.1.250:8089;
		        	proxy_http_version 1.1;
		        	proxy_set_header Upgrade $http_upgrade;
		        	proxy_set_header Connection $connection_upgrade;
		        	proxy_connect_timeout 180s;
		        	proxy_read_timeout 180s;
		        	proxy_send_timeout 180s;
		        	proxy_set_header Host $host;
		        	proxy_set_header  X-Forwarded-For  $remote_addr;
		        	proxy_set_header  X-Real-IP  $remote_addr;
		        	proxy_set_header X-Forwarded-Proto $scheme;
		        	client_max_body_size  100m;
		        	proxy_redirect   off;
		        	proxy_next_upstream http_502;
		        }
		
		        access_log  /home/wwwlogs/proxy_access.log;
		        error_log /home/wwwlogs/proxy_error.log;
		    }


- www.a.com/sfapi 转发到 www.b.com

        location /sfapi/ {
            #rewrite ^/sfapi/(.*) /$1 break; # 去掉/sfapi
            proxy_pass http://www.b.com/;
            #proxy_redirect     off;
            #proxy_set_header   Host $host;
        }
- www.a.com/sfapi 转发到 www.b.com/sfapi

        location /sfapi/ {
            proxy_pass http://www.b.com/sfapi/;
            proxy_set_header User-Agent: $ua;
        }
- go应用转发

		server
        {
            listen 80;
            #listen [::]:80;
        	listen 443 ssl;
            server_name api.kitcloud.cn;

        	ssl_certificate /home/www/ssl/1_api.kitcloud.cn_bundle.crt;
            ssl_certificate_key /home/www/ssl/2_api.kitcloud.cn.key;
            ssl_session_timeout 5m;
            ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
            ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:HIGH:!aNULL:!MD5:!RC4:!DHE;
            ssl_prefer_server_ciphers on;

            location /
            {
                proxy_pass http://127.0.0.1:12001;
            }
        }
- Nginx反向代理websocket

		server
        {
            listen 8082;
            proxy_http_version 1.1;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection "upgrade";
            server_name wateroa.sxjicheng.com;
            location / {
                    proxy_pass http://127.0.0.1:8084;
            }
        }
-  proxy_pass的注意案例
	-案例描述：
		- 假设 nginx服务器的域名为：www.xxx.com
		- 后端服务器为：192.168.1.10
		- 当请求http://www.xxx.com/aming/a.html的时候，以上示例分别访问的结果是
	-  不以("/")结尾
		- 访问：http://www.xxx.com/aming/a.html

				location /aming/
				{
				    proxy_pass http://192.168.1.10;
				    ...
				}
		- 被代理的完整地址为： http://192.168.1.10/aming/a.html
		- 总结：如果没有/，则会把匹配的路径部分（location后面/aming/）也给代理走

	- 以("/")结尾
		- 访问：http://www.xxx.com/aming/a.html

				location /aming/
				{
				    proxy_pass http://192.168.1.10/;
				    ...
				}
		- 被代理的完整地址为： http://192.168.1.10/a.html
		- 总结：当在后面的url加上了/，相当于是绝对根路径，则nginx不会把location中匹配的路径部分代理走。

	- 以("xxx/")结尾
		- 访问：http://www.xxx.com/aming/a.html

				location /aming/
				{
				    proxy_pass http://192.168.1.10/linux/;
				    ...
				}
		- 被代理的完整地址为： http://192.168.1.10/linux/a.html
		- 总结：当在后面的url加上了/，相当于是绝对根路径，则nginx不会把location中匹配的路径部分代理走。

	- 以("xxx")结尾
		- 访问：http://www.xxx.com/aming/a.html

				location /aming/
				{
				    proxy_pass http://192.168.1.10/linux;
				    ...
				}
		- 被代理的完整地址为： http://192.168.1.10/linuxa.html

                        
