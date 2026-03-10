## HAProxy Nginx获取客户端真实IP
- HAProxy配置

			# defaults
            option forwardfor
- Nginx配置（需要`http_realip_module`模块已被添加）

			# http module
			set_real_ip_from  192.168.1.0/24;
            set_real_ip_from  192.168.2.1;
            set_real_ip_from  2001:0db8::/32;
            real_ip_header    X-Forwarded-For;
            real_ip_recursive on;
            
			log_format  access  '$remote_addr - $remote_user [$time_local] "$request" '
	        					'$status $body_bytes_sent "$http_referer" '
	        					'"$http_user_agent" $http_x_forwarded_for '
	 						    '"$upstream_addr" "$upstream_status" "$upstream_response_time" "$request_time"';
            # server
            access_log /path/access.log access;