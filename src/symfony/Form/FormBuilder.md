### FormBuilder  

1. EntityType  


		$form = $this->createFormBuilder($user) //在控制器
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
query builder

		$builder
            ->add('parent', EntityType::class, [
                'class' => 'KitNewsBundle:Category',
                'query_builder' => function(CategoryRepository $repo){
                    return $repo->getParentCategory();
                },
                'choice_label' => 'name',
                'label' => '父级分类'
            ]);
		// query
		class CategoryRepository extends \Doctrine\ORM\EntityRepository
		{
		
		    public function getParentCategory()
		    {
		        return $this->createQueryBuilder('c')
		            ->select('c')
		            ->where('c.parentId = 1')
		            ->andWhere('c.status = 1')
		            ->orderBy('c.id', 'ASC');
		    }
		}

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
		// 为radio设置属性
		->add('status', ChoiceType::class, [
            'choices' => [
                '启用' => 1,
                '禁用' => 0
            ],
            'expanded' => true,
            'label' => '状态',
            'data' => $options['data_status'],
            'label_attr' => [
                'class' => 'radio-inline'
            ],
            'choice_attr' => function ($val, $key, $index) {
                // adds a class like attending_yes, attending_no, etc
                return [
                    'lay-filter' => 'status-radio'
                ];
            }
        ])

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
4. options

		public function buildForm(FormBuilderInterface $builder, array $options)
	    {
	        $builder->add('name', null, [
	            'label' => '类别名称',
	            'attr' => [
	                'lay-verify' => "required",
	                'placeholder' => "请输入类别名称",
	                'autocomplete' => "off"
	            ]
	        ])
	            ->add('status', ChoiceType::class, [
	            'choices' => [
	                '启用' => 1,
	                '禁用' => 0
	            ],
	            'expanded' => true,
	            'label' => '状态',
	            'data' => $options['data_status'],
	            'label_attr' => [
	                'class' => 'radio-inline'
	            ],
	            'choice_attr' => function ($val, $key, $index) {
	                // adds a class like attending_yes, attending_no, etc
	                return [
	                    'lay-filter' => 'status-radio'
	                ];
	            }
	        ])
	            ->add('submit', SubmitType::class, [
	            'label' => '提交',
	            'attr' => [
	                'lay-submit' => 1,
	                'lay-filter' => "formDemo"
	            ]
	        ]);
	    }

	    /**
	     *
	     * {@inheritdoc}
	     *
	     */
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => 'DispatchBundle\Entity\CanalCategory',
	            'data_status' => 1
	        ));
	    }
- ChoiceType详解
	- 两个关键参数
	
    | 目的类型 | expanded | multiple |
    | ------ | ------ | ------ |
    | 单选下拉框(select) | false | false |
    | 复选下拉框(multi-select) | false | true |
    | 单选框（radio） | true | false |
    | 复选框（checkboxes） | true | true |
	- 示例
	
    		// 单选框
    		->add('status', ChoiceType::class, [
                'choices' => [
                    '启用' => 1,
                    '禁用' => 0
                ],
                'expanded' => true, //单选，multiple默认false
                'label' => '状态',
                'data' => 1,
            ])
            //expanded，multiple默认值均为false，所以如下代码为单选下拉框
            ->add('dropdown', ChoiceType::class, [
                'choices' => [
                    '下拉菜单1' => 1,
                    '下拉菜单2' => 0
                ],
                'label' => '下拉名称',
                'data' => 1,
            ])
            //复选框
            ->add('hobbit', ChoiceType::class, [
                'choices' => [
                    '篮球' => 1,
                    '足球' => 2,
                    '排球' => 3,
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => '爱好',
                'data' => [1], //此处需要注意，由于值为多个，所以默认选中需要传数组
            ])
