## service id
- 服务容器

		service_container
		//  Symfony\Component\DependencyInjection\ContainerInterface
- doctrine

		doctrine
		// Doctrine\Bundle\DoctrineBundle\Registry
- em


		doctrine.orm.entity_manager
		// alias for doctrine.orm.default_entity_manager
		// Doctrine\ORM\EntityManager
        // 多库时
        //doctrine.orm.rtu_entity_manager
- 路由

		router
		// alias for "router.default"
		// Symfony\Bundle\FrameworkBundle\Routing\Router
- 请求(request_stack)
	
		request_stack
		// Symfony\Component\HttpFoundation\RequestStack
		// 拿到当前请求对象
		$request = $this->requestStack->getCurrentRequest();
		
- 日志

		logger
		// alias for "monolog.logger"
		// Symfony\Bridge\Monolog\Logger
- session

		session
		// Symfony\Component\HttpFoundation\Session\Session
- 密码加密器

		security.password_encoder
		//  alias for "security.user_password_encoder.generic"
		// Symfony\Component\Security\Core\Encoder\UserPasswordEncoder
- 安全Token

		security.token_storage
		// Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage
- 验证器validator

		validator
		//Symfony\Component\Validator\Validator\ValidatorInterface