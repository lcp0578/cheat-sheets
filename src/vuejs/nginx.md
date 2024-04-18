## vue.js项目刷新404与API代理转发的nginx配置
- 编辑nginx配置文件

		server
		    {
		        listen 80;
		        ....
				# 解决nginx刷新404问题
		        location / {
		                try_files $uri $uri/ /index.html;
		        }
				# 处理API跨域，API代理转发
		        location /api/ {
		                proxy_pass http://www.xxxx.cn/api/;
		        }
		       .....
		    }
- 另一种解决方案

		server {
		        listen   80; # 监听的端口 
		        server_name  xx.xx.xxx.xx; 
		        root    /usr/share/nginx/html; 
		        location / {
		            try_files $uri $uri/ @router;#需要指向下面的@router否则会出现vue的路由在nginx中刷新出现404
		            index  index.html index.htm;
		        }
		        #对应上面的@router，主要原因是路由的路径资源并不是一个真实的路径，所以无法找到具体的文件
		        #因此需要rewrite到index.html中，然后交给路由在处理请求资源
		        location @router {
		            rewrite ^.*$ /index.html last;
		        }
		   }

