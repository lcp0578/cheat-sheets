## nginx vhost conf
- symfony

	lnmp1.4 nginx/conf/enable-php-pathinfo-sf.conf

		location / {
                try_files $uri /app.php$is_args$args;
        }
        # PROD
        location ~^/app\.php(/|$)
        {
            fastcgi_pass  unix:/tmp/php-cgi.sock;
            fastcgi_index index.php;
            include fastcgi.conf;
            include pathinfo.conf;
            internal;
        }
        #DEV 
        location ~^/(app_dev|config)\.php(/|$) 
        { 
            fastcgi_pass  unix:/tmp/php-cgi.sock;
            fastcgi_index index.php;
            include fastcgi.conf;
            include pathinfo.conf;
        }

	PS：open_basedir配置问题，修改fastcgi.conf
	
		fastcgi_param  SCRIPT_FILENAME    $document_root$fastcgi_script_name;
		fastcgi_param  QUERY_STRING       $query_string;
		fastcgi_param  REQUEST_METHOD     $request_method;
		fastcgi_param  CONTENT_TYPE       $content_type;
		fastcgi_param  CONTENT_LENGTH     $content_length;
		
		fastcgi_param  SCRIPT_NAME        $fastcgi_script_name;
		fastcgi_param  REQUEST_URI        $request_uri;
		fastcgi_param  DOCUMENT_URI       $document_uri;
		fastcgi_param  DOCUMENT_ROOT      $document_root;
		fastcgi_param  SERVER_PROTOCOL    $server_protocol;
		fastcgi_param  REQUEST_SCHEME     $scheme;
		fastcgi_param  HTTPS              $https if_not_empty;
		
		fastcgi_param  GATEWAY_INTERFACE  CGI/1.1;
		fastcgi_param  SERVER_SOFTWARE    nginx/$nginx_version;
		
		fastcgi_param  REMOTE_ADDR        $remote_addr;
		fastcgi_param  REMOTE_PORT        $remote_port;
		fastcgi_param  SERVER_ADDR        $server_addr;
		fastcgi_param  SERVER_PORT        $server_port;
		fastcgi_param  SERVER_NAME        $server_name;
		
		# PHP only, required if PHP was built with --enable-force-cgi-redirect
		fastcgi_param  REDIRECT_STATUS    200;
		#原有配置为$document_root/ 改为 $document_root/../
		#fastcgi_param PHP_ADMIN_VALUE "open_basedir=$document_root/:/tmp/:/proc/"; 
		fastcgi_param PHP_ADMIN_VALUE "open_basedir=$document_root/../:/tmp/:/proc/";

	独立的vhost配置文件

		server
	    {
	        listen 80;
	        #listen [::]:80;
	        server_name symfony.kitlabs.cn;
	        index index.html index.htm index.php default.html default.htm default.php;
	        root  /home/wwwroot/symfony.kitlabs.cn/web;
	
	        include other.conf;
	        #error_page   404   /404.html;
	
	        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
	        {
	            expires      30d;
	        }
	
	        location ~ .*\.(js|css)?$
	        {
	            expires      12h;
	        }
	
	        location / {
	                 # try to serve file directly, fallback to app.php
	                 try_files $uri /app.php$is_args$args;
	        }
	        # DEV
	        # This rule should only be placed on your development environment
	        # In production, don't include this and don't deploy app_dev.php or config.php
	        location ~ ^/(app_dev|config)\.php(/|$) {
	
	                fastcgi_pass  unix:/tmp/php-cgi.sock;
	                fastcgi_split_path_info ^(.+\.php)(/.*)$;
	                include fastcgi_params;
	                # When you are using symlinks to link the document root to the
	                # current version of your application, you should pass the real
	                # application path instead of the path to the symlink to PHP
	                # FPM.
	                # Otherwise, PHP's OPcache may not properly detect changes to
	                # your PHP files (see https://github.com/zendtech/ZendOptimizerPlus/issues/126
	                # for more information).
	                fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
	                fastcgi_param DOCUMENT_ROOT $realpath_root;
	        }
	        # PROD
	        location ~ ^/app\.php(/|$) {
	                fastcgi_pass  unix:/tmp/php-cgi.sock;
	                fastcgi_split_path_info ^(.+\.php)(/.*)$;
	                include fastcgi_params;
	                # When you are using symlinks to link the document root to the
	                # current version of your application, you should pass the real
	                # application path instead of the path to the symlink to PHP
	                # FPM.
	                # Otherwise, PHP's OPcache may not properly detect changes to
	                # your PHP files (see https://github.com/zendtech/ZendOptimizerPlus/issues/126
	                # for more information).
	                fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
	                fastcgi_param DOCUMENT_ROOT $realpath_root;
	                # Prevents URIs that include the front controller. This will 404:
	                # http://domain.tld/app.php/some-path
	                # Remove the internal directive to allow URIs like this
	                internal;
	        }
	
	        # return 404 for all other php files not matching the front controller
	        # this prevents access to other php files you don't want to be accessible.
	        location ~ \.php$ {
	                return 404;
	        }
	        access_log  /home/wwwlogs/symfony.kitlabs.cn.log  access;
	    }
