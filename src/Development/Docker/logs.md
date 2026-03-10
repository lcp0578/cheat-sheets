## docker logs 使用
- 查看容器id

		$ docker ps -a
        CONTAINER ID        IMAGE                         COMMAND                  CREATED             STATUS                       PORTS                                            NAMES
        2fcfe0163920        mysql:8.0                     "docker-entrypoint.s…"   14 seconds ago      Exited (1) 12 seconds ago                                                     dazzling_roentgen
- 查看启动异常的日志

		$  docker logs 2fcfe0163920
        2020-03-17 15:02:28+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian10 started.
        2020-03-17 15:02:29+00:00 [ERROR] [Entrypoint]: mysqld failed while attempting to check config
            command was: mysqld -e MYSQL_ROOT_PASSWORD=lcp0578 --name=master --restart=always -v /Users/lcp0578/docker/mysql/master/data:/var/lib/mysql -v /Users/lcp0578/docker/mysql/master/cnf:/etc/mysql/conf.d -p 3307:3306 --verbose --help
            Enter password: mysqld: Can not perform keyring migration : Invalid --keyring-migration-source option.
        2020-03-17T15:02:29.015576Z 0 [ERROR] [MY-011084] [Server] Keyring migration failed.
        2020-03-17T15:02:29.019777Z 0 [ERROR] [MY-010119] [Server] Aborting
- 实时查看日志

		$sudo docker logs -f -t --tail 行数 容器名[containerID]  
	- `-f`  按日志输出
	- `-t`  显示时间戳
	- 示例

			# docker logs -f -t --tail 20 tileserver_2.3.0
			2024-01-27T00:59:03.726164447Z 2024-01-27 00:59:03.725 WARN tileserver [http-nio-8092-exec-235] [com.alibaba.druid.pool.DruidDataSource:1414] get connection timeout retry : 1
			2024-01-27T00:59:03.732297412Z 2024-01-27 00:59:03.731 WARN tileserver [http-nio-8092-exec-230] [com.alibaba.druid.pool.DruidDataSource:1414] get connection timeout retry : 1
			2024-01-27T00:59:03.931642568Z 2024-01-27 00:59:03.931 ERROR tileserver [http-nio-8092-exec-242] [org.freeserver.htc.aop.GlobalExceptionController:31] nested exception is org.apache.ibatis.exceptions.PersistenceException: 
			2024-01-27T00:59:03.931662644Z ### Error querying database.  Cause: org.springframework.jdbc.CannotGetJdbcConnectionException: Failed to obtain JDBC Connection; nested exception is com.alibaba.druid.pool.GetConnectionTimeoutException: wait millis 60000, active 0, maxActive 500, creating 0, createErrorCount 4
			2024-01-27T00:59:03.931671264Z ### The error may exist in class path resource [mapper/TileCacheMapper.xml]
			2024-01-27T00:59:03.931678270Z ### The error may involve org.freeserver.htc.dao.TileCacheMapper.queryTileImageInfo
			2024-01-27T00:59:03.931685473Z ### The error occurred while executing a query
			2024-01-27T00:59:03.931692358Z ### Cause: org.springframework.jdbc.CannotGetJdbcConnectionException: Failed to obtain JDBC Connection; nested exception is com.alibaba.druid.pool.GetConnectionTimeoutException: wait millis 60000, active 0, maxActive 500, creating 0, createErrorCount 4
			2024-01-27T00:59:04.094096465Z 2024-01-27 00:59:04.093 ERROR tileserver [http-nio-8092-exec-244] [org.freeserver.htc.aop.GlobalExceptionController:31] nested exception is org.apache.ibatis.exceptions.PersistenceException: 