## symfony 3.x

1.twig 中获取GET参数

    app.request.query.get('keyword')

2.获取登录用户信息  

1) 控制器中 

     $this->getUser();
等价于

    $this->get('security.token_storage')
    ->getToken()
    ->getUser(); 

2) Twig中：

    {% if app.user %}{{ app.user.username }}{% else %}游客{% endif %}
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

8.常用Command命令

- 查看commad列表(public)

		 php bin/console list

- 清除缓存
		
		php bin/console cache:clear
		php bin/console cache:clear --env=prod --no-debug  //清除生产环境的缓存
- 生成bundle
		
		php bin/console generate:bundle
- 生成Entity

		php bin/console doctrine:generate:entity
- 生成crud操作代码
		
		php bin/console doctrine:generate:crud
- 查看service的列表

		php bin/console  debug:container
	- 查看monolog相关的service
			
			 php bin/console  debug:container monolog

			 Select one of the following services to display its information:
			  [0 ] monolog.activation_strategy.not_found
			  [1 ] monolog.handler.fingers_crossed.error_level_activation_strategy
			  [2 ] monolog.processor.psr_log_message
			  [3 ] monolog.handler.main
			  [4 ] monolog.handler.console
			  [5 ] monolog.logger.request
			  [6 ] monolog.logger.cache
			  [7 ] monolog.logger.translation
			  [8 ] monolog.logger.templating
			  [9 ] monolog.logger.profiler
			  [10] monolog.logger.php
			  [11] monolog.logger.event
			  [12] monolog.logger.router
			  [13] monolog.logger.security
			  [14] monolog.logger.doctrine
			  [15] monolog.logger.assetic
			  [16] monolog.handler.null_internal
			 > 3
			3
			
			Information for Service "monolog.handler.main"
			==============================================
			
			 ------------------ -------------------------------
			  Option             Value
			 ------------------ -------------------------------
			  Service ID         monolog.handler.main
			  Class              Monolog\Handler\StreamHandler
			  Tags               -
			  Calls              pushProcessor
			  Public             yes
			  Synthetic          no
			  Lazy               no
			  Shared             yes
			  Abstract           no
			  Autowired          no
			  Autowiring Types   -
			 ------------------ -------------------------------
- 查看router列表   

	    $ php bin/console debug:router --help
	    Usage:
	      debug:router [options] [--] [<name>]
	    
	    Arguments:
	      nameA route name
	    
	    Options:
	      --show-controllers  Show assigned controllers in overview
	      --format=FORMAT The output format (txt, xml, json, or md) [default: "txt"]
	      --raw   To output raw route(s)
	      -h, --help  Display this help message
	      -q, --quiet Do not output any message
	      -V, --version   Display this application version
	      --ansi  Force ANSI output
	      --no-ansi   Disable ANSI output
	      -n, --no-interactionDo not ask any interactive question
	      -e, --env=ENV   The environment name [default: "dev"]
	      --no-debug  Switches off debug mode
	      -v|vv|vvv, --verboseIncrease the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
	    
	    Help:
	      The debug:router displays the configured routes:
	    
	    php bin/console debug:router


9.数据库相关

- 根据配置创建数据库

		php bin/console doctrine:database:create

- 执行更新数据库操作前，打印SQL
		
		php bin/console doctrine:schema:update --dump-sql

- 执行更新数据库

		php bin/console doctrine:schema:update --force

10.Doctrine preUpdate vs prePersist
	
PrePersist

	The prePersist fires at the point that an entity is first persisted.
	Persisting an object means that it is managed by the Doctrine entityManager, 
	even though it does not actually get inserted into the database until a flush.

PreUpdate

	preUpdate is the corresponding event on an existing object that is about to be updated.
	Because an existing object is already managed by the entityManager at the point that it was queried, 
	there is no equivalent persist event. 
	It basically fires when an existing object has been changed, and a flush has been called.
	
	In other words, if you didn't change anything in the object, PreUpdate will not run!
总结

	There are also 2 forms of these: 
	lifecycle callbacks, which can be annotated directly into the entity and added as methods inside of it, 
	but only have access to the entity attributes. 

	There are also true **event listeners** which have to be registered with the entityManager, and have access to event data that has the type of before/after data you'd expect in a database trigger.


