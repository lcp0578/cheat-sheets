## Dotenv Component
###### symfony3.4 开始环境变量开始采用Dotenv管理，存储于.env
> The Dotenv Component parses .env files to make environment variables stored in them accessible via getenv(), $_ENV or $_SERVER.

- 设置环境变量文件加载

        # web/app.php
        use Symfony\Component\HttpFoundation\Request;
        use Symfony\Component\Dotenv\Dotenv; // +++

        require __DIR__.'/../vendor/autoload.php';
        if (PHP_VERSION_ID < 70000) {
            include_once __DIR__.'/../var/bootstrap.php.cache';
        }

        $kernel = new AppKernel('prod', false);
        if (PHP_VERSION_ID < 70000) {
            $kernel->loadClassCache();
        }
        //$kernel = new AppCache($kernel);
        $dotenv = new Dotenv(); // +++
        $dotenv->load(__DIR__.'/.env'); // +++
        // 可加载多个配置文件 // ++
        // $dotenv->load(__DIR__.'/.env', __DIR__.'/.env.dev'); //++
        // When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
        //Request::enableHttpMethodParameterOverride();
        $request = Request::createFromGlobals();
        $response = $kernel->handle($request);
        $response->send();
        $kernel->terminate($request, $response);
- 设置.env文件

		# web/.env,可新建.env.dist 为默认配置文件
        # this is theme config
        THEME=Default
- 获取环境变量

		$theme = getenv('THEME') ? getenv('THEME') : 'Default';