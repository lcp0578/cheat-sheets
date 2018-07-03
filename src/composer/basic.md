## composer的基础使用
- 加载一个包

    	composer require symfony/finder
	指定版本号：

		composer require knplabs/console-service-provider:2.x
    开发版包 
    		
        composer require knplabs/console-service-provider:2.x-dev

- 更新自动加载的文件
	
		composer dump-autoload

- 设置proxy，并升级composer
	
		HTTP_PROXY=http://ip:port && composer self-update
- 清除缓存

		composer clearcache
- 关于出现PHP版本异常错误
	
		requires php >=5.6 -> your PHP version (7.1.7) overridden by "config.platform.php" version (5.5.9) does not satisfy that requirement.
	删除相关配置项即可：
		
		{
		    "config": {
		        "platform":{
		            "php":"5.5.9"
		        }
		    }
		}
- 优化自动加载的文件，提升效率
	
		composer dump-autoload --optimize