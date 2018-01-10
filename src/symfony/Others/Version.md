## symfony version
- 用命令查看

		php app/console --version // older version
		$ php bin/console --version
		Symfony 3.3.9 (kernel: app, env: dev, debug: true)

	
- 查看 hardcoded version

		// vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Kernel.php
		abstract class Kernel implements KernelInterface, TerminableInterface
		{
		    /**
		     * @var BundleInterface[]
		     */
		    protected $bundles = array();
		
		    protected $bundleMap;
		    protected $container;
		    protected $rootDir;
		    protected $environment;
		    protected $debug;
		    protected $booted = false;
		    protected $name;
		    protected $startTime;
		    protected $loadClassCache;
		
		    private $projectDir;
		
		    const VERSION = '3.3.9';
		    const VERSION_ID = 30309;
		    const MAJOR_VERSION = 3;
		    const MINOR_VERSION = 3;
		    const RELEASE_VERSION = 9;
		    const EXTRA_VERSION = '';
		
		    const END_OF_MAINTENANCE = '01/2018';
		    const END_OF_LIFE = '07/2018';
		}
		
- [version releases](https://symfony.com/doc/current/contributing/community/releases.html)
- [version roadmap](https://symfony.com/roadmap)