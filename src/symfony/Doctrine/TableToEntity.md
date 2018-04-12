## Table to Entity (reverse engineering)
- 数据库建立user_test表

		CREATE TABLE `user_test` (
		  `id` int(11) NOT NULL PRIMARY KEY,
		  `username` varchar(32) NOT NULL,
		  `mobile` char(11) NOT NULL,
		  `status` smallint(6) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
- 生成mapping yml文件

		php bin/console doctrine:mapping:import --force KitAdminBundle yml  --filter="UserTest"
		Importing mapping information from "default" entity manager
  		> writing D:\xampp\htdocs\kitlabs\KitPHP\src\KitAdminBundle/Resources/config/doctrine/UserTest.orm.yml
  	PS: --filter 大小写敏感，若不设置，会生成所有表的mapping  
	src\KitAdminBundle/Resources/config/doctrine/UserTest.orm.yml

		KitAdminBundle\Entity\UserTest:
		    type: entity
		    table: user_test
		    id:
		        id:
		            type: integer
		            nullable: false
		            options:
		                unsigned: false
		            id: true
		            generator:
		                strategy: IDENTITY
		    fields:
		        username:
		            type: string
		            nullable: false
		            length: 32
		            options:
		                fixed: false
		        mobile:
		            type: string
		            nullable: false
		            length: 11
		            options:
		                fixed: true
		        status:
		            type: smallint
		            nullable: false
		            options:
		                unsigned: false
		    lifecycleCallbacks: {  }
- 根据mapping文件生成entity

		php bin/console doctrine:mapping:convert annotation ./src --filter=UserTest
		Processing entity "KitAdminBundle\Entity\UserTest"
	KitAdminBundle\Entity\UserTest.php
	
		<?php
		namespace KitAdminBundle\Entity;
		
		use Doctrine\ORM\Mapping as ORM;
		
		/**
		 * UserTest
		 *
		 * @ORM\Table(name="user_test")
		 * @ORM\Entity
		 */
		class UserTest
		{
		    /**
		     * @var integer
		     *
		     * @ORM\Column(name="id", type="integer")
		     * @ORM\Id
		     * @ORM\GeneratedValue(strategy="IDENTITY")
		     */
		    private $id;
		
		    /**
		     * @var string
		     *
		     * @ORM\Column(name="username", type="string", length=32, nullable=false)
		     */
		    private $username;
		
		    /**
		     * @var string
		     *
		     * @ORM\Column(name="mobile", type="string", length=11, nullable=false)
		     */
		    private $mobile;
		
		    /**
		     * @var integer
		     *
		     * @ORM\Column(name="status", type="smallint", nullable=false)
		     */
		    private $status;
		}
	PS: 此处有个小bug，fixed=true没有了，需要手动加一下限制
- 生成getter和setter

		php bin/console doctrine:generate:entities KitAdminBundle:UserTest
        
	OK,大功告成！
	