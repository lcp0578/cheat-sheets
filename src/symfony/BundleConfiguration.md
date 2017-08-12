## bundle configuration
- config.yml 设置配置项
	
		kit_oss:
		    access_key_id: *********
		    access_key_secret: ********
		    endpoint: oss-cn-beijing.aliyuncs.com
- DependencyInjection Configuration 设置对应规则

		class Configuration implements ConfigurationInterface
		{
		
		    /**
		     *
		     * {@inheritdoc}
		     *
		     */
		    public function getConfigTreeBuilder()
		    {
		        $treeBuilder = new TreeBuilder();
		        $rootNode = $treeBuilder->root('kit_oss');
		        
		        // Here you should define the parameters that are allowed to
		        // configure your bundle. See the documentation linked above for
		        // more information on that topic.
		        $rootNode->children()
		            ->scalarNode('access_key_id')->cannotBeEmpty()->end()
		            ->scalarNode('access_key_secret')->cannotBeEmpty()->end()
		            ->scalarNode('endpoint')->cannotBeEmpty()->end()
		        ->end()
		        ;
		
		        return $treeBuilder;
		    }
		}
- 继承 Extension 设置参数

		class KitOssExtension extends Extension
		{
		    /**
		     * {@inheritdoc}
		     */
		    public function load(array $configs, ContainerBuilder $container)
		    {
		        $configuration = new Configuration();
		        $config = $this->processConfiguration($configuration, $configs);
		
		        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
		        $loader->load('services.yml');
		        
		        $container->setParameter('kit_oss.access_key_id', $config['access_key_id']);
		        $container->setParameter('kit_oss.access_key_secret', $config['access_key_secret']);
		        $container->setParameter('kit_oss.endpoint', $config['endpoint']);
		    }
		}
- service配置 service.yml

		services:
		    kit_oss.client_service:
		        class: Kit\Bundle\OssBundle\Service\ClientService
		        arguments: ["%kit_oss.access_key_id%", "%kit_oss.access_key_secret%", "%kit_oss.endpoint%"]
- service定义
	
		class ClientService
		{
		    private $accessKeyId;
		    private $accessKeySecret;
		    private $endpoint;
		    
		    public function __construct($accessKeyId, $accessKeySecret, $endpoint)
		    {
		        $this->accessKeyId = $accessKeyId;
		        $this->accessKeySecret = $accessKeySecret;
		        $this->endpoint = $endpoint;
		    }
		｝