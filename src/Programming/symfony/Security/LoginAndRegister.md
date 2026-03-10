## login and register
- 校验密码

		/**
         *
         * @var \KitWebBundle\Entity\WebUser $user
         */
        $user = $this->getDoctrine()->getRepository('KitWebBundle:WebUser')->findOneBy([
            'mobile' => $mobile
        ]);
        if(empty($user)){
            return $this->json([
                'code' => 5,
                'msg' => '用户不存在'
            ]);
        }
        /**
         *
         * @var \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder
         */
        $encoder = $this->get('security.password_encoder');
        // 校验密码
        if ($encoder->isPasswordValid($user, $password)) {
            return $this->authenticateUser($user, '登录成功');
        }else{
            return $this->json([
                'code' => 6,
                'msg' => '密码错误'
            ]);
        }
- 设置或更新密码

		// Encode the new users password
        $encoder = $this->get('security.password_encoder');
        $password = $encoder->encodePassword($user, $password);
		
		// 或者在preUpdate设置
		/**
	     * @ORM\PreUpdate()
	     */
	    public function preUpdate()
	    {
	        if($this->getPassword() != null){
	            $this->setSalt(substr(md5(time()), 0, 8));
	            $this->setPassword(password_hash($this->getPassword() . $this->getSalt(), PASSWORD_BCRYPT ));
	        }
	        $this->setUpdateAt(new \DateTime());
	    }
- 设置登录信息

		/**
	     * 设置登录信息
	     * 
	     * @param WebUser $user
	     */
	    private function authenticateUser(WebUser $user, $msg)
	    {
	        $providerKey = 'main'; // your firewall name
	        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());
			//starting with Symfony 2.6, the security.context service has been deprecated and split into two new services: security.authorization_checker and security.token_storage.
			// symfony < 2.6 should be
			// $this->get('security.context')->setToken($token);
	        $this->get('security.token_storage')->setToken($token);
	        $response = new JsonResponse([
	            'code' => 1,
	            'msg' => $msg
	        ]);
	        $response->headers->setCookie(new Cookie('pdd_login', uniqid()));
	        return $response;
	    }
- [登录的事件监听](../EventListener/LoginListener.md)  
	