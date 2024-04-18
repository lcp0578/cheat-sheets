## service class框架级别服务注入类名(symfony 6.4)
- 首先，根据依赖最小化原则，不能直接注入Container或ContainerInterface之类的了。
- 注入doctrine

		use Doctrine\Persistence\ManagerRegistry;

		public function index(ManagerRegistry $doctrine): Response
	    {
	        // Both methods return the default entity manager
	        $entityManager = $doctrine->getManager();
	        $entityManager = $doctrine->getManager('default');
	
	        // This method returns instead the "customer" entity manager
	        $customerEntityManager = $doctrine->getManager('customer');
	
	        // ...
	    }
- 注入em

		use Doctrine\ORM\EntityManagerInterface;
		
		EntityManagerInterface $em
- 注入请求相关或session

		use Symfony\Component\HttpFoundation\RequestStack;
		
		RequestStack $requestStack
		$this->session = $requestStack->getSession(); #不能写在构造函数中

- 注入当前登录用户

		use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
		
		TokenStorageInterface $tokenStorage
- 分页器

		use Knp\Component\Pager\PaginatorInterface;

		PaginatorInterface $paginator
- 密码生成器

		use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
				
		$password = $passwordHasher->hashPassword($user, $password);
- 获取路由信息

		use Symfony\Component\Routing\RouterInterface;
		
		$router->getRouteCollection();
- 生成路由

		use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

		public function index(UrlGeneratorInterface $urlGenerator)
		{
		    // generate a URL with no route arguments
		    $signUpPage = $this->urlGenerator->generate('sign_up');
		}
- Twig模板

		use Twig\Environment;

		public function homepage(Environment $twig): Response
		{
		
		    $html = $twig->render('vinyl/homepage.html.twig', [
		        'title' => 'PB & Jams',
		        'tracks' => $tracks,
		    ]);
		}
- 日志服务Logger

		use Psr\Log\LoggerInterface;

		$logger->critical('save info!', $data);