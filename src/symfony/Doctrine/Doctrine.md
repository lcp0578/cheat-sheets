## Doctrine
- 批量插入 Bulk Inserts

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

- Doctrine生命周期

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
- Entity的filed设置

	    @ORM\Column(name="filed_name", type="string", length=64, nullable=true, options={"default" : "default_value", "comment": "字段注释","fixed": true})
	- default设置字段的默认值
	- nullable设置是否可以为null
	- comment字段的注释
	- fixed=true,把varchar=>char
	- type="string" 
		- length=  255(2 ^ 8 - 1),TINYTEXT 
		- length=  65535(2 ^ 16 - 1),TEXT 
		- length=  16777215(2 ^ 24 - 1),MEDIUMTEXT 
		- length=  4294967295(2 ^ 32 - 1),LONGTEXT 
	- [doctrine types 文档](https://www.doctrine-project.org/projects/doctrine-dbal/en/2.6/reference/types.html)
	
	self join

		/**
	     * One kind has Many kinds.
	     *
	     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="children")
	     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
	     */
	    private $parent;
	    
	    /**
	     * Many kinds have One kind.
	     *
	     * @ORM\OneToMany(targetEntity="Menu", mappedBy="parent")
	     * @ORM\OrderBy({"sort" = "DESC", "id" = "DESC"}) // 排序处理
	     */
	    private $children;

- Entiy中table设置

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
- Doctrine preUpdate vs prePersist
	
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

- Doctrine Callbacks  

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