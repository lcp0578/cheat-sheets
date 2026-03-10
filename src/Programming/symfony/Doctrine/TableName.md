## setPrimaryTable根据参数动态设置表名
- 主要使用`setPrimaryTable`方法

		public function getPageQuery(string $yearMonth, string $username = ''): \Doctrine\ORM\Query
	    {
	        $this->getClassMetadata()->setPrimaryTable([
	            'name' => 'login_log_'.$yearMonth
	        ]);
	        $qb = $this->createQueryBuilder('a');
	        $qb->select('a');
	        if(!empty($username)){
	            $qb->where($qb->expr()->like('l.username', ':user'))
	                ->setParameter('user','%'. $username .'%');
	        }
	
	        return $qb->orderBy('a.id', 'DESC')
	            ->getQuery();
	    }