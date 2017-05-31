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