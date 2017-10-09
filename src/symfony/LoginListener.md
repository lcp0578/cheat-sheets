## Login Event Listener

- 定义LoginListener

		<?php
		namespace KitWebBundle\EventListener;

		use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
		use Symfony\Component\HttpFoundation\Session\Session;
		
		class LoginListener
		{
		    private $session;
		    
		    public function __construct(Session $session)
		    {
		        $this->session = $session;
		    }
		    
		    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
		    {
		        //$event->getAuthenticationToken()->getUser();
		        $event->getRequest()->cookies->set('pdd_login', uniqid());
		        $this->session->set('timezone', 'RPC');
		    }
		}

- 注册LoginListener

		# KitWebBundle/Reources/config/services.yml
		kit_web.login_listener:
	        class: KitWebBundle\EventListener\LoginListener
	        arguments: ['@session']
	        tags:
	            - { name: kernel.event_listener, event: security.interactive_login, method: onSecurityInteractiveLogin }