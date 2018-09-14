## Memcached 扩展安装
- libmemcached
> memcached support requires libmemcached. Use --with-libmemcached-dir=`<DIR>` to specify the prefix where libmemcached headers and library are located

	- libmemcached下载地址
		https://launchpad.net/libmemcached/+download
    - 编译安装
    
    		tar zxvf libmemcached-1.0.18.tar.gz 
            cd libmemcached-1.0.18
            ./configure --prefix=/usr/local/libmemcached --with-memcached
            make && make install
            PS: mac下安装报错：https://stackoverflow.com/questions/27004144/how-can-i-install-libmemcached-for-mac-os-x-yosemite-10-10-in-order-to-install-t
- 编译安装Memcached
> memcache扩展不支持php7，近几年未更新，故选择Memcached，鸟哥也在维护。

	- 安装步骤

            cd memcached-3.0.4
            /usr/local/Homebrew/Cellar/php/7.2.4/bin/phpize
            ./configure --with-php-config=/usr/local/Homebrew/Cellar/php/7.2.4/bin/php-config --enable-memcached --with-libmemcached-dir=/usr/local/libmemcached
            make && make install