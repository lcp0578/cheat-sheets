## Doctrine Query Functions
- Doctrine 2 extensions bundle
	> [beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions)  
	> A set of extensions to Doctrine 2 that add support for additional query functions available in MySQL, Oracle, Sqlite and PostgreSQL.
	
	- install
	
			composer require beberlei/DoctrineExtensions
	- config
	
			# config.yml
			doctrine:
			    dbal:
			        driver:   pdo_mysql
			        host:     "%database_host%"
			        port:     "%database_port%"
			        dbname:   "%database_name%"
			        user:     "%database_user%"
			        password: "%database_password%"
			        charset:  UTF8
			        # if using pdo_sqlite as your database driver:
			        #   1. add the path in parameters.yml
			        #     e.g. database_path: "%kernel.root_dir%/data/data.db3"
			        #   2. Uncomment database_path in parameters.yml.dist
			        #   3. Uncomment next line:
			        #     path:     "%database_path%"
			
			    orm:
			        auto_generate_proxy_classes: "%kernel.debug%"
			        naming_strategy: doctrine.orm.naming_strategy.underscore
			        auto_mapping: true
			        dql:
			            string_functions:
			                DATE_FORMAT: DoctrineExtensions\Query\Mysql\DateFormat # only for DATE_FORMAT
	- example
	
			public function getList($userId, $page, $pagesize)
		    {
		        $offset = ($page - 1) * $pagesize;
		        $qb = $this->createQueryBuilder('n')
		        ->select("n.id, n.type, n.number, DATE_FORMAT(n.createAt, '%Y-%m-%d %H:%i:%s') as time")
		        ->where('n.userId = :uid')
		        ->setParameter('uid', $userId)
		        ->orderBy('n.id', 'DESC')
		        ->setFirstResult($offset)
		        ->setMaxResults($pagesize);
		        return $qb->getQuery()->getArrayResult();
		    }
- [Custom DQL Functions](CustomDQLFunctions.md)