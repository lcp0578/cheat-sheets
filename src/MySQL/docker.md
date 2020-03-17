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
			- `-d` 
			- `-e`
			- `-v`
			- `-p`
			- `--name`
			- `--restart`
	- slave, 端口 3308
	
    		$ docker run -d -e MYSQL_ROOT_PASSWORD=lcp0578 --name=slave --restart=always -v ~/docker/mysql/slave/data:/var/lib/mysql -v ~/docker/mysql/slave/cnf:/etc/mysql/conf.d -p 3308:3306 mysql:8.0 
- 查看容器状态
