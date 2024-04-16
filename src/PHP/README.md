## PHP
- 单个页面进行调试  
	
		ini_set("display_errors", "On");
		error_reporting(E_ALL);
- [php.ini 常用配置项](php.ini.md)
- [PHP Extension Install](php-extension-install.md) PHP扩展编译安装
- [phpize报错，升级autoconf](autoconf.md)
- [Memcached](memcached.md) PHP Memcached扩展安装
- [oci8](oci8.md)PHP Oracle连接扩展
- [Socket](Socket.md)
- [对数组进行排序](array_sorting.md)
- [control structures alternative syntax](alternative-syntax.md) 流程控制的替代语法
- [SOAP](soap.md) 调用SOAP服务
- [preg_match VS preg_match_all](preg_match.md) 正则匹配对比
- [PHP Functions](functions/README.md) PHP常用函数
- [PHP Extensions](extensions/README.md) PHP常用扩展
- [php-lua](php_lua.md) PHP调用lua
- [fgets](fgets.md) fget读取的宽字节字符集问题
- [DateTimeImmutable vs DateTime](DateTimeImmutable.md)
- [php-fpm](php-fpm.md)
- [declare(strict_type=1) 严格类型检查模式](strict_types.md)
- [phploc](phploc.md) A tool for quickly measuring the size of a PHP project.
- [Laminas](laminas.md) Laminas Project, the enterprise-ready PHP Framework and components
- [Xdebug - Debugger and Profiler Tool for PHP](Xdebug.md)
- [PHP Coding Standards Fixer (PHP CS Fixer) ](PHPCSFixer.md)
- [phar归档](phar.md)
- [php 7 新特性](php7.md)
- [PHP 8 相关](php8/README.md)
	- [PHP 8 新特性概览](php8/Features.md)
	- [PHP 8 新特性之 match表达式](php8/match.md)
	- [PHP 8 新特性之 Named Parameter](php8/NamedParameter.md)
	- [PHP 8 新特性之 Attributes（注解）](php8/Attributes.md)
	- [PHP 8 新特性之 nullsafe_operator](php8/nullsafe_operator.md)
	- [PHP 8 新特性之 static return type](php8/static_return_type.md)
	- [PHP 8.1 Fibers（纤程）](php8/Fibers.md)
	- [PHP 8.1 Enum 枚举](php8/Enum.md)
	- [PHP 8 多版本编译安装](php8/install.md)