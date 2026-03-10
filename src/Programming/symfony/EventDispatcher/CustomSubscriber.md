## CustomSubscriber

	namespace App\AuthBundle\EventSubscriber;
	
	use App\AclBundle\Entity\UserRole;
	use App\AclBundle\Repository\UserRoleRepository;
	use App\MenuBundle\Entity\Menu;
	use App\MenuBundle\Repository\MenuRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use JetBrains\PhpStorm\NoReturn;
	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
	use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
	
	class CustomSubscriber implements EventSubscriberInterface
	{
	
	    private EntityManagerInterface $em;
	
	    public function __construct(EntityManagerInterface $em)
	    {
	        $this->em = $em;
	    }
	    public static function getSubscribedEvents(): array
	    {
	        return [
	            LoginSuccessEvent::class => 'onLoginSuccess'
	        ];
	    }
	
	    #[NoReturn] public function onLoginSuccess(LoginSuccessEvent $event): void
	    {
	        $user = $event->getUser();
	        /**
	         * @var UserRoleRepository $userRoleRepo
	         */
	        $userRoleRepo = $this->em->getRepository(UserRole::class);
	        $nodes = $userRoleRepo->getNodesByUserId($user->getUserIdentifier());
	        $nodes = is_array($nodes) ? implode(',', array_column($nodes, 'nodes')) : '';
	
	        /**
	         *
	         * @var MenuRepository $menuRepo
	         */
	        $menuRepo = $this->em->getRepository(Menu::class);
	        $menu = $menuRepo->getMenuByRole($nodes, in_array('ROLE_SUPER_ADMIN', $user->getRoles()));
	        $event->getRequest()->getSession()->set('menu', $menu);
	    }
	
	}
