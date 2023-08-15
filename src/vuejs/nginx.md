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
                proxy_pass http://changzhi_project.sxjicheng.cn/api/;
        }
       .....
    }
