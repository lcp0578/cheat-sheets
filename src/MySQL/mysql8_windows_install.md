## MySQL 8 windows install
#### 下载zip包，解压到对应目录

	D:\phpStudy\MySQL\bin>mysqld --initialize --console
    2018-07-06T10:49:30.859001Z 0 [System] [MY-013169] [Server] D:\phpStudy\MySQL
    n\mysqld.exe (mysqld 8.0.11) initializing of server in progress as process 54
    2018-07-06T10:49:36.705653Z 5 [Note] [MY-010454] [Server] A temporary passwor
    s generated for root@localhost: +l.Tmho:R5g2 // 生成的默认密码在这里
    2018-07-06T10:49:39.359279Z 0 [System] [MY-013170] [Server] D:\phpStudy\MySQL
    n\mysqld.exe (mysqld 8.0.11) initializing of server has completed

    D:\phpStudy\MySQL\bin>mysql -u root -p
    Enter password: ************
    Welcome to the MySQL monitor.  Commands end with ; or \g.
    Your MySQL connection id is 8
    Server version: 8.0.11

    Copyright (c) 2000, 2018, Oracle and/or its affiliates. All rights reserved.

    Oracle is a registered trademark of Oracle Corporation and/or its
    affiliates. Other names may be trademarks of their respective
    owners.
#### 修改密码

	D:\phpStudy\MySQL\bin>mysqladmin -u root -p password
    Enter password: ************
    New password: *******
    Confirm new password: *******
    Warning: Since password will be sent to server in plain text, use ssl connection
     to ensure password safety.

    D:\phpStudy\MySQL\bin>mysql -u root -p
    Enter password: *******
    Welcome to the MySQL monitor.  Commands end with ; or \g.
    Your MySQL connection id is 11
    Server version: 8.0.11 MySQL Community Server - GPL

    Copyright (c) 2000, 2018, Oracle and/or its affiliates. All rights reserved.

    Oracle is a registered trademark of Oracle Corporation and/or its
    affiliates. Other names may be trademarks of their respective
    owners.

    Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

    mysql>