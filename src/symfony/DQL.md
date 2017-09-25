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