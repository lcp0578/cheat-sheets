## maker bundle 生成器bundle
> http://symfony.com/blog/introducing-the-symfony-maker-bundle

- symfony4 安装完后，默认不会再带有生成器bundle

		$ php bin/console  list
		Symfony 4.0.3 (kernel: src, env: dev, debug: true)
		
		Usage:
		  command [options] [arguments]
		
		Options:
		  -h, --help            Display this help message
		  -q, --quiet           Do not output any message
		  -V, --version         Display this application version
		      --ansi            Force ANSI output
		      --no-ansi         Disable ANSI output
		  -n, --no-interaction  Do not ask any interactive question
		  -e, --env=ENV         The environment name [default: "dev"]
		      --no-debug        Switches off debug mode
		  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output,
		 2 for more verbose output and 3 for debug
		
		Available commands:
		  about                   Displays information about the current project
		  help                    Displays help for a command
		  list                    Lists commands
		 assets
		  assets:install          Installs bundles web assets under a public directory
		 cache
		  cache:clear             Clears the cache
		  cache:pool:clear        Clears cache pools
		  cache:pool:prune        Prune cache pools
		  cache:warmup            Warms up an empty cache
		 config
		  config:dump-reference   Dumps the default configuration for an extension
		 debug
		  debug:autowiring        Lists classes/interfaces you can use for autowiring
		  debug:config            Dumps the current configuration for an extension
		  debug:container         Displays current services for an application
		  debug:event-dispatcher  Displays configured listeners for an application
		  debug:router            Displays current routes for an application
		 lint
		  lint:yaml               Lints a file and outputs encountered errors
		 router
		  router:match            Helps debug routes by simulating a path info match
- composer安装maker bundle

		$ composer require maker
		$ php bin/console  list
		.....
		make
		  make:auth                               Creates an empty Guard authenticator
		  make:command                            Creates a new console command class
		  make:controller                         Creates a new controller class
		  make:entity                             Creates a new Doctrine entity class
		  make:form                               Creates a new form class
		  make:functional-test                    Creates a new functional test class
		  make:serializer:encoder                 Creates a new serializer encoder class
		  make:subscriber                         Creates a new event subscriber class
		  make:twig-extension                     Creates a new Twig extension class
		  make:unit-test                          Creates a new unit test class
		  make:validator                          Creates a new validator and constraint class
		  make:voter                              Creates a new security voter class
		.......


