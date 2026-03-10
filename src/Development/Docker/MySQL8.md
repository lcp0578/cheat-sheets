## Docker 安装MySQL8
- https://hub.docker.com/_/mysql
- 创建三个目录，创建MySQL容器时会挂载为容器的卷（Volume），用于Docker和宿主机之间共享文件，包括配置文件、数据文件和日志文件。
	- 什么是卷（Volume）？命令 `docker -v` 中的`-v`就是这个卷，`-v`只是`--volume`的简写

			# mkdir -p /home/mysql8/log
			# mkdir -p /home/mysql8/data
			# mkdir -p /home/mysql8/conf
- 拉取镜像

		docker pull mysql:latest
- 使用自定义的 `custom.cnf` 配置文件。
	- 在 `/home/mysql8/conf/` 目录下创建自定义的 `custom.cnf` 配置文件。文件名随意，文件格式必须为 `.cnf` 。

			vim /home/mysql8/conf/custom.cnf
	- MySQL默认配置文件 `/etc/my.cnf` 末尾中有这么一行：!`includedir /etc/mysql/conf.d/` ，意思是，在 `/etc/mysql/conf.d/` 目录(此目录会映射到`/home/mysql8/conf/`)下新建自定义的配置文件 `custom.cnf`也会被读取到，而且还是优先读取的（Docker Hub中的MySQL教程文档有说到）。
	- 添加容器运行的配置参数如下：

			[mysqld]
			init-connect="SET collation_connection=utf8mb4_0900_ai_ci"
			init_connect="SET NAMES utf8mb4"
			skip-character-set-client-handshake
- 创建容器并运行

		docker run --name mysql8 -v /home/mysql8/log:/var/log/mysql -v /home/mysql8/data:/var/lib/mysql -v /home/mysql8/conf:/etc/mysql/conf.d -p 3308:3306 -e MYSQL_ROOT_PASSWORD=lcp@0578 -d mysql --lower_case_table_names=1
	- 参数说明
		- `--name`: 为容器指定一个名称
		- `-v`: 将指定的文件夹挂载为容器的卷(Volume),用来共享文件
		- `-p`: 指定端口映射，hostPost:containerPort
		- `-e`: 设置环境变量
		- `-d`: 后台运行容器，并返回容器ID，也即启动守护式容器
- 修改权限
	
		CREATE USER 'root'@'172.17.0.1' IDENTIFIED BY 'lcp@0578';
		GRANT ALL PRIVILEGES ON *.* TO 'root'@'172.17.0.1';
		flush privileges;


