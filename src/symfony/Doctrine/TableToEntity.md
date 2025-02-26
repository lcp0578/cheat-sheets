## Table to Entity (reverse engineering)
#### Symfony 3.4等旧版本解决方案
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
	
#### symfony 6.4 新版本解决方案
- 例如有一个`work_test`表结构如下：

		CREATE TABLE "public"."work_test" (
			"id" integer DEFAULT nextval('work_test_id_seq'::regclass),
			"day" character varying(32) NOT NULL,
			"truename" character varying(32) NOT NULL,
			"week_day" character varying(32) NOT NULL,
			"sign_time" character varying(12) NOT NULL,
			"sign_state" character varying(32) NOT NULL,
			"sign_type" smallint NOT NULL,
			"is_holiday" boolean NOT NULL,
			CONSTRAINT "work_test_pkey" PRIMARY KEY (id)
		);
- 第一步，生成annotation格式的Entity

		$ php bin/console doctrine:mapping:import "App\MemberBundle\Entity" annotation --force --filter="WorkTest" --path=src/MemberBundle/Entity
		
		Importing mapping information from "default" entity manager
		  > writing src/MemberBundle/Entity/WorkTest.php

	- 生成的`src/MemberBundle/Entity/WorkTest.php`如下：


			<?php
			
			namespace App\MemberBundle\Entity;
			
			use Doctrine\ORM\Mapping as ORM;
			
			/**
			 * WorkTest
			 *
			 * @ORM\Table(name="work_test")
			 * @ORM\Entity
			 */
			class WorkTest
			{
			    /**
			     * @var int
			     *
			     * @ORM\Column(name="id", type="integer", nullable=false)
			     * @ORM\Id
			     * @ORM\GeneratedValue(strategy="IDENTITY")
			     */
			    private $id;
			
			    /**
			     * @var string
			     *
			     * @ORM\Column(name="day", type="string", length=32, nullable=false)
			     */
			    private $day;
			
			    /**
			     * @var string
			     *
			     * @ORM\Column(name="truename", type="string", length=32, nullable=false)
			     */
			    private $truename;
			
			    /**
			     * @var string
			     *
			     * @ORM\Column(name="week_day", type="string", length=32, nullable=false)
			     */
			    private $weekDay;
			
			    /**
			     * @var string
			     *
			     * @ORM\Column(name="sign_time", type="string", length=12, nullable=false)
			     */
			    private $signTime;
			
			    /**
			     * @var string
			     *
			     * @ORM\Column(name="sign_state", type="string", length=32, nullable=false)
			     */
			    private $signState;
			
			    /**
			     * @var int
			     *
			     * @ORM\Column(name="sign_type", type="smallint", nullable=false)
			     */
			    private $signType;
			
			    /**
			     * @var bool
			     *
			     * @ORM\Column(name="is_holiday", type="boolean", nullable=false)
			     */
			    private $isHoliday;
			
			
			}

- 第二步，`annotation`格式转换成`Attribute`

		$ vendor/bin/rector process src/MemberBundle/Entity/WorkTest.php --config=rector.php
		 1/1 [============================] 100%
		1 file with changes
		===================
		
		1) src/MemberBundle/Entity/WorkTest.php:5
		
		    ---------- begin diff ----------
		@@ @@
		
		 /**
		  * WorkTest
		- *
		- * @ORM\Table(name="work_test")
		- * @ORM\Entity
		  */
		+#[ORM\Table(name: 'work_test')]
		+#[ORM\Entity]
		 class WorkTest
		 {
		     /**
		      * @var int
		-     *
		-     * @ORM\Column(name="id", type="integer", nullable=false)
		-     * @ORM\Id
		-     * @ORM\GeneratedValue(strategy="IDENTITY")
		      */
		+    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
		+    #[ORM\Id]
		+    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
		     private $id;
		
		     /**
		      * @var string
		-     *
		-     * @ORM\Column(name="day", type="string", length=32, nullable=false)
		      */
		+    #[ORM\Column(name: 'day', type: 'string', length: 32, nullable: false)]
		     private $day;
		
		     /**
		      * @var string
		-     *
		-     * @ORM\Column(name="truename", type="string", length=32, nullable=false)
		      */
		+    #[ORM\Column(name: 'truename', type: 'string', length: 32, nullable: false)]
		     private $truename;
		
		     /**
		      * @var string
		-     *
		-     * @ORM\Column(name="week_day", type="string", length=32, nullable=false)
		      */
		+    #[ORM\Column(name: 'week_day', type: 'string', length: 32, nullable: false)]
		     private $weekDay;
		
		     /**
		      * @var string
		-     *
		-     * @ORM\Column(name="sign_time", type="string", length=12, nullable=false)
		      */
		+    #[ORM\Column(name: 'sign_time', type: 'string', length: 12, nullable: false)]
		     private $signTime;
		
		     /**
		      * @var string
		-     *
		-     * @ORM\Column(name="sign_state", type="string", length=32, nullable=false)
		      */
		+    #[ORM\Column(name: 'sign_state', type: 'string', length: 32, nullable: false)]
		     private $signState;
		
		     /**
		      * @var int
		-     *
		-     * @ORM\Column(name="sign_type", type="smallint", nullable=false)
		      */
		+    #[ORM\Column(name: 'sign_type', type: 'smallint', nullable: false)]
		     private $signType;
		
		     /**
		      * @var bool
		-     *
		-     * @ORM\Column(name="is_holiday", type="boolean", nullable=false)
		      */
		+    #[ORM\Column(name: 'is_holiday', type: 'boolean', nullable: false)]
		     private $isHoliday;
		    ----------- end diff -----------
		
		Applied rules:
		 * AnnotationToAttributeRector
		 * NestedAnnotationToAttributeRector



 		[OK] 1 file has been changed by Rector
- 第三步，生成getter和setter方法

		$ php bin/console make:entity --regenerate "App\MemberBundle\Entity"
		 no change: src/MemberBundle/Entity/WebUser.php
		 no change: src/MemberBundle/Entity/Work.php
		 no change: src/MemberBundle/Entity/WorkSum.php
		 updated: src/MemberBundle/Entity/WorkTest.php
		
		
		  Success!
- 第四步（可选），验证映射是否正常

		$ php bin/console doctrine:schema:validate





