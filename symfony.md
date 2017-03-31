## symfony 3.x

1.twig 中获取GET参数

    app.request.query.get('keyword')

2.控制器中获取登录用户信息

     $this->getUser();
等价于

    $this->get('security.token_storage')
    ->getToken()
    ->getUser(); 

3.用户密码加密

    /**
     *
     * @var \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder
     */
    $encoder = $this->get('security.password_encoder');

校验密码:

    $encoder->isPasswordValid($user, $userForm->getPassword())；
密码加密:

    $password = $encoder->encodePassword($user, $userForm->getPlainPassword());

4.twig中使用js模板引擎，渲染数据，解决 {{ }} 冲突，使用verbatim。

    {% verbatim %}
	    <ul>
	    {% for item in seq %}
	    <li>{{ item }}</li>
	    {% endfor %}
	    </ul>
    {% endverbatim %}
5.文件上传相关

    $file = $request->files->get('file'); //获取上传的文件
    if($file instanceof UploadedFile){
        //不为空
    	$filename = $this->get('kit.file_uploader')->upload($file, 'file');
    }else{
   		//未上传
    }

6.Doctrine生命周期

    use Doctrine\ORM\Mapping as ORM;
	// Entity类前面
    @ORM\HasLifecycleCallbacks()
	// 类中的方法
	/**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        if($this->getCreateAt() == null){
            $this->setCreateAt(new \DateTime());
        }
        $this->setUpdateAt(new \DateTime());
    }
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUpdateAt(new \DateTime());
    }
7.Entity的filed设置

    @ORM\Column(name="filed_name", type="string", length=64, nullable=true, options={"default" : "default_value", "comment": "字段注释"})

- nullable设置是否可以为null
- default设置字段的默认值
- comment字段的注释