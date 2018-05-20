## Doctrine SQL Filter
> Doctrine 2.2 features a filter system that allows the developer to add SQL to the conditional clauses of queries, regardless the place where the SQL is generated.  
> [doctrine filter doc](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/filters.html)

- 编写SQLFilter

		<?php
		namespace KitBaseBundle\Doctrine\Filter;
		
		use Doctrine\ORM\Query\Filter\SQLFilter;
		use Doctrine\ORM\Mapping\ClassMetadata;
		
		class OfficeFilter extends SQLFilter
		{
		
		    /**
		     * Gets the SQL query part to add to a query.
		     *
		     * @param ClassMetaData $targetEntity            
		     * @param string $targetTableAlias            
		     *
		     * @return string The constraint SQL if there is available, empty string otherwise.
		     */
		    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
		    {
		        if ($this->checkEntity($targetEntity)) {
		            return sprintf('%s.%s = %s', $targetTableAlias, trim($this->getParameter('filedName'), "'"), $this->getParameter('filedValue'));
		        } else {
		            return '';
		        }
		    }
		
		    private function checkEntity(ClassMetadata $targetEntity)
		    {
		        $entities = [
		            'KitCaseBundle\Entity\Entity1',
		            'KitCaseBundle\Entity\Entity2',
		            'KitCaseBundle\Entity\Entity3',
		        ];
		        
		        return in_array($targetEntity->getReflectionClass()->name, $entities);
		    }
            
            //还可以定义interface来区分是否可以启动filter
            private function checkInterface(ClassMetadata $targetEntity)
            {
                return in_array('BaseBundle\Entity\LevelInterface', $targetEntity->getReflectionClass()->getInterfaceNames());
            }
		}
- 配置SQLFilter

		# app/config/config.yml
		doctrine:
		    dbal:
		         ... 
		
		    orm:
		        ...
		        filters:
		            kit_office_filter: KitBaseBundle\Doctrine\Filter\OfficeFilter
- 为了方便使用，定义SqlFilterService

		<?php
		namespace KitBaseBundle\Service;
		
		use Symfony\Component\DependencyInjection\Container;
		
		class SqlFilterService
		{
		    private $container;
		    /**
		     *
		     * @var \Doctrine\Bundle\DoctrineBundle\Registry
		     */
		    private $doctrine;
		
		    public function __construct(Container $container)
		    {
		        $this->container = $container;
		        $this->doctrine = $this->container->get('doctrine');
		    }
		    /**
		     * enable sql filter
		     *
		     * @param unknown $current
		     */
		    public function enableFilter($em, $filedName)
		    {
		        if (!$this->container->has('security.token_storage')) {
		            return false;
		        }
		        
		        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
		            return false;
		        }
		        /**
		         * @var $user \KitRbacBundle\Entity\User
		         */
		        if (!is_object($user = $token->getUser())) {
		            // e.g. anonymous authentication
		            return false;
		        }
		        $roleId = $user->getRoleId();
		        $office = $user->getOffice();
		        if($roleId > 1){
		            $filters = $em->getFilters()->enable('kit_office_filter');
		            $filters->setParameter('filedName', $filedName);
		            $filters->setParameter('filedValue', $office);
		        }
		        return true;
		    }
		}
- 配置SqlFilterService

		kit.sql_filter_service:
	        class: KitBaseBundle\Service\SqlFilterService
	        arguments: ["@service_container"]
- 使用Filter

		$em = $this->getDoctrine()->getManager();
        /**
         * @var $sqlFilter \KitBaseBundle\Service\SqlFilterService
         */
        $sqlFilter = $this->get('kit.sql_filter_service');
        $result = $sqlFilter->enableFilter($em, 'police_station');
        $category = $this->getDoctrine()->getRepository('KitCaseBundle:ReceiveCategory')->findAll();
- [定义事件监听，全局使用SQL Filter](../EventListener/EnableFilterListener.md)