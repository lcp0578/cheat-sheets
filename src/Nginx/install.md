## Nginx 源码编译安装
- 配置vim（.conf文件语法高亮）

		nginx-1.16.0 lcp0578$ cp -R contrib/vim/* ~/.vim/
- 源码目录

		$ ll
        total 1496
        drwxr-xr-x@ 13 lcp0578  staff     442  4 23 21:13 .
        drwxr-xr-x   4 lcp0578  staff     136  6  8 15:09 ..
        -rw-r--r--@  1 lcp0578  staff  296223  4 23 21:13 CHANGES
        -rw-r--r--@  1 lcp0578  staff  451813  4 23 21:13 CHANGES.ru
        -rw-r--r--@  1 lcp0578  staff    1397  4 23 21:12 LICENSE
        -rw-r--r--@  1 lcp0578  staff      49  4 23 21:12 README
        drwxr-xr-x@ 25 lcp0578  staff     850  4 23 21:12 auto
        drwxr-xr-x@ 11 lcp0578  staff     374  6  8 15:19 conf
        -rwxr-xr-x@  1 lcp0578  staff    2502  4 23 21:12 configure
        drwxr-xr-x@  6 lcp0578  staff     204  4 23 21:12 contrib
        drwxr-xr-x@  4 lcp0578  staff     136  4 23 21:12 html
        drwxr-xr-x@  3 lcp0578  staff     102  4 23 21:12 man
        drwxr-xr-x@  9 lcp0578  staff     306  4 23 21:12 src
- 安装pcre (PCRE - Perl Compatible Regular Expressions)
	下载后，解压到`/usr/local/pcre`
- 安装nginx

		$ sudo ./configure --prefix=/usr/local/nginx --with-pcre=/usr/local/pcre
        $ sudo make
        $ sudo make install
- 测试

		$ ./sbin/nginx -c conf/nginx.conf