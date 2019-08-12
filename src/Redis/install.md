## Redis install 源码编译安装
- 下载源码包，并解压

		tar -zxvf redis-5.0.5.tar.gz
- 建立安装目录

		mkdir /usr/local/redis
- 编译

		# sudo make PREFIX=/usr/local/redis install
        
        Hint: It's a good idea to run 'make test' ;)

        INSTALL install
        INSTALL install
        INSTALL install
        INSTALL install
        INSTALL install
        
- 设置配置文件
		
        cd /usr/local/redis
        mkdir conf
        cp ~/redis-5.0.5/redis.conf conf/
      
- 修改配置文件

		daemonize no 改为daemonize yes
        requirepass lcp0578 # 设置密码
- 启动redis

		cd /usrlocal/redis
        ./bin/redis-server conf/redis.conf
- 关闭redis

		./bin/redis-cli -a lcp0578 shutdown # -a 后面跟密码