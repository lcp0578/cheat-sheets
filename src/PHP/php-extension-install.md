## PHP Extension Install
- PECL 安装(PECL:PHP Extension Community Library)

		pecl install swoole
- 源码安装（以swoole为例）
	1. 第一步，准备源码
		swoole源码下载地址： [https://github.com/swoole/swoole-src/releases](https://github.com/swoole/swoole-src/releases)
	2. 开始安装
		
			tar -zxvf swoole-src-1.9.16.tar.gz
			cd swoole-src-1.9.6
			phpize 
			./configure --with-php-config=/usr/local/php/bin/php-config
			make && make install
		PS:
		- phpize:a shell script to generate a configure script for PHP extensions
		- php-config:是一个简单的命令行脚本用于获取所安装的 PHP 配置的信息。
		- --with-php-config: 在编译扩展时，如果安装有多个 PHP 版本，可以在配置时用 --with-php-config 选项来指定使用哪一个版本编译，该选项指定了相对应的 php-config 脚本的路径。
		
	3. 修改php.ini
			
			extension=swoole.so
	4. 测试模块是否已成功安装 
		
			php -m | grep swoole