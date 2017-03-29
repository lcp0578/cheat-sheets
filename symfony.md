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