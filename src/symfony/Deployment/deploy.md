## symfony 项目部署
0. 必要条件
	- 熟悉简单vim编辑命令
	- 创建目录、解压命令
1. 安装lnmp环境
	参考[lnmp安装步骤](https://lnmp.org/install.html)
2. 配置ssh key
	- 生成ssh key
		[服务器上的 Git - 生成 SSH 公钥](https://git-scm.com/book/zh/v1/%E6%9C%8D%E5%8A%A1%E5%99%A8%E4%B8%8A%E7%9A%84-Git-%E7%94%9F%E6%88%90-SSH-%E5%85%AC%E9%92%A5)
	- 添加ssh key到git代码管理平台
		登录git平台，仓库设置->管理部署密钥->添加部署密钥。标题一定要写清楚用途，密钥文本内容为`cat ~/.ssh/id_rsa.pub`内容
3. clone代码
	- git clone 提示401无权限原因如下：
		- 用户名或者密码错误
		- ssh key不存在
		- git版本较低，需要升级高版本
4. 安装项目依赖包
	当`composer install`较慢时，考虑[更换中国镜像](https://github.com/lcp0578/cheat-sheets/blob/master/src/composer/config.md)
4. 修改php.ini配置项
	- 当symfony执行预置脚本或者清除缓存时
	
    		[Symfony\Component\Process\Exception\RuntimeException]
  			The Process class relies on proc_open, which is not available on your PHP installation.
    	代表此函数被禁用或者缺少相关扩展。
        
        	Error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 28672 bytes)
        代表php内存配置项配置空间较小。
    - 解除php.ini的函数禁用
    
    		# php --ini
            Configuration File (php.ini) Path: /usr/local/php/etc
            Loaded Configuration File:         /usr/local/php/etc/php.ini  //php配置文件地址
            Scan for additional .ini files in: /usr/local/php/conf.d
            Additional .ini files parsed:      (none)
            # vim /usr/local/php/etc/php.ini
            // 找到disable_function配置项（vim搜索功能），移除对应的函数即可
            // 修改php内存限制配置,memory_limit = 2048M
        
    - [安装php扩展](https://github.com/lcp0578/cheat-sheets/blob/master/src/PHP/php-extension-install.md)
5. 新增更新脚本`deploy.sh`
	- 在项目目录的同级，新增shell脚本，例如项目目录为project_name1,新建文件与此目录同级。
	- [deploy.sh内容](https://github.com/lcp0578/cheat-sheets/blob/master/src/Shell/deploy.sh.md)，注意修改WEB_PATH变量为项目目录，第一行不能有空格。
	- 增加可执行的权限，`chmod +x deploy.sh`
	- 处理完后，以后更新代码，可直接执行`./deploy.sh`。更新时，注意是否有错误信息
6. 修改Nginx配置项
	- 新增支持symfony的配置文件
		
        	# cd /usr/local/nginx/conf
            # vim enable-php-pathinfo-sf.conf
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
	- 修改nginx.conf
	
    		# vim /usr/local/nginx/conf/nginx.conf
            ...
            server
            {
                ...
                index index.html index.htm index.php app.php; # 新增app.php
                root  /home/wwwroot/default; # 修改为项目目录+/web
                ...
                include enable-php-pathinfo-sf.conf; #把enable-php.conf改为enable-php-pathinfo.conf
                ...
            
	- 修改fastcgi.conf
	
    		$ vim /usr/local/nginx/conf/fastcgi.conf
            #把原有配置为$document_root/ 改为 $document_root/../
            #fastcgi_param PHP_ADMIN_VALUE "open_basedir=$document_root/:/tmp/:/proc/"; 
            fastcgi_param PHP_ADMIN_VALUE "open_basedir=$document_root/../:/tmp/:/proc/";
	- 修改了配置文件一定要重启
7. 常见问题
	- 项目异常怎么办？
		看日志、看日志、看日志。重要的事情说三遍！比如nginx错误日志、php错误日志、symfony错误日志等等。
    - 清除生产环境的缓存
    
    		php bin/console cache:clear --env=prod
    - 动态的查看项目日志
    
    		#在项目目录下
            tail -f var/logs/prod.log #生产环境下日志
            tail -f var/log/dev.log #开发环境下日志