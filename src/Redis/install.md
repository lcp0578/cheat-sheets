## Redis install 源码编译安装
- 下载源码包，并解压

		wget https://download.redis.io/redis-stable.tar.gz
		tar -xzvf redis-stable.tar.gz
		cd redis-stable

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
        cp ~/redis-stable/redis.conf conf/
      
- 修改配置文件

		daemonize no 改为daemonize yes
        requirepass lcp0578 # 设置密码
- 启动redis

		cd /usrlocal/redis
        ./bin/redis-server conf/redis.conf
- 关闭redis

		./bin/redis-cli -a lcp0578 shutdown # -a 后面跟密码
- 查看redis版本信息

		# ./bin/redis-cli -v
		redis-cli 8.2.3
		# ./bin/redis-server -v
		Redis server v=8.2.3 sha=00000000:0 malloc=jemalloc-5.3.0 bits=64 build=d6532566e8f8c429
		# ./bin/redis-cli -a lcp0578
		Warning: Using a password with '-a' or '-u' option on the command line interface may not be safe.
		127.0.0.1:6379> info server
		# Server
		redis_version:8.2.3
		redis_git_sha1:00000000
		redis_git_dirty:0
		redis_build_id:d6532566e8f8c429
		redis_mode:standalone
		os:Linux 4.19.0-91.82.112.uelc20.x86_64 x86_64
		arch_bits:64
		monotonic_clock:POSIX clock_gettime
		multiplexing_api:epoll
		atomicvar_api:c11-builtin
		gcc_version:8.5.0
		process_id:1319506
		process_supervised:no
		run_id:7ce35a644370d246d567c31fefd4b8f62d3a8c0e
		tcp_port:6379
		server_time_usec:1762911603768772
		uptime_in_seconds:98
		uptime_in_days:0
		hz:10
		configured_hz:10
		lru_clock:1303923
		executable:/usr/local/redis/./bin/redis-server
		config_file:/usr/local/redis/./conf/redis.conf
		io_threads_active:0
		listener0:name=tcp,bind=127.0.0.1,bind=-::1,port=6379
		127.0.0.1:6379> 
