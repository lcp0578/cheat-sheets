## Query Builder
> Doctrine 关于Query Builder的文档
> https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/query-builder.html

- order by multiple

		$qb->add('orderBy','first_name ASC, last_name ASC')
- count

		public function getUnreadCount($userId)
        {
            return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->where('u.userId = :uid AND u.isRead = 0')
            ->setParameter('uid', $userId)
            ->getQuery()
            ->getSingleScalarResult();
        }
- delete

		public function deleteByUserId($userId, $contactId)
        {
            $this->createQueryBuilder('c')
            ->delete()
            ->where('c.userId = :uid AND c.contactId = :cid')
            ->setParameters([
                'uid' => $userId,
                'cid' => $contactId
            ])
            ->getQuery()->getResult();
        }

- query

		 public function getList($userId, $page, $pagesize, $condition = [])
        {
            $offset = ($page - 1) * $pagesize;
            $qb = $this->createQueryBuilder('o')->select("o.id,o.orderNo as order_no, o.number,o.subject,o.status,o.ammount,DATE_FORMAT(o.payAt,'%Y-%m-%d %H:%i') as pay_at,DATE_FORMAT(o.createAt,'%Y-%m-%d %H:%i') as create_at");
            $qb->where('o.clientId = :cid');
            $parameters = [
                'cid' => $userId
            ];
            if(isset($condition['subject']) && !empty($condition['subject'])){
                $qb->andWhere($qb->expr()->like('o.subject', ':subject'));
                $parameters['subject'] = '%'. $condition['subject']. '%';
            }
            if(isset($condition['start_time']) && !empty($condition['start_time'])){
                $qb->andWhere($qb->expr()->gte('o.createAt', ':start'));
                $parameters['start'] = $condition['start_time'];
            }

            if(isset($condition['end_time']) && !empty($condition['end_time'])){
                $qb->andWhere($qb->expr()->lte('o.createAt', $condition['end_time']));
                $parameters['end'] = $condition['end_time'];
            }
            $qb->setParameters($parameters);
            $qb->setMaxResults($pagesize);
            $qb->setFirstResult($offset);   
            return $qb->getQuery()->getArrayResult();
        }
}
- expr 

		$qb = $this->createQueryBuilder();
		$expr = $qb->expr();
		$qb->select('DISTINCT itc.item_id')
		    ->from('items_to_collections', 'itc')
		    ->innerJoin('itc', 'statuses', 's', 's.id = itc.status_id')
		    ->innerJoin('itc', 'tags_to_items', 'tti', 'tti.item_id = itc.item_id')
		    ->where($expr->andX(
		        $expr->eq('s.status_symbol', ':status_symbol'),
		        $expr->eq('tti.tag_id', ':tag_id'),
		        $expr->like('itc.path', ':path')
		    ))
		    ->setParameters([
		        'status_symbol' => 'st_live',
		        'tag_id' => $tag_id,
		        'path' => $parent_path
		    ])
		    ->orderBy('itc.' . $sort_order, 'ASC');
		if ($limit > 0) {
		    $qb->setMaxResults($limit);
		}
		if($offset > 0){
		    $qb->setFirstResult($offset);   
		}
		if (false === empty($existing)) {
		    $qb->andWhere($expr->notIn('itc.item_id', ':item_id'))
		        ->setParameter('item_id', ((array) $existing), , \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
		}
		$items_ids = $qb->execute()->fetchAll(\PDO::FETCH_COLUMN);

- LIKE  

		$qb = $this->createQueryBuilder('u');
		$qb->where(
		         $qb->expr()->like('u.username', ':user')
		     )
		     ->setParameter('user','%Andre%')
		     ->getQuery()
		     ->getResult();

- between

		$qb = $this->createQueryBuilder('u');
		$qb->where(
		         $qb->expr()->between('t.price', $startPrice, $targetPrice)
		     )
     	->getQuery()
     	->getResult();

- IN
	
		$qb = $this->createQueryBuilder('u');
	    $qb->where($qb->expr()->in('u.id', ':ids'));
	    //$qb->add('where', $qb->expr()->in('u.id', ':ids'));
	    $qb->setParameter('ids', $ids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
	    return $qb->getQuery()->getArrayResult();

- orx  

		$conditions = array('e.type = x', 'e.type = Y', 'e.type = N');
		
		$orX = $qb->expr()->orX();
		$orX->addMultiple($conditions);
		
		$qb->where($orX);

- SELECT  

		$qb->select(array('u')) // string 'u' is converted to array internally
		   ->from('User', 'u')
		   ->where($qb->expr()->orX(
		       $qb->expr()->eq('u.id', '?1'),
		       $qb->expr()->like('u.nickname', '?2')
		   ))
           ->distinct() //DISTINCT 去重
		   ->orderBy('u.surname', 'ASC');

- UPDATE

		$qb = $this->em->createQueryBuilder();
		$q = $qb->update('models\User', 'u')
		        ->set('u.username', '?1')
		        ->set('u.email', '?2')
		        ->where('u.id = ?3')
		        ->setParameter(1, $username)
		        ->setParameter(2, $email)
		        ->setParameter(3, $editId)
		        ->getQuery();
		$p = $q->execute();
		
		public function updateStatus($orderNo, $origin, $new)
	    {
	        $qb = $this->createQueryBuilder('o')
	            ->update()
	            ->set('o.status', $new) #int可以直接设置值
                ->set('o.name', $qb->expr->literal($new)) #string类型需要转换一下
	            ->set('o.callbackAt', ':datetime')
	            ->set('o.updateAt',  ':datetime')
	            ->where('o.orderNo = :orderNo AND o.status = :origin')
	            ->setParameters([
	                'orderNo' => $orderNo,
	                'origin' => $origin
	            ])
	            ->setParameter('datetime', new \DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
	            ->getQuery()
	            ->execute();
	    }
        
        public function setRead($mimeId, $toId)
        {
            return $this->createQueryBuilder('r')
            ->update()
            ->set('r.status', 1)
            ->where('r.mimeId = :mid AND r.toId = :tid')
            ->getQuery()
            ->execute([
                'mid' => $mimeId,
                'tid' => $toId
            ]);
        }


- return array result  

		$result = $this->getDoctrine()
	               ->getRepository('MyBundle:MyEntity')
	               ->createQueryBuilder('e')
	               ->select('e')
	               ->getQuery()
	               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
				   //->getArrayResult();
	
		public function getHeaderNav($moduleId, $toArray = false, $ids = null)
	    {
	        $qb = $this->createQueryBuilder('r');
	        $qb->where($qb->expr()
	            ->andX($qb->expr()
	            ->eq('r.status', ':status'), $qb->expr()
	            ->eq('r.pid', ':pid'), $qb->expr()
	            ->isNotNull('r.icon')))
	            ->setParameters([
	            'status' => 1,
	            'pid' => $moduleId
	        ]);
	        if(!empty($ids)){
	            $qb->andWhere('r.id IN(:ids)')->setParameter('ids', $ids);
	        }
	        
	        if ($toArray) {
	            return $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
				// or 
				return $qb->getQuery()->getArrayResult();
	        } else {
	            return $qb->getQuery()->getResult();
	        }
	    }
- getResult() VS getArrayResult()

		public function getChildren($pid, $toArray = false)
	    {
	        $qb = $this->createQueryBuilder('d');
	        $qb->select('d.id,d.name,d.code,d.parentId') // important
	            ->where('d.parentId = :pid AND d.status = :status')
	            ->setParameters([
	            'pid' => $pid,
	            'status' => 1
	        ]);
	        return $qb->getQuery()->useResultCache(true, 86400)->getResult();
			// equal to
			return $qb->getQuery()->useResultCache(true, 86400)->getArrayResult();
	    }
		// output
		array:12 [▼
		  0 => array:7 [▶]
		  1 => array:7 [▶]
		  2 => array:7 [▶]
		  3 => array:7 [▶]
		  4 => array:7 [▶]
		  5 => array:7 [▶]
		  6 => array:7 [▶]
		  7 => array:7 [▶]
		  8 => array:7 [▶]
		  9 => array:7 [▶]
		  10 => array:7 [▶]
		  11 => array:7 [▶]
		]		

		public function getChildren($pid, $toArray = false)
	    {
	        $qb = $this->createQueryBuilder('d');
	        $qb->select('d') // change
	            ->where('d.parentId = :pid AND d.status = :status')
	            ->setParameters([
	            'pid' => $pid,
	            'status' => 1
	        ]);
			if($toArray){
				return $qb->getQuery()->useResultCache(true, 86400)->getResult();
			}else{
				return $qb->getQuery()->useResultCache(true, 86400)->getArrayResult();
			}
	    }
		// output
		// $toARray == true
		array:12 [▼
		  0 => array:7 [▶]
		  1 => array:7 [▶]
		  2 => array:7 [▶]
		  3 => array:7 [▶]
		  4 => array:7 [▶]
		  5 => array:7 [▶]
		  6 => array:7 [▶]
		  7 => array:7 [▶]
		  8 => array:7 [▶]
		  9 => array:7 [▶]
		  10 => array:7 [▶]
		  11 => array:7 [▶]
		]
		// $toArray == false
		array:12 [▼
		  0 => District {#678 ▶}
		  1 => District {#670 ▶}
		  2 => District {#667 ▶}
		  3 => District {#664 ▶}
		  4 => District {#661 ▶}
		  5 => District {#658 ▶}
		  6 => District {#655 ▶}
		  7 => District {#652 ▶}
		  8 => District {#649 ▶}
		  9 => District {#646 ▶}
		  10 => District {#643 ▶}
		  11 => District {#640 ▶}
		]
- join

		public function getList()
	    {
	        return $this->createQueryBuilder('u')
	            ->select('u.id', 'u.username', 'u.createAt', 'u.updateAt', 'r.rolename')
	            ->join('u.group', 'r')  // association
	            //->where('u.status = ?0')
	            //->setParameter(0, 1) // key, The parameter position or name
	            ->where('u.status = :status')
	            ->setParameter('status', 1)
	            ->getQuery()
	            ->getResult();
	       
	    }
- cache result

		return $this->createQueryBuilder('r')
            ->select('r.name')
            ->where('r.id IN(:ids)')
            ->setParameter('ids', $ids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true, 86400, 'custom_cache_id')
            ->getArrayResult();
		// inster or update delete cache
		// to delete cache
		$cacheDriver = $entityManager->getConfiguration()->getResultCacheImpl();
		$cacheDriver->delete('my_custom_id');
		// to delete all cache entries
		$cacheDriver->deleteAll();
- Binding Parameters to Placeholders

		$queryBuilder
		    ->select('id', 'name')
		    ->from('users')
		    ->where('email = ' .  $queryBuilder->createNamedParameter($userInputEmail))
		;
		// SELECT id, name FROM users WHERE email = :dcValue1
		
		$queryBuilder
		    ->select('id', 'name')
		    ->from('users')
		    ->where('email = ' .  $queryBuilder->createPositionalParameter($userInputEmail))
		;
		// SELECT id, name FROM users WHERE email = ?