- destoon

		server
	    {
	        listen 80;
	        #listen [::]:80;
	        server_name destoon.kitlabs.cn;
	        index index.html index.htm index.php default.html default.htm default.php;
	        root  /home/wwwroot/destoon.kitlabs.cn;
	
	        include destoon.conf;
	        #error_page   404   /404.html;
	        location ~ [^/]\.php(/|$)
	        {
	            # comment try_files $uri =404; to enable pathinfo
	            try_files $uri =404;
	            fastcgi_pass  unix:/tmp/php-cgi.sock;
	            fastcgi_index index.php;
	            include fastcgi.conf;
	            #include pathinfo.conf;
	        }
	
	        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
	        {
	            expires      30d;
	        }
	
	        location ~ .*\.(js|css)?$
	        {
	            expires      12h;
	        }
	
	        access_log  /home/wwwlogs/destoon.kitlabs.cn.log  access;
	    }
	nginx/conf/destoon.conf
		
		rewrite ^/(.*)\.(asp|aspx|asa|asax|dll|jsp|cgi|fcgi|pl)(.*)$ /404.php last;
		rewrite ^/(.*)/file/(.*)\.php(.*)$ /404.php last;
		rewrite ^/(.*)-htm-(.*)$ /$1.php?$2 last;
		rewrite ^/(.*)/show-([0-9]+)([\-])?([0-9]+)?\.html$ /$1/show.php?itemid=$2&page=$4 last;
		rewrite ^/(.*)/list-([0-9]+)([\-])?([0-9]+)?\.html$ /$1/list.php?catid=$2&page=$4 last;
		rewrite ^/(.*)/show/([0-9]+)/([0-9]+)?([/])?$ /$1/show.php?itemid=$2&page=$3 last;
		rewrite ^/(.*)/list/([0-9]+)/([0-9]+)?([/])?(.*)?$ /$1/list.php?catid=$2&page=$3&attr=$5 last;
		rewrite ^/(.*)/([A-za-z0-9_\-]+)-c([0-9]+)-([0-9]+)\.html$ /$1/list.php?catid=$3&page=$4 last;
		rewrite ^(.*)/([a-z]+)/(.*)\.shtml$ $1/$2/index.php?rewrite=$3 last;
		rewrite ^/(com)/([a-z0-9_\-]+)/([a-z]+)/(.*)\.html$ /index.php?homepage=$2&file=$3&rewrite=$4 last;
		rewrite ^/(com)/([a-z0-9_\-]+)/([a-z]+)([/])?$ /index.php?homepage=$2&file=$3 last;
		rewrite ^/(com)/([a-z0-9_\-]+)([/])?$ /index.php?homepage=$2 last;
- https + destoon

		server {
	        listen 80;
	        server_name www.kitcloud.cn;
	        rewrite ^(.*) https://$server_name$1 permanent;
		}
		server {
	        listen 443;
	        server_name www.kitcloud.cn;
	        index index.html index.htm index.php default.html default.htm default.php;
	        ssl on;
	        ssl_certificate   /home/certificate/kitcloud.pem;
	        ssl_certificate_key  /home/certificate/kitcloud.key;
	        ssl_session_timeout 5m;
	        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
	        ssl_ciphers AESGCM:ALL:!DH:!EXPORT:!RC4:+HIGH:!MEDIUM:!LOW:!aNULL:!eNULL;
	        ssl_prefer_server_ciphers on;
	        root  /home/wwwroot/kitcloud.cn;
	
	        include destoon.conf;
	        #error_page   404   /404.html;
	        location ~ [^/]\.php(/|$)
	        {
	            # comment try_files $uri =404; to enable pathinfo
	            #try_files $uri =404;
	            fastcgi_pass  unix:/tmp/php-cgi.sock;
	            fastcgi_index index.php;
	            include fastcgi.conf;
	            include pathinfo.conf;
	        }
	
	        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
	        {
	            expires      30d;
	        }
	
	        location ~ .*\.(js|css)?$
	        {
	            expires      12h;
	        }
	
	        rewrite ^/(.*)\.(asp|aspx|asa|asax|dll|jsp|cgi|fcgi|pl)(.*)$ /404.php last;
	        rewrite ^/(.*)/file/(.*)\.php(.*)$ /404.php last;
	        rewrite ^/(.*)-htm-(.*)$ /$1.php?$2 last;
	        rewrite ^/(.*)/show-([0-9]+)([\-])?([0-9]+)?\.html$ /$1/show.php?itemid=$2&page=$4 last;
	        rewrite ^/(.*)/list-([0-9]+)([\-])?([0-9]+)?\.html$ /$1/list.php?catid=$2&page=$4 last;
	        rewrite ^/(.*)/show/([0-9]+)/([0-9]+)?([/])?$ /$1/show.php?itemid=$2&page=$3 last;
	        rewrite ^/(.*)/list/([0-9]+)/([0-9]+)?([/])?$ /$1/list.php?catid=$2&page=$3 last;
	        rewrite ^/(.*)/([A-za-z0-9_\-]+)-c([0-9]+)-([0-9]+)\.html$ /$1/list.php?catid=$3&page=$4 last;
	        rewrite ^/(.*)/([a-z]+)/(.*)\.shtml$ /$1/$2/index.php?rewrite=$3 last;
	        rewrite ^/(com)/([a-z0-9_\-]+)/([a-z]+)/(.*)\.html$ /index.php?homepage=$2&file=$3&rewrite=$4 last;
	        rewrite ^/(com)/([a-z0-9_\-]+)/([a-z]+)([/])?$ /index.php?homepage=$2&file=$3 last;
	        rewrite ^/(com)/([a-z0-9_\-]+)([/])?$ /index.php?homepage=$2 last;
	        rewrite ^/(house)/list-(r|b|t|p|f|l|o|h|n|g|j|e)([0-9A-Z_]+)\.html?$    /$1/list.php?&$2=$3  last;
	        rewrite ^/(house)/list-r([0-9]+)-t([0-9]+)-p([0-9]+)-k(.*)\.html?$      /$1/list.php?&r=$2&t=$3&p=$4&k=$5  last;
	        rewrite ^/(house)/map.html?$    /map/newhouse.php  last;
	        rewrite ^/(house)/([0-9]+)/?$ /$1/show.php?&at=$3&itemid=$2  last;
	        rewrite ^/(house)/([0-9]+)/index\.html?$ /$1/show.php?&at=$3&itemid=$2  last;
	        rewrite ^/(house)/([0-9]+)/wenfang-g([0-9]+)\.html?$ /extend/wenfang.php?mid=6&itemid=$1&page=$2 last;
	        rewrite ^/(house)/([0-9]+)/(xinxi|huxing|jiage|xiangce|wenfang|peitao|zixun|dianping|pic)\.html?$ /$1/show.php?&at=$3&itemid=$2   last;
	        rewrite ^/(.*)/p([0-9]+)-h([0-9]+)\.html?$ /$1/show.php?itemid=$2&houseid=$3 last;
	        rewrite ^/(house)/([0-9]+)/xiangce-c([0-9]+)\.html?$ /$1/show.php?&at=xiangce&itemid=$2&catids=$3 last;
	        rewrite ^/(house)/baojia\.html?$         /$1/baojia.php last;
	        #jingjinren
	        rewrite ^/(broker)/index\.html$ /$1/index.php last;
	        rewrite ^/(broker)/list-(r|b|t|p|f|l|o|h|n|g|c|y|e|m|u|i)([0-9_]+)\.html?$      /$1/index.php?&$2=$3 last;
	        rewrite ^/(broker)/list-(.*)\.html?$    /$1/index.php?&param=$2  last;
	        #ershoufang
	        rewrite ^/(sale)/map\.html?$    /map/index.php last;
	        rewrite ^/(rent)/map\.html?$    /map/rent.php last;
	        rewrite ^/(map)/rent\.html?$    /map/rent.php last;
	        rewrite ^/(map)/sale\.html?$    /map/index.php last;
	        rewrite ^/(map)/house\.html?$   /map/newhouse.php last;
	
	        rewrite ^/(.*)/list\.html$      /$1/list.php last;
	        rewrite ^/(.*)/list-(r|b|t|p|f|l|o|h|n|g|c|y|e|m|u|i)([0-9_]+)\.html?$  /$1/list.php?&$2=$3 last;
	        rewrite ^/(.*)/list-k(.*)\.html?$       /$1/list.php?&k=$2 last;
	        rewrite ^/(.*)/list-(.*)\.html?$        /$1/list.php?&param=$2  last;
	        rewrite ^/(.*)/pk/(.+)?$ /$1/compare.php?&itemid=$2 last;
	        #xiaoqu
	        rewrite ^/(community)/([0-9]+)/?$ /$1/show.php?&at=$3&itemid=$2 last;
	        rewrite ^/(community)/([0-9]+)/index\.html?$ /$1/show.php?&at=$3&itemid=$2 last;
	        rewrite ^/(community)/([0-9]+)/(sale|rent|price|map)\.html?$ /$1/show.php?&at=$3&itemid=$2  last;
	        rewrite ^/(community)/([0-9]+)/(sale|rent)-(p|c|i|u|h|n|e|m|g)([0-9_]+)\.html?$ /$1/show.php?&at=$3&itemid=$2&$4=$5  last;
	        rewrite ^/(community)/([0-9]+)/(sale|rent)-(.*)\.html?$ /$1/show.php?&at=$3&itemid=$2&param=$4  last;
	        rewrite ^/(.*)/search\.html$ /$1/search.php last;
	        rewrite ^/(.*)/search-k([^/-]+)\.html$  /$1/search.php?&kw=$2 last;
	        rewrite ^/(.*)/search-([^/-]+)-p([0-9]+)\.html$ /$1/search.php&kw=$2&page=$3  last;
	
	        rewrite ^/(.*)/(.*)\.htm$ /$1/404.php last;
	        # access_log off;
	        access_log  /home/wwwlogs/kitcloud.cn.log  access;
	        error_log   /home/wwwlogs/kitcloud.cn.error.log    error;
		}
- 去掉index.php美化url

		location / {
		 	#如果请求既不是一个文件，也不是一个目录，则执行一下重写规则
	    	if (!-e $request_filename)  # if后面有空格
	        {
	            #地址作为将参数rewrite到index.php上。
	            rewrite ^/(.*)$ /index.php/$1;
	            #若是子目录则使用下面这句，将subdir改成目录名称即可。
	            #rewrite ^/subdir/(.*)$ /subdir/index.php/$1;
	        }
		}