11.Entiy中table设置

        /**
     	* @ORM\Entity
     	* @ORM\Table(name="application", options={"comment":"Funding applications"});
     	*/
    
    	/**
     	* @Entity
     	* @Table(name="user",
     	*  uniqueConstraints={@UniqueConstraint(name="user_unique",columns={"username"})},
     	*  indexes={@Index(name="user_idx", columns={"email"})}
     	*  schema="schema_name"
     	* )
     	*/
    	class User { }

12.How to avoid memory leaks in Symfony 2 Commands 
  
  - dirty Entity Manager  
	Use clear() method once a while, it detaches doctrine objects that are not used any more.

    	$this->em->flush();
     	$this->em->clear();
  - SQL Logger, this one was the worst to find  
  Every time you query database SQL Logger stores information about that.   
  Normally, it’s not a problem but in commands running infinitely every KB counts.  
  You can turn it off like this.

		$this->em = $this->getContainer()->get('doctrine')->getEntityManager();
    	$this->em->getConnection()->getConfiguration()->setSQLLogger(null);

13.批量插入 Bulk Inserts

    $batchSize = 20;
    for ($i = 1; $i <= 10000; ++$i) {
	    $user = new CmsUser;
	    $user->setStatus('user');
	    $user->setUsername('user' . $i);
	    $user->setName('Mr.Smith-' . $i);
	    $em->persist($user);
	    if (($i % $batchSize) === 0) {
		    $em->flush();
		    $em->clear(); // Detaches all objects from Doctrine!
	    }
    }
    $em->flush(); //Persist objects that did not make up an entire batch
    $em->clear();

14.Twig中常用函数  
 Echo raw variable and disable html escaping

    {{ content|raw }}

获取当前时间：

    {{ 'now' | date('Y-m-d H:i:s') }}

字符截断：

	composer require "twig/extensions"  // 加载twig扩展包

    {{ item.address|default('暂无')| truncate(12, false, '...') }}

15.Symfony requirements 检查和优化建议

$ php bin/symfony_requirements

    Symfony Requirements Checker
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    
    > PHP is using the following php.ini file:
      F:\xampp\php\php.ini
    
    > Checking Symfony requirements:
      ................................W.WWW.....
    
    
     [OK]
     Your system is ready to run Symfony projects
    
    
    Optional recommendations to improve your setup
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    
     * intl ICU version installed on your system is outdated (51.2) and
       does not match the ICU data bundled with Symfony (57.1)
       > To get the latest internationalization data upgrade the ICU
       > system package and the intl PHP extension.
    
     * a PHP accelerator should be installed
       > Install and/or enable a PHP accelerator (highly recommended).
    
     * realpath_cache_size should be at least 5M in php.ini
       > Setting "realpath_cache_size" to e.g. "5242880" or "5M" in
       > php.ini* may improve performance on Windows significantly in some
       > cases.
    
     * short_open_tag should be disabled in php.ini
       > Set short_open_tag to off in php.ini*.
    
    
    Note  The command console could use a different php.ini file
    ~~~~  than the one used with your web server. To be on the
      safe side, please check the requirements from your web
      server using the web/config.php script.   
16.Doctrine Callbacks  

**prePersist**  
Executed just before a persi­st(). Therefore, the $id isn't available, but all changes made to the Entity will be persisted in database  

**postPe­rsist**
Executed avec a flush() which had a persi­st() on that Entity. $id is now available, but changes aren't saved  

**preUpdate**  
Executed just before a flush()

**postUpdate**  
The postUpdate event occurs after the database update operations to entity data. It is not called for a DQL UPDATE statement.  

**preRemove**  
Executed before a flush() with a remove() on that Entity   

**postRemove**  
Executed after a flush(). $id is not available anymore  

**postLoad**  
Executed after the Entity has been loaded or reloaded (refr­esh())

**preFlush**  
The preFlush event occurs at the very beginning of a flush operation.  

**onFlush**  
The onFlush event occurs after the change-sets of all managed entities are computed. This event is not a lifecycle callback.  

**postFlush**  
The postFlush event occurs at the end of a flush operation. This event is not a lifecycle callback.  

16.[QueryBuilder examples](QueryBuilder.md "QueryBuilder")  

17.[RawSQLQuery examples](RawSQLQuery.md "RawSQLQuery")  

18.twig中调用服务

	#app/config/config.yml
	twig:
	    globals:
	        your_service_name: "@your_service_id"

twig中调用

	{{ 	your_service_name.methodName(param) }}