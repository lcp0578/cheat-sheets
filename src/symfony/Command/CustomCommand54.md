## Custom Command in Symfony5.4
- 原来的`Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand`已经被废弃。
- 所以需要使用依赖注入来引用服务。
- 示例代码

		namespace App\ApiBundle\Command;
		
		use Symfony\Component\Console\Command\Command;
		use Symfony\Component\Console\Output\OutputInterface;
		use Symfony\Component\Console\Input\InputInterface;
		use App\ApiBundle\Service\RequestService;
		
		class AreaCommand extends Command
		{
			private $requestService;
			
			public function __construct(RequestService $requestService)
			{
				$this->requestService = $requestService;
				
				parent::__construct();
			}
			
		    protected function configure()
		    {
		        $this->setName('api:area:get')
		            ->setDescription('get information ...')
		            ->setHelp("This command allows pull area code info ...");
		    }
		
		    protected function execute(InputInterface $input ,OutputInterface $output)
		    {
		        $this->apiRequest(1, $output);
		        $output->writeln([
		            '==========',
		            'End  Pull!'
		        ]);
		    }
		
		    private function apiRequest($type, OutputInterface $output)
		    {
			    $result = $this->requestService->run($type,$data);
			   
		    }
		}