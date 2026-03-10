## knp-paginator-bundle
> $pagination->setParam('section', 'supplier');

- 有having的查询
	- 报错
	
    		Cannot count query that uses a HAVING clause. Use the output walkers for pagination
    - 解决办法
    
    		$pagination = $paginator->paginate($query, $request->query->getInt('page', 1), $pagesize,[
                'wrap-queries' => true
            ]);
- Manual counting

        $count = $entityManager
        ->createQuery('SELECT COUNT(c) FROM Entity\CompositeKey c')
        ->getSingleScalarResult();

        $query = $entityManager
            ->createQuery('SELECT c FROM Entity\CompositeKey c')
            ->setHint('knp_paginator.count', $count);
        $pagination = $paginator->paginate($query, 1, 10, array('distinct' => false));