### FromBuilder  

1. EntityType  


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

2. ChoiceType  

		$builder->add('rolename', null, [
	            'label' => '角色名称'
	        ])
	            ->add('note', null, [
	            'label' => '备注'
	        ])
	            ->add('status', ChoiceType::class, [
	            'choices' => [
	                '启用' => 1,
	                '禁用' => 0
	            ],
	            'expanded' => true,
	            'label' => '状态',
	             'data' => 1,
	            'label_attr' => [
	                'class' => 'radio-inline'
	            ]
	        ])
	            ->add('submit', SubmitType::class, [
	            'label' => '提交'
	        ]);

3. RepeatedType

		$builder->add('name', TextType::class, [
	            'label' => '用户名'
	        ])
	            ->add('email', EmailType::class, [
	            'label' => '邮箱'
	        ])
	            ->add('plainPassword', RepeatedType::class, [
	            'type' => PasswordType::class,
	            'first_options' => ['label' => '密码'],
	            'second_options' => ['label' => '确认密码'],
	        ]);