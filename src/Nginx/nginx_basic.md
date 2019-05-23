## nginx basic
- 错误日志

	error_log 级别分为 debug, info, notice, warn, error, crit  默认为crit, 格式如下：
	
		error_log  /your/path/error.log crit;  
	crit 记录的日志最少，而debug记录的日志最多。建议保持默认，调试时，可以临时修改一下。
- 修改上传文件大小限制

		# nginx/conf/nginx.conf
        location / {
            ...
   			client_max_body_size    1000m;
  		}