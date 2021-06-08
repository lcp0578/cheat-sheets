## MySQL8 rpm install
- CentOS 6
	- 卸载CentOS 6自带的MySQL
	
    		# rpm -qa | grep -i mysql    
			mysql-libs-5.1.73-7.el6.x86_64
            # rpm -e mysql-libs-5.1.73-7.el6.x86_64 --nodeps 
	- 安装MySQL依赖环境
	
    		# yum -y install wget gcc-c++ ncurses ncurses-devel cmake make perl bison openssl openssl-devel gcc* libxml2 libxml2-devel curl-devel libjpeg* libpng* freetype* make gcc-c++ cmake bison-devel ncurses-devel bison perl perl-devel perl perl-devel net-tools* numactl* 
	- 添加mysql用户

            # groupadd mysql
            # useradd -g mysql mysql
	- 下载并安装MySQL的RPM安装包

			# wget https://dev.mysql.com/get/Downloads/MySQL-8.0/mysql-8.0.25-1.el6.x86_64.rpm-bundle.tar
            # rpm -ivh mysql-community-common-8.0.18-1.el6.x86_64.rpm
            # rpm -ivh mysql-community-libs-8.0.18-1.el6.x86_64.rpm
            # rpm -ivh mysql-community-client-8.0.18-1.el6.x86_64.rpm
            # rpm -ivh mysql-community-server-8.0.18-1.el6.x86_64.rpm
	- 初始化MySQL数据
            # mkdir -p /usr/local/mysql
            # chown -R mysql.mysql /usr/local/mysql
            # mysqld --initialize --user=mysql --basedir=/usr/local/mysql --datadir=/usr/local/mysql/var
	- 启动MySQL
	
    		# service mysqld start
            [Server] A temporary password is generated for root@localhost: fSa1wL)V=XO&
	- 修改密码
			
            mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'xxxx';
			Query OK, 0 rows affected (0.03 sec)
- CentOS 7
    - 默认是mariadb数据库，再去安装mysql之前要先卸载mariadb

            $ rpm -qa | grep mariadb
            $ rpm -e --nodeps mariadb-libs-8.0.15-2.el7_0.x86_64
    - 官网下载 rpm包 mysql-8.0.19-1.el7.x86_64.rpm-bundle.tar

            $ rpm -ivh mysql-community-common-8.0.19-1.el7.x86_64.rpm
            $ rpm -ivh mysql-community-embedded-compat-8.0.19-1.el7.x86_64.rpm
            $ rpm -ivh mysql-community-libs-8.0.19-1.el7.x86_64.rpm
            $ rpm -ivh mysql-community-libs-compat-8.0.19-1.el7.x86_64.rpm
            $ rpm -ivh mysql-community-devel-8.0.19-1.el7.x86_64.rpm
            $ rpm -ivh mysql-community-client-8.0.19-1.el7.x86_64.rpm
            $ rpm -ivh mysql-community-server-8.0.19-1.el7.x86_64.rpm
    - 操作命令:
        - 开启：`systemctl start mysqld`
        - 停止：`systemctl stop mysqld`
        - 重启：`systemctl restart mysqld`
    - 修改数据存储的配置
        - 由：

                datadir=/var/lib/mysql
        - 改为：

                datadir=/home/data/mysql
        - 修改权限

                $ chown –R mysql:mysql /home/data/mysql



