## Mac 下 利用 docker 构建 MySQL 集群
- 下载镜像

		$ docker pull mysql:8.0
- 新建挂载目录以及挂载的配置文件

		$ mkdir ~/docker/mysql/master/data
		$ mkdir ~/docker/mysql/master/cnf
		$ mkdir ~/docker/mysql/slave/data
		$ mkdir ~/docker/mysql/slave/cnf
- 编辑配置文件

		$ vim ~/docker/mysql/master/cnf/my.cnf
        [mysqld]
        server_id=1
        
        $ vim ~/docker/mysql/slave/cnf/my.cnf
        [mysqld]
        server_id=2
- 构建两个MySQL容器
	- master，端口 3307
	
    		$ docker run -d -e MYSQL_ROOT_PASSWORD=lcp0578 --name=master --restart=always -v ~/docker/mysql/master/data:/var/lib/mysql -v ~/docker/mysql/master/cnf:/etc/mysql/conf.d -p 3307:3306 mysql:8.0
		- 命令说明
			- `-d` 代表后台运行
			- `-e` 修改环境变量
			- `-v` 目录挂载与映射
			- `-p` 端口映射
			- `--name` 设置容器名称
			- `--restart` 容器异常挂掉后的重启策略
	- slave, 端口 3308
	
    		$ docker run -d -e MYSQL_ROOT_PASSWORD=lcp0578 --name=slave --restart=always -v ~/docker/mysql/slave/data:/var/lib/mysql -v ~/docker/mysql/slave/cnf:/etc/mysql/conf.d -p 3308:3306 mysql:8.0 
- 查看容器状态

		$ docker ps
        CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                               NAMES
        515af0558e89        mysql:8.0           "docker-entrypoint.s…"   13 seconds ago      Up 11 seconds       33060/tcp, 0.0.0.0:3308->3306/tcp   slave
        a728461c784b        mysql:8.0           "docker-entrypoint.s…"   3 minutes ago       Up 3 minutes        33060/tcp, 0.0.0.0:3307->3306/tcp   master
- 进入容器bash, `exit`退出

		//根据容器名称进入
		$ docker exec -it master bash
        $ docker exec -it slave bash
        //或者，根据容器id进入
        $ docker exec -it 515af0558e89 bash
        $ docker exec -it a728461c784b bash
        //命令说明： -it以交互模式打开pseudo-TTY，执行bash
- 在本机连接master、slave数据库(mac下-P参数有bug)

		$ mysql -uroot -P3307 -p
        $ mysql -uroot -P3308 -p
- 查看容器ip，IPAddress

		$ docker inspect master // "IPAddress": "172.17.0.2"
        $ docker inspect slave  // "IPAddress": "172.17.0.3"
- 配置主从
	- master
	
    		mysql> create user 'mysql_slave_3'@'172.17.0.3' identified by 'mysql@slave_3';
			Query OK, 0 rows affected (0.00 sec)
	
			mysql> grant replication slave on *.* to 'mysql_slave_3'@'172.17.0.3';
			Query OK, 0 rows affected (0.01 sec)

	- slave配置配置
	
    		mysql> CHANGE MASTER TO MASTER_HOST='172.17.0.2', MASTER_USER='mysql_slave_3', MASTER_PASSWORD='mysql@slave_3', MASTER_LOG_FILE='mysql-bin.000001'
			Query OK, 0 rows affected, 2 warnings (0.06 sec)
            
            mysql> start slave;
            Query OK, 0 rows affected (0.00 sec)

            mysql> show slave status