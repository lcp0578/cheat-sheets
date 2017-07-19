## symfony 3.x

- [Twig](../symfony/Twig.md)
- [Shortcuts methods](../symfony/ShortcutsMethods.md)
- [Doctrine](../symfony/Doctrine.md)
- [Console Command](../symfony/Console.md)
- [FormBuilder examples](../symfony/FormBuilder.md "FormBuilder")
- [Validation Note](../symfony/Validation.md) 
- [QueryBuilder examples](../symfony/QueryBuilder.md "QueryBuilder")
- [RawSQLQuery examples](../symfony/RawSQLQuery.md "RawSQLQuery")  
- [My Bundles Note](../symfony/MyBundles.md) 
- [My Components Note](../symfony/Components/README.md) 


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

	