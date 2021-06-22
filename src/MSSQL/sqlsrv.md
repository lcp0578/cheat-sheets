## php安装sqlsrv扩展
- 下载  
	下载地址：[https://github.com/Microsoft/msphpsql/releases](https://github.com/Microsoft/msphpsql/releases)
- 配置(php.ini)

        extension=php_sqlsrv_72_ts.dll
        extension=php_pdo_sqlsrv_72_ts.dll
- 测试

		php -m | grep "sqlsrv"
- 在Liunx下需要安装ODBC driver

        #Download appropriate package for the OS version
        #Choose only ONE of the following, corresponding to your OS version

        #Red Hat Enterprise Server 6
        curl https://packages.microsoft.com/config/rhel/6/prod.repo > /etc/yum.repos.d/mssql-release.repo

        #Red Hat Enterprise Server 7 and Oracle Linux 7
        curl https://packages.microsoft.com/config/rhel/7/prod.repo > /etc/yum.repos.d/mssql-release.repo

        #Red Hat Enterprise Server 8 and Oracle Linux 8
        curl https://packages.microsoft.com/config/rhel/8/prod.repo > /etc/yum.repos.d/mssql-release.repo

        exit
        sudo yum remove unixODBC-utf16 unixODBC-utf16-devel #to avoid conflicts
        sudo ACCEPT_EULA=Y yum install -y msodbcsql17
        # optional: for bcp and sqlcmd
        sudo ACCEPT_EULA=Y yum install -y mssql-tools
        echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
        source ~/.bashrc
        # optional: for unixODBC development headers
        sudo yum install -y unixODBC-devel
- openssl报错
	- [ODBC Driver 17 for SQL Server]SSL Provider: [error:1425F102:SSL routines:ssl_choose_client_version:unsupported protocol] (-1) (SQLDriverConnect)'
	- 修改/etc/crypto-policies/back-ends/opensslcnf.config
	
    		MinProtocol = TLSv1
- sqlcmd测试登录

		sqlcmd -S tcp:192.14.10.38,1433\db_name_xxx -U Username_XXX -P password_XXXX