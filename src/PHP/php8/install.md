## PHP 8 多版本编译安装
- 安装libxslt
	- 下载：https://download.gnome.org/sources/libxslt/

			 tar xvJf libxslt-1.1.29.tar.xz
			 autoreconf --install
			 ./configure
			 make && make install
- 安装sqlite
	- 下载源码包：https://www.sqlite.org/download.html

			$ tar xvzf sqlite-autoconf-3450300.tar.gz
			$ cd sqlite-autoconf-3450300
			$ ./configure --prefix=/usr/local
			$ make
			$ make install
- 安装oniguruma
	- 下载地址:	 https://github.com/kkos/oniguruma 

			 cd oniguruma
			 ./autogen.sh && ./configure --prefix=/usr
			 make && make install

- 编译命令

		./configure --prefix=/usr/local/php81 --with-config-file-path=/usr/local/php81/etc --with-config-file-scan-dir=/usr/local/php81/conf.d --enable-fpm --with-fpm-user=www --with-fpm-group=www --with-iconv=/usr/local --with-freetype=/usr/local/freetype --with-jpeg --with-zlib --enable-xml --disable-rpath --enable-bcmath --enable-shmop --enable-sysvsem --with-curl --enable-mbregex --enable-mbstring --enable-intl --enable-pcntl --enable-ftp --enable-gd --with-openssl --with-mhash --enable-pcntl --enable-sockets --with-zip --enable-soap --with-gettext --enable-exif --enable-opcache --with-xsl --with-pear --with-webp --with-pdo-pgsql
		make && make install
- 复制`php.ini`

		cp ~/php-8.1.28/php.ini-production /usr/local/php81/etc/php.ini
- redis扩展

		/usr/local/php81/bin/phpize 
		./configure --with-php-config=/usr/local/php81/bin/php-config
		make && make install
- 配置环境变量

		export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/php8.1/lib/php/extensions/no-debug-non-zts-20210902/
		alias composer8='/usr/local/php8.1/bin/php /usr/local/bin/composer'