## oci8 扩展安装
- oci8简介
> These functions allow you to access Oracle Database 12c, 11g, 10g, 9i and 8i. They support SQL and PL/SQL statements. Basic features include transaction control, binding of PHP variables to Oracle placeholders, and support for large object (LOB) types and collections. Oracle's scalability features such as Database Resident Connection Pooling (DRCP) and result caching are also supported.

- oci8依赖oracle instant client
	- oracle instant client下载地址
		[www.oracle.com/technetwork/database/database-technologies/instant-client/overview/index.html](https://www.oracle.com/technetwork/database/database-technologies/instant-client/overview/index.html)
        下载后解压至：`/usr/local/instantclient`，供编译时调用。
    - 编译安装([下载oci8扩展](http://pecl.php.net/package/oci8))
    		
    		$ tar zxvf oci8-2.1.8.tar.gz 
            $ cd oci8-2.1.8
            $ phpize
            $ ./configure --help
            .....
            --with-oci8=DIR Include Oracle Database OCI8 support. DIR defaults to $ORACLE_HOME.
                            Use --with-oci8=instantclient,/path/to/instant/client/lib
                            to use an Oracle Instant Client installation
            $ ./configure --with-oci8=instantclient,/usr/local/instantclient --with-php-config=/usr/local/php/bin/php-config
            $ make && make install
           