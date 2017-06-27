### Raw SQL Query

1.获取Connection
    
	// Doctrine\DBAL\Connection
	$conn = $this->getEntityManager()
	            ->getConnection();

2.bindValue

	$sql = "SELECT * FROM articles WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $id);
	$stmt->execute();
	$stmt->fetchAll();

	// OR
	$sql = '
            SELECT SUM(fc.numberPrinted) as fortunesPrinted, AVG(fc.numberPrinted) as fortunesAverage, cat.name
            FROM fortune_cookie fc
            INNER JOIN category cat ON cat.id = fc.category_id
            WHERE fc.category_id = :category
            ';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array('category' => $category->getId()));
    $stmt->fetchAll();

3.多数据库或多连接

		// Get connections
        $DatabaseEm1 = $this->getDoctrine()->getManager('database_or_connection_name1');
        $DatabaseEm2 = $this->getDoctrine()->getManager('database_or_connection_name2');

        // Write your raw SQL
        $rawQuery1 = 'SELECT * FROM my_table where my_table.field = :status LIMIT 10;';
        $rawQuery2 = 'SELECT * FROM my_table where my_table.field = :text LIMIT 5;';

        // Prepare the query from DATABASE1
        $statementDB1 = $DatabaseEm1->getConnection()->prepare($rawQuery1);
        $statementDB1->bindValue('status', 1);

        // Prepare the query from DATABASE2
        $statementDB2 = $DatabaseEm2->getConnection()->prepare($rawQuery2);
        $statementDB2->bindValue('text', 'Hello World');

        // Execute both queries
        $statementDB1->execute();
        $statementDB2->execute();

        // Get results :)
        $resultDatabase1 = $statementDB1->fetchAll();
        $resultDatabase2 = $statementDB2->fetchAll();

4.executeQuery方式

	$this->getEntityManager()
        ->getConnection()
        ->executeQuery('SELECT r.* FROM receive as r LEFT JOIN treat as t ON t.receive_id = r.id WHERE t.id IS NULL AND r.report_time > :start AND r.report_time < :end LIMIT ' . $offset . ','. $pagesize, [
            'start' => $startDate,
            'end' => $endDate
        ])
        ->fetchAll();

5.executeUpdate  


	// UPDATE `mytable` SET is_processing = :is_processing, end_time=NOW() WHERE id IN(:ids)
	$result = $this->connection->executeUpdate(
	    $sql,
	    array(
	        'is_processing' => false,
	        'ids' => [3, 25]
	    ),
	    array(
	        'ids' => \Doctrine\DBAL\Connection::PARAM_INT_ARRAY
	    )
	);

6.参数处理  
IN 传参数：

	$stmt = $this->getDoctrine()->getEntityManager()
     ->getConnection()
     ->prepare('SELECT t1.id , t1.name
        FROM table1 t1 
        WHERE  t1.id IN (:ids)');

	$stmt->bindValue('ids', $idSArray, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
	$stmt->execute();
or:


	$stmt = $this->getDoctrine()->getEntityManager()
    ->getConnection()
    ->executeQuery('SELECT t1.id , t1.name 
        FROM table1 t1 
        WHERE t1.id IN (:ids)',
        array('ids' => $idSArray),
        array('ids' => \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
    );
binding types：  

- \Doctrine\DBAL\Connection::PARAM_INT_ARRAY
- \Doctrine\DBAL\Connection::PARAM_STR_ARRAY  



		$stmt = $conn->executeQuery('SELECT * FROM articles WHERE id IN (?)',
		    array(array(1, 2, 3, 4, 5, 6)),
		    array(\Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
		);
		// Same SQL WITHOUT usage of Doctrine\DBAL\Connection::PARAM_INT_ARRAY
		$stmt = $conn->executeQuery('SELECT * FROM articles WHERE id IN (?, ?, ?, ?, ?, ?)',
		    array(1, 2, 3, 4, 5, 6),
		    array(\PDO::PARAM_INT, \PDO::PARAM_INT, \PDO::PARAM_INT, \PDO::PARAM_INT, \PDO::PARAM_INT, \PDO::PARAM_INT)
		);
或者使用PDO常量

	public function getListPage($startTime, $endTime, $page, $pagesize)
    {
        $offset = ($page - 1) * $pagesize;
        return $this->getEntityManager()
        ->getConnection()
        ->executeQuery('SELECT * FROM case_receive WHERE report_time > :start AND report_time < :end LIMIT :offset,:pagesize', [
            'start' => $startTime,
            'end' => $endTime,
            'offset' => $offset,
            'pagesize' => $pagesize
        ], [
            'offset' => \PDO::PARAM_INT,
            'pagesize' => \PDO::PARAM_INT
        ])
        ->fetchAll();
    }
7.Affected rows

	$stmt = $this->em->getConnection()->prepare('
	    UPDATE dbo.my_table SET my_col = :old_col_val WHERE my_col = :new_col_val
	');
	
	$stmt->bindValue('old_col_val', 'Old value');
	$stmt->bindValue('new_col_val', 'New value');
	$stmt->execute();
	
	$countUpdated = $stmt->rowCount(); // returns number of updated rows
