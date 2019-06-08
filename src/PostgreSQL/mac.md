## PostgreSQL mac下使用
- 安装
    ``` shell
    $ brew install postgresql
    ...
    To have launchd start postgresql now and restart at login:
      brew services start postgresql
    Or, if you don't want/need a background service you can just run:
      pg_ctl -D /usr/local/Homebrew/var/postgres start
    ```
- 初始化数据库
``` shell
$ initdb ~/postgres/data -E utf8
```
上面指定 `~/postgres/data` 为 PostgreSQL 的配置数据存放目录，并且设置数据库数据编码是 utf8。更多参数，查看`initdb --help` 命令帮助。
- 开启与关闭
	- 开启
	
			pg_ctl -D /Users/lcp0578/postgre/data -l /Users/lcp0578/postgre/logs/server.log start
	- 关闭
	
    		pg_ctl -D /Users/lcp0578/postgre/data stop -s -m fast
- 创建PostgreSQL用户

		$ createuser postgre -P # postgre为用户名
        Enter password for new role:
        Enter it again:
- 创建数据库

		$ createdb openresty_opm -O postgre -E UTF8 -e
        SELECT pg_catalog.set_config('search_path', '', false)
        CREATE DATABASE openresty_opm OWNER postgre ENCODING 'UTF8';
PS:创建了一个名为 `openresty_opm` 的数据库，并指定 `postgre` 为改数据库的拥有者（owner），数据库的编码（encoding）是 UTF8，参数 "-e" 是指把数据库执行操作的命令显示出来。
更多数据库创建信息可以 `createdb --help` 查看。
- 连接数据库

		$ psql -U postgre -d openresty_opm
        psql (11.3)
        Type "help" for help.

        openresty_opm=> \l
                                          List of databases
             Name      |  Owner  | Encoding |   Collate   |    Ctype    |  Access privileges
        ---------------+---------+----------+-------------+-------------+---------------------
         openresty_opm | postgre | UTF8     | zh_CN.UTF-8 | zh_CN.UTF-8 |
         postgres      | lcp0578 | UTF8     | zh_CN.UTF-8 | zh_CN.UTF-8 |
         template0     | lcp0578 | UTF8     | zh_CN.UTF-8 | zh_CN.UTF-8 | =c/lcp0578         +
                       |         |          |             |             | lcp0578=CTc/lcp0578
         template1     | lcp0578 | UTF8     | zh_CN.UTF-8 | zh_CN.UTF-8 | =c/lcp0578         +
                       |         |          |             |             | lcp0578=CTc/lcp0578
        (4 rows)

        openresty_opm=>
- 导入sql文件

		 $ psql -d openresty_opm -U postgre -f ./init.sql
- 查看表名称

		$ psql -U postgre -d openresty_opm
        psql (11.3)
        Type "help" for help.

        openresty_opm=> \dt
                    List of relations
         Schema |     Name      | Type  |  Owner
        --------+---------------+-------+---------
         public | access_tokens | table | postgre
         public | org_ownership | table | postgre
         public | orgs          | table | postgre
         public | uploads       | table | postgre
         public | users         | table | postgre
        (5 rows)

        openresty_opm=>