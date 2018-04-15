## Apache 开启.htaccess
- 配置apache主配置文件(httpd.conf)
	1. 查找“#LoadModule rewrite_module modules/mod_rewrite.so” 去掉前面的#号
	2. 把AllowOverride None 改为 AllowOverride All