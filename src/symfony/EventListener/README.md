## Event Listenser
- 调试listenser

		$ php bin/console debug:container session

		Information for Service "session"
		=================================
		
		 ------------------ --------------------------------------------------
		  Option             Value
		 ------------------ --------------------------------------------------
		  Service ID         session
		  Class              Symfony\Component\HttpFoundation\Session\Session
		  Tags               -
		  Public             yes
		  Synthetic          no
		  Lazy               no
		  Shared             yes
		  Abstract           no
		  Autowired          no
		  Autowiring Types   -
		 ------------------ --------------------------------------------------
- 设置优先级

		mobile.token_listener:
            class: MobileBundle\EventListener\TokenLoginListener
            arguments: ["@router", "@security.token_storage"]
            tags:
                - { name: kernel.event_listener, event: kernel.request, priority: 9 }
- [Login Listener](LoginListener.md) 登录的事件监听
- [Enable Filter Listener](EnableFilterListener.md) 开启过滤器监听
- [Guzzle Listener](GuzzleListener.md) GuzzleHttp请求相关监听
- [API version](ApiVersion.md) API版本控制监听
- [kernel view](kernel.view.md) 模板层监听
- [Api Exception Listener](ExceptionListener.md) API异常监听
- [Doctrine Event Listeners Subscribers](doctrine_event_listeners_subscribers.md)Doctrine的事件监听
