## service class框架级别服务注入类名(symfony 6.4)
- 首先，根据依赖最小化原则，不能直接注入Container或ContainerInterface之类的了。
- 注入doctrine

		use Doctrine\Persistence\ManagerRegistry;

		ManagerRegistry $doctrine
- 注入em

		use Doctrine\ORM\EntityManagerInterface;
		
		EntityManagerInterface $em
- 注入请求相关或session

		use Symfony\Component\HttpFoundation\RequestStack;
		
		RequestStack $requestStack
		$this->session = $requestStack->getSession();

- 注入当前登录用户

		use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
		
		TokenStorageInterface $tokenStorage
