## CentOS 安装 OpenResty
- 下载rpm包，https://openresty.org/package/centos/
	- openresty
	- openresty-resty
	- openresty-doc
	- openresty-openssl
	- openresty-zlib
	- openresty-pcre
- 安装
	
    	rpm -ivh openresty-1.15.8.3-1.el6.x86_64.rpm
        rpm -ivh openresty-resty-1.15.8.3-1.el6.noarch.rpm
        rpm -ivh openresty-doc-1.15.8.3-1.el6.noarch.rpm
        rpm -ivh openresty-openssl-1.1.0l-1.el6.x86_64.rpm
        rpm -ivh openresty-zlib-1.2.11-3.el6.x86_64.rpm
        rpm -ivh openresty-pcre-8.44-1.el6.x86_64.rpm
- 编译安装lua-resty-waf
	- https://github.com/p0pr0ck5/lua-resty-waf/#installation
	- 执行 `make && make install`
	- 安装到了 `{openresty_path}/site/lualib/resty`，包含了 `waf`目录和`waf.lua`
- 安装后的文件
	- openresty目录，`/usr/local/openresty/`
	- openresty命令，`/usr/bin/openresty` 为 `/usr/local/openresty/nginx/sbin/nginx`的软链接。
	- 服务命令
	
    		service openresty start //stop, restart or reload
	- 指定application directories
		- `openresty -p /opt/my-fancy-app/ -c /opt/my-fancy-app/conf/nginx.conf`
		- 在`my-fancy-app`下创建子目录：`conf/`, `html/` , `logs/`