## mac install oracle by docker
- 在mac上安装docker
	- 下载地址
	https://store.docker.com/editions/community/docker-ce-desktop-mac
    - 查看docker
    
    		docker info
- 获取oracle的build file
	
    	cd ~/iDocker //可以是任意目录
    	git clone https://github.com/oracle/docker-images
- 获取数据库文件
	下载地址：http://www.oracle.com/technetwork/database/enterprise-edition/downloads/index.html
    下载：linuxx64_12201_database.zip
    放置到：`/Users/lcp0578/iDocker/docker-images/OracleDatabase/SingleInstance/dockerfiles/12.2.0.1`
- 部署oracle到docker

		$ cd /Users/lcp0578/iDocker/docker-images/OracleDatabase/SingleInstance/dockerfiles
        $ ./buildDockerImage.sh -v 12.2.0.1 -e
        其中Parameters:
           -v: version to build
               Choose one of: 11.2.0.2  12.1.0.2  12.2.0.1
           -e: creates image based on 'Enterprise Edition'
           -s: creates image based on 'Standard Edition 2'
           -x: creates image based on 'Express Edition'
           -i: ignores the MD5 checksums
- 安装oracle实例

		docker run --name oracle -p 1521:1521 -p 5500:5500 -v /Users/lcp0578/Oracle/oradata:/opt/oracle/oradata oracle/database:12.2.0.1-ee
        其中Parameters:
           --name:        The name of the container (default: auto generated)
           -p:            The port mapping of the host port to the container port. 
                          Two ports are exposed: 1521 (Oracle Listener), 5500 (OEM Express)
           -e ORACLE_SID: The Oracle Database SID that should be used (default: ORCLCDB)
           -e ORACLE_PDB: The Oracle Database PDB name that should be used (default: ORCLPDB1)
           -e ORACLE_PWD: The Oracle Database SYS, SYSTEM and PDB_ADMIN password (default: auto generated)
           -e ORACLE_CHARACTERSET:
                          The character set to use when creating the database (default: AL32UTF8)
           -v             The data volume to use for the database.
                          Has to be owned by the Unix user "oracle" or set appropriately.
                          If omitted the database will not be persisted over container recreation.
- 启动、停止

		docker stop oracle
		docker start oracle
- 查看alertlog

		docker logs -f oracle
- 修改密码

		lcp0578-MacBook-Pro:12.2.0.1 lcp0578$ docker exec oracle ./setPassword.sh lcp0578
        The Oracle base remains unchanged with value /opt/oracle

        SQL*Plus: Release 12.2.0.1.0 Production on Sat Sep 22 03:28:00 2018

        Copyright (c) 1982, 2016, Oracle.  All rights reserved.

        Connected to:
        Oracle Database 12c Enterprise Edition Release 12.2.0.1.0 - 64bit Production

        SQL>
        User altered.

        SQL>
        User altered.

        SQL>
        Session altered.

        SQL>
        User altered.

        SQL> Disconnected from Oracle Database 12c Enterprise Edition Release 12.2.0.1.0 - 64bit Production
- 连接时的SID为：orclcdb