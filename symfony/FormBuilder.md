### FromBuilder  


	$form = $this->createFormBuilder($user)
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('repassword', PasswordType::class, [
                'mapped' => false // 添加Entity额外的字段
            ])
            ->add('truename')
            ->add('gender', HiddenType::class)
            ->add('roles', EntityType::class, [
                'class' => 'KitRbacBundle:Role',
                'choice_label' => 'rolename',
                'label' => '用户组'
            ])
            ->getForm();