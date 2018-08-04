## composer的基础使用
- 加载一个包

    	composer require symfony/finder
	指定版本号：

		composer require knplabs/console-service-provider:2.x
    开发版包 
    		
        composer require knplabs/console-service-provider:2.x-dev
        composer require gregwar/image-bundle:dev-master

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
- 查看包信息和版本号信息

		composer show -a kitlabs/kit-generator-bundle
        name     : kitlabs/kit-generator-bundle
        descrip. : extend SensioGeneratorBundle
        keywords : Generator Bundle, generate crud, generate form
        versions : dev-master, v0.2.7, v0.2.6, v0.2.5, v0.2.4, v0.2.3, v0.2.2, v0.2.1, v0.2.0, v0.1.3, v0.1.2
        type     : symfony-bundle
        license  : MIT License (MIT) (OSI approved) https://spdx.org/licenses/MIT.html#licenseText
        source   : [git] https://github.com/kitlabs-cn/KitGeneratorBundle.git 06a2e6f09cc8b71f5aeef1b3ef88fa7fef1fcf78
        dist     : [zip] https://api.github.com/repos/kitlabs-cn/KitGeneratorBundle/zipball/06a2e6f09cc8b71f5aeef1b3ef88fa7fef1fcf78 06a2e6f09cc8b71f5aeef1b3ef88fa7fef1fcf78
        names    : kitlabs/kit-generator-bundle

        autoload
        psr-4
        Kit\GeneratorBundle\ => .

        requires
        php >=5.5.9
        sensio/generator-bundle >=v3.0
        knplabs/knp-paginator-bundle ^2.8