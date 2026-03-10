## composer cheat sheet

1. 为某个项目设置中国的镜像

    	composer config repo.packagist composer https://packagist.phpcomposer.com
	
	站点地址：[https://pkg.phpcomposer.com/](https://pkg.phpcomposer.com/)

2. 加载一个包

    	composer require symfony/finder
	指定版本号：

		composer require knplabs/console-service-provider:2.x

3. 更新自动加载的文件
	
		composer dump-autoload

4. 设置proxy，并升级composer
	
		HTTP_PROXY=http://ip:port && composer self-update
5. 清除缓存

		composer clearcache
6. 关于出现PHP版本异常错误
	
		requires php >=5.6 -> your PHP version (7.1.7) overridden by "config.platform.php" version (5.5.9) does not satisfy that requirement.
	删除相关配置项即可：
		
		{
		    "config": {
		        "platform":{
		            "php":"5.5.9"
		        }
		    }
		}
7. 优化自动加载的文件，提升效率
	
		composer dump-autoload --optimize
8. [composer.json.jolicode.com](http://composer.json.jolicode.com/)
9. [composer config](https://getcomposer.org/doc/06-config.md)