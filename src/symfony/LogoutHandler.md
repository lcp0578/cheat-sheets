## LogoutHandler
- 实现LogoutHandlerInterface接口

		<?php
		namespace RbacBundle\Service;
		
		use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
		use Symfony\Component\HttpFoundation\Request;
		use Symfony\Component\HttpFoundation\Response;
		use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
		use Symfony\Bridge\Monolog\Logger;
		
		class LogoutHandler implements LogoutHandlerInterface
		{
		    private $logger;
		    
		    public function __construct(Logger $logger)
		    {
		        $this->logger = $logger;
		    }
		
		    /**
		     *
		     * {@inheritdoc}
		     *
		     * @see \Symfony\Component\Security\Http\Logout\LogoutHandlerInterface::logout()
		     */
		    public function logout(Request $request, Response $response, TokenInterface $token)
		    {
		        // TODO: Auto-generated method stub
		        $userId = $token->getUser()->getId();
		        $this->logger->alert('user id' . $userId . ' logout'); //记录log
		        return $response;
		    }
		}
- 注册srevice

		services:
		#    kit_rbac.example:
		#        class: RbacBundle\Example
		#        arguments: ["@service_id", "plain_value", "%parameter%"]
		    rbac.logout_handler:
		        class: RbacBundle\Service\LogoutHandler
		        arguments: ["@logger"]
- 修改firewalls配置

		security:

		    encoders:
		        RbacBundle\Entity\User:
		            algorithm: bcrypt
		    providers:
		        database_admin_users:
		            entity:
		                class: RbacBundle:User
		                property: username
		    firewalls:
		        admin_firewalls:
		            pattern:   ^/admin
		            anonymous: ~
		            provider: database_admin_users
		            guard:
		                authenticators:
		                    - admin.admin_form_login_authenticator
		            form_login:
		                login_path: admin_login_index
		                check_path: admin_login_check
		                default_target_path: /admin
		                username_parameter: _username
		                password_parameter: _password
		                failure_path: kit_admin_login
		            logout:
		                handlers: [rbac.logout_handler] # 注意此处直接填写service_id即可,可以是多个service
		                path: admin_login_logout
		                target: admin_login_index
- 查看debug log

		# var/logs/dev.log
		[2017-10-24 11:52:13] app.ALERT: user id1 logout [] []
