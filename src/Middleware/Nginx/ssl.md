## HTTPS配置SSL证书与生成自签名证书

- SSL
	- SSL即安全套接层（Secure Sockets Layer），它是一种为网络通信提供安全及数据完整性的安全协议。
	- SSL协议位于 TCP/IP 协议与各种应用层协议之间，为数据通讯提供安全支持。
	- SSL通过在客户端和服务器端之间建立一条加密通道，确保数据在传输过程中不被窃取、篡改或伪造。
- HTTPS
	- HTTPS是一种基于HTTP协议并结合了SSL/TLS协议的安全通信方式。HTTPS不仅仅涉及到SSL协议，还包括了对HTTP协议的一些扩展和改进，以适应安全通信的需求。
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
- 生成自签名证书（使用 OpenSSL）
	- 创建配置文件（解决 IP 证书警告问题）
		- 新建文件 `ssl.conf`，内容如下（替换 `IP_ADDRESS` 为你的实际 IP，如 `192.168.1.1`）：

				[req]
				default_bits = 2048
				prompt = no
				default_md = sha256
				distinguished_name = dn
				x509_extensions = v3_req
				
				[dn]
				CN = IP Address Certificate
				[v3_req]
				subjectAltName = @alt_names
				
				[alt_names]
				IP.1 = IP_ADDRESS
	-  生成私钥和证书

			openssl req -x509 -newkey rsa:2048 -keyout key.pem -out cert.pem -days 365 -nodes -config ssl.conf
		- 这会生成：
			- `key.pem`（私钥）
			- `cert.pem`（证书）
	- 配置nginx示例

			server {
			    listen 443 ssl;
			    server_name YOUR_IP;  # 如 192.168.1.1
			
			    ssl_certificate /path/to/cert.pem;
			    ssl_certificate_key /path/to/key.pem;
			
			    # 其他配置...
			}