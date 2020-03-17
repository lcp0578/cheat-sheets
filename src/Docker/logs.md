## docker logs [id]
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