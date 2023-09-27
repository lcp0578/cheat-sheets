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