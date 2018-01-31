## ssl

- 开启ssl的额外配置

		server {
	        listen 443;
	        server_name www.domain.com; #填写绑定证书的域名
			ssl on;
	        ssl_certificate /path/1_www.domain.com_bundle.crt;
	        ssl_certificate_key /path/2_www.domain.com.key;
	        ssl_session_timeout 5m;
	        ssl_protocols TLSv1 TLSv1.1 TLSv1.2; #按照这个协议配置
	        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:HIGH:!aNULL:!MD5:!RC4:!DHE;#按照这个套件配置
	        ssl_prefer_server_ciphers on;
			location / {
	
			}
		}
- 80请求转到443

		server {
		        listen 80;
		        listen [::]:80;
		        server_name www.domain.com;
		        rewrite ^(.*) https://$server_name$1 permanent;
		}
- 80与443共存

		server
	    {
	        listen 80;
	        #listen [::]:80;
	        listen 443 ssl;
	        server_name www.domain.com;
	
			# ssl on; // 需要注释掉
	        ssl_certificate /home/www/ssl/1_www.domain.com_bundle.crt;
	        ssl_certificate_key /home/www/ssl/2_www.domain.com.key;
	        ssl_session_timeout 5m;
	        ssl_protocols TLSv1 TLSv1.1 TLSv1.2; 
	        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:HIGH:!aNULL:!MD5:!RC4:!DHE;
	        ssl_prefer_server_ciphers on;
	
	        location /
	        {
	            proxy_pass http://127.0.0.1:12001;
	        }
	
	    }