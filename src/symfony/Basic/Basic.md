## Symfony Basic

- 获取登录用户信息  

 	- 控制器中 

     		$this->getUser();
		等价于

		    $this->get('security.token_storage')
		    ->getToken()
		    ->getUser(); 

 	- Twig中：

    		{% if app.user %}{{ app.user.username }}{% else %}游客{% endif %}
- 用户密码加密

	    /**
	     *
	     * @var \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder
	     */
	    $encoder = $this->get('security.password_encoder');
	
	校验密码:
	
	    $encoder->isPasswordValid($user, $userForm->getPassword())；
	密码加密:
	
	    $password = $encoder->encodePassword($user, $userForm->getPlainPassword());

- 文件上传相关
 
	    $file = $request->files->get('file'); //获取上传的文件
	    if($file instanceof UploadedFile){
	        //不为空
	    	$filename = $this->get('kit.file_uploader')->upload($file, 'file');
	    }else{
	   		//未上传
	    }


- 获取根目录和host

		$this->getContainer()->get('kernel')->getRootDir()
		$root = $this->container->get('kernel')->getRootDir();
		$root = $this->get('kernel')->getRootDir();
		// xx/xxx/app
		//Symfony 3.3
		$root = $this->get('kernel')->getProjectDir()
		%kernel.project_dir%
		use %kernel.project_dir%/web/ instead of %kernel.root_dir%/../web/.
	get HOST  
		
		$request()->getHost()
- 获取当前路由名称
	
		// controller
		$routeName = $request->get('_route');
		//twig
		app.request.get('_route')
- 获取头部信息

		$ua = $request->headers->get('User-Agent');