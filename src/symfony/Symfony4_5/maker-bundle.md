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
		$ php bin/console list make
		Symfony 5.4.27 (env: dev, debug: true) #StandWithUkraine https://sf.to/ukraine
		
		Usage:
		  command [options] [arguments]
		
		Options:
		  -h, --help            Display help for the given command. When no command is given display help for the list command
		  -q, --quiet           Do not output any message
		  -V, --version         Display this application version
		      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
		  -n, --no-interaction  Do not ask any interactive question
		  -e, --env=ENV         The Environment name. [default: "dev"]
		      --no-debug        Switch off debug mode.
		  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
		
		Available commands for the "make" namespace:
		  make:auth                   Creates a Guard authenticator of different flavors
		  make:command                Creates a new console command class
		  make:controller             Creates a new controller class
		  make:crud                   Creates CRUD for Doctrine entity class
		  make:docker:database        Adds a database container to your docker-compose.yaml file
		  make:entity                 Creates or updates a Doctrine entity class, and optionally an API Platform resource
		  make:fixtures               Creates a new class to load Doctrine fixtures
		  make:form                   Creates a new form class
		  make:functional-test        Creates a new test class
		  make:message                Creates a new message and handler
		  make:messenger-middleware   Creates a new messenger middleware
		  make:migration              Creates a new migration based on database changes
		  make:registration-form      Creates a new registration form system
		  make:reset-password         Create controller, entity, and repositories for use with symfonycasts/reset-password-bundle
		  make:security:form-login    Generate the code needed for the form_login authenticator
		  make:serializer:encoder     Creates a new serializer encoder class
		  make:serializer:normalizer  Creates a new serializer normalizer class
		  make:stimulus-controller    Creates a new Stimulus controller
		  make:subscriber             Creates a new event subscriber class
		  make:test                   [make:unit-test|make:functional-test] Creates a new test class
		  make:twig-component         Creates a twig (or live) component
		  make:twig-extension         Creates a new Twig extension with its runtime class
		  make:unit-test              Creates a new test class
		  make:user                   Creates a new security user class
		  make:validator              Creates a new validator and constraint class
		  make:voter                  Creates a new security voter class
- 解决`make:entity`报错

		$ php bin/console make:entity
		
		 Class name of the entity to create or update (e.g. AgreeablePizza):
		 > TestEntity
		
		 created: src/Entity/TestEntity.php
		 created: src/Repository/TestEntityRepository.php
		
		
		 [ERROR] Only attribute mapping is supported by make:entity, but the <info>App\Entity\TestEntity</info> class uses a
		         different format. If you would like this command to generate the properties & getter/setter methods, add your mapping
		         configuration, and then re-run this command with the <info>--regenerate</info> flag.
- 旧的`annotation`类Entity迁移为`attribute`
	- https://yarnaudov.com/symfony-fix-only-attribute-mapping-supported.html


