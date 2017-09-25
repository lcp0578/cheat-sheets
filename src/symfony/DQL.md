## DQL(Doctrine Query Language)
- 连接两个无对应关系的table

		$sql = 'SELECT 
					r,u.mobile,u.name username 
				FROM 
					KitVoidarBundle:Resource AS r 
				JOIN 
					KitWebBundle:WebUser AS u 
				WITH 
					r.userId = u.id 
				ORDER BY r.id DESC';
		$this->getEntityManager()->createQuery($sql);  // 需要注意结果集的格式
- 有对应关系

		public function getList()
	    {
	        return $this->getEntityManager()->createQuery(
	            'SELECT u.id, u.username,u.createAt,u.updateAt, r.rolename FROM KitRbacBundle:User u
	            JOIN u.role r
	            WHERE u.status = :status'
	        )->setParameter('status', 1)->getResult();
	    }