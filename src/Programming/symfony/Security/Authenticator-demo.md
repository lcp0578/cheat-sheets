## Authenticator demo
- FormLoginAuthenticator code

		<?php
		namespace KitWebBundle\Security;
		
		use Symfony\Component\HttpFoundation\Request;
		use Symfony\Component\HttpFoundation\Response;
		use Symfony\Component\HttpFoundation\RedirectResponse;
		use Symfony\Component\Routing\RouterInterface;
		use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
		use Symfony\Component\Security\Core\Exception\BadCredentialsException;
		use Symfony\Component\Security\Core\Exception\AuthenticationException;
		use Symfony\Component\Security\Core\User\UserInterface;
		use Symfony\Component\Security\Core\User\UserProviderInterface;
		use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
		use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
		use Symfony\Component\Security\Core\Security;
		use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
		use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
		
		class FormLoginAuthenticator extends AbstractFormLoginAuthenticator
		{
		
		    private $router;
		
		    private $encoder;
		
		    public function __construct(RouterInterface $router, UserPasswordEncoderInterface $encoder)
		    {
		        $this->router = $router;
		        $this->encoder = $encoder;
		    }
		
		    public function getCredentials(Request $request)
		    {
		        //dump($request->getPathInfo());die();
				// 判断是否是登录提交的验证路由
		        if ($request->getPathInfo() != '/login_check') {
		            return;
		        }
		        // 表单的用户名和密码的name，分别为email和password，可以根据表单进行修改
		        $email = $request->request->get('email');
		        $request->getSession()->set(Security::LAST_USERNAME, $email);
		        $password = $request->request->get('password');
		        
		        return [
		            'email' => $email,
		            'password' => $password
		        ];
		    }
		
		    public function getUser($credentials, UserProviderInterface $userProvider)
		    {
		        try {
					// 拿到getCredentials()返回值，在数据库中拿到用户信息
		            return $userProvider->loadUserByUsername($credentials['email']);
		        }
		        catch (UsernameNotFoundException $e) {
					// 用户不存在的一场
		            throw new CustomUserMessageAuthenticationException('用户不存在');
		        }
		    }
		
		    public function checkCredentials($credentials, UserInterface $user)
		    {
		        $plainPassword = $credentials['password'];
				// 校验密码
		        if ($this->encoder->isPasswordValid($user, $plainPassword)) {
		            return true;
		        }
		        
		        throw new CustomUserMessageAuthenticationException('密码错误');
		    }
		
		    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
		    {
				// 设置登录成功后的跳转链接
		        
                $session = $request->getSession();
                $key = '_security.web_firewalls.target_path'; // where "web_firewalls" is your firewall name
                // check if the referrer session key has been set
                if ($session->has($key)) {
                    // set the url based on the link they were trying to access before being authenticated
                    $url = $session->get($key);
                    // remove the session key
                    $session->remove($key);
                } else {
                    //if the referrer key was never set, redirect to a default route
                    $url = $this->getDefaultSuccessRedirectUrl();
                }
                return new RedirectResponse($url);
		    }
		
		    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
		    {
				// 失败跳转uri
		        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
		        
		        $url = $this->getLoginUrl();
		        
		        return new RedirectResponse($url);
		    }
		
		    protected function getLoginUrl()
		    {
		        return $this->router->generate('kit_web_login');
		    }
		
		    protected function getDefaultSuccessRedirectUrl()
		    {
				// 登录成功后默认跳转链接
		        return $this->router->generate('kit_web_homepage');
		    }
		
		    public function supportsRememberMe()
		    {
				// remeber me 该功能暂未实现
		        return false;
		    }
		}
- 相关配置

		# app/config/services.yml
		services:
		    kit_vip.form_login_authenticator:
		        class: KitVipBundle\Security\FormLoginAuthenticator
		        arguments: ["@router", "@security.password_encoder"]

		# app/config/security.yml
		security:
		    encoders:
		        KitWebBundle\Entity\WebUser: bcrypt
		        #FOS\UserBundle\Model\UserInterface: bcrypt
		        KitRbacBundle\Entity\User:
		            algorithm: bcrypt
		    role_hierarchy:
		        ROLE_ADMIN:       ROLE_USER
		        ROLE_SUPER_ADMIN: ROLE_ADMIN
		
		    providers:
		        database_web_users:
		            entity: {class: KitWebBundle:WebUser, property: mobile }
		        # fos_userbundle:
		        #     id: fos_user.user_provider.username
		        database_admin_users:
		            entity:
		                class: KitRbacBundle:User
		                property: username
		    firewalls:
		        admin_firewalls:
		            pattern:   ^/admin
		            anonymous: ~
		            provider: database_admin_users
		            guard:
		                authenticators:
		                    - kit_admin.admin_form_login_authenticator
		            form_login:
		                login_path: kit_admin_login
		                check_path: kit_admin_login
		                default_target_path: /admin
		                username_parameter: _username
		                password_parameter: _password
		                failure_path: kit_admin_login
		            logout:
		                path: kit_admin_logout
		                target: kit_admin_login
		        vip_firewalls:
		            pattern: ^/vip
		            anonymous: ~
		            guard:
		                authenticators:
		                    - kit_vip.form_login_authenticator # service id
		            logout:
		                path: /vip/logout
		                target: /vip/login
		        main:
		            pattern: ^/
		            anonymous: ~
		            guard:
		                authenticators:
		                    - kit_web.form_login_authenticator
		            #form_login:
		            #    login_path: kit_web_login
		            #    check_path: kit_web_login_check
		            logout:
		                path: /logout
		                target: /
		
		    access_control:
		        - { path: ^/admin/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
		        - { path: ^/admin/login_check$, role: IS_AUTHENTICATED_ANONYMOUSLY }
		        - { path: ^/admin, role: ROLE_ADMIN }
		        - { path: ^/vip/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
		        - { path: ^/vip/login_check$, role: IS_AUTHENTICATED_ANONYMOUSLY }
		        - { path: ^/vip, role: ROLE_USER }
		        - { path: ^/user, role: ROLE_USER }
