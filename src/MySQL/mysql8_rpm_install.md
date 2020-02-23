## MySQL8 rpm install
- centos 7默认是mariadb数据库，再去安装mysql之前要先卸载mariadb

		$ rpm -qa | grep mariadb
		$ rpm -e --nodeps mariadb-libs-8.0.15-2.el7_0.x86_64
- 官网下载 rpm包 mysql-8.0.19-1.el7.x86_64.rpm-bundle.tar

        rpm -ivh mysql-community-common-8.0.19-1.el7.x86_64.rpm
        rpm -ivh mysql-community-embedded-compat-8.0.19-1.el7.x86_64.rpm
        rpm -ivh mysql-community-libs-8.0.19-1.el7.x86_64.rpm
        rpm -ivh mysql-community-libs-compat-8.0.19-1.el7.x86_64.rpm
        rpm -ivh mysql-community-devel-8.0.19-1.el7.x86_64.rpm
        rpm -ivh mysql-community-client-8.0.19-1.el7.x86_64.rpm
        rpm -ivh mysql-community-server-8.0.19-1.el7.x86_64.rpm
