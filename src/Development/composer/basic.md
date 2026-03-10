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
- 创建一个新的项目

		composer create-project symfony/framework-standard-edition my_project_name "2.8.*"
     PS：它相当于执行了 git clone 命令后，将这个包的依赖安装到它自己的 vendor 目录。
- 搜索包信息

		$ composer search guzzle
        eightpoints/guzzle-bundle Integrates Guzzle into Symfony2, comes with WSSE Plugin for RESTful Interfaces
        eightpoints/guzzle-wsse-middleware WSSE Middleware for Guzzle, a PHP HTTP client library and framework for building RESTful web service clients
        guzzlehttp/guzzle Guzzle is a PHP HTTP client library
        guzzlehttp/promises Guzzle promises library
        guzzlehttp/psr7 PSR-7 message implementation that also provides common utility methods
        guzzlehttp/guzzle Guzzle is a PHP HTTP client library
        guzzlehttp/psr7 PSR-7 message implementation that also provides common utility methods
        guzzlehttp/promises Guzzle promises library
        php-http/guzzle6-adapter Guzzle 6 HTTP Adapter
        guzzle/guzzle PHP HTTP client. This library is deprecated in favor of https://packagist.org/packages/guzzlehttp/guzzle
        guzzlehttp/streams Provides a simple abstraction over streams of data
        guzzlehttp/ringphp Provides a simple API and specification that abstracts away the details of HTTP into a single PHP function.
        kevinrob/guzzle-cache-middleware A HTTP/1.1 Cache for Guzzle 6. It's a simple Middleware to be added in the HandlerStack. (RFC 7234)
        eightpoints/guzzle-bundle Integrates Guzzle 6.x, a PHP HTTP Client, into Symfony 2/3/4. Comes with easy and powerful configuration options and optional plugins.
        guzzlehttp/guzzle-services Provides an implementation of the Guzzle Command library that uses Guzzle service descriptions to describe web services, serialize requests, and parse responses into easy to use model structures.
        csa/guzzle-bundle A bundle integrating GuzzleHttp >= 4.0
        kitetail/zttp A developer-experience focused HTTP client, optimized for most common use cases.
        intercom/intercom-php Intercom API client built on top of Guzzle 6
        guzzlehttp/oauth-subscriber Guzzle OAuth 1.0 subscriber
        guzzlehttp/command Provides the foundation for building command-based web service clients
- 查看包信息

		composer show monolog/monolog
        name     : monolog/monolog
        descrip. : Sends your logs to files, sockets, inboxes, databases and various web services
        keywords : log, logging, psr-3
        versions : * 1.23.0
        type     : library
        license  : MIT License (MIT) (OSI approved) https://spdx.org/licenses/MIT.html#licenseText
        source   : [git] https://github.com/Seldaek/monolog.git fd8c787753b3a2ad11bc60c063cff1358a32a3b4
        dist     : [zip] https://api.github.com/repos/Seldaek/monolog/zipball/fd8c787753b3a2ad11bc60c063cff1358a32a3b4 fd8c787753b3a2ad11bc60c063cff1358a32a3b4
        names    : monolog/monolog, psr/log-implementation
  选项：

	- installed (-i): 列出已安装的依赖包。
	- platform (-p): 仅列出平台软件包（PHP 与它的扩展）。
	- self (-s): 仅列出当前项目的信息。

- 手动执行脚本
	composer.json中包含的run-script部分：
    
    	"scripts" : {
                "symfony-scripts" : [
                        "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
                        "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
                        "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
                        "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
                        "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile",
                        "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::prepareDeploymentTarget"
                ],
                "post-install-cmd" : "@symfony-scripts",
                "post-update-cmd" : "@symfony-scripts"
        },

	可执行如下命令：
    
    	composer run-script post-update-cmd

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