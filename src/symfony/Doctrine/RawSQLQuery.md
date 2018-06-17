### Raw SQL Query
> [doctrine 官方文档 https://www.doctrine-project.org/projects/doctrine-dbal/en/2.7/reference/data-retrieval-and-manipulation.html](https://www.doctrine-project.org/projects/doctrine-dbal/en/2.7/reference/data-retrieval-and-manipulation.html)

1. 获取Connection
    
		// Doctrine\DBAL\Connection
		$conn = $this->getEntityManager()
		            ->getConnection();

2. bindValue

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

3. 多数据库或多连接

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

4. executeQuery方式

		$this->getEntityManager()
	        ->getConnection()
	        ->executeQuery('SELECT r.* FROM receive as r LEFT JOIN treat as t ON t.receive_id = r.id WHERE t.id IS NULL AND r.report_time > :start AND r.report_time < :end LIMIT ' . $offset . ','. $pagesize, [
	            'start' => $startDate,
	            'end' => $endDate
	        ])
	        ->fetchAll();

5. executeUpdate  


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

6. 参数处理  
IN 传参数：

		$stmt = $this->getDoctrine()->getEntityManager()
	    ->getConnection()
	    ->executeQuery('SELECT t1.id , t1.name 
	        FROM table1 t1 
	        WHERE t1.id IN (:ids)',
	        array('ids' => $idsArray),
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

7. Affected rows

		$stmt = $this->em->getConnection()->prepare('
		    UPDATE dbo.my_table SET my_col = :old_col_val WHERE my_col = :new_col_val
		');
		
		$stmt->bindValue('old_col_val', 'Old value');
		$stmt->bindValue('new_col_val', 'New value');
		$stmt->execute();
		
		$countUpdated = $stmt->rowCount(); // returns number of updated rows
8. delete

		// Doctrine\DBAL\Connection
		$conn = $this->getEntityManager()
            ->getConnection();
		$conn->delete('user', array('id' => 1));
		// DELETE FROM user WHERE id = ? (1)
9. insert

		$conn->insert('user', array('username' => 'jwage'));
		// INSERT INTO user (username) VALUES (?) (jwage)
10. update
	
		$conn->update('user', array('username' => 'jwage'), array('id' => 1));
		// UPDATE user (username) VALUES (?) WHERE id = ? (jwage, 1)
11. get result

		->fetchAll() // 获取全部结果
		->fetch() // 获取一条结果
		->fetchColumn() // 获取一条结果中，某个index的值， 0-indexed
	
	fetchAll() 和 fetch() 第一个参数都为$fetchMode，默认是\PDO::FETCH_BOTH。  
	[可选值](http://php.net/manual/en/pdostatement.fetch.php)：

	- PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set

	- PDO::FETCH_BOTH (default): returns an array indexed by both column name and 0-indexed column number as returned in your result set

	- PDO::FETCH_BOUND: returns TRUE and assigns the values of the columns in your result set to the PHP variables to which they were bound with the PDOStatement::bindColumn() method

	- PDO::FETCH_CLASS: returns a new instance of the requested class, mapping the columns of the result set to named properties in the class, and calling the constructor afterwards, unless PDO::FETCH_PROPS_LATE is also given. If fetch_style includes PDO::FETCH_CLASSTYPE (e.g. PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE) then the name of the class is determined from a value of the first column.

	- PDO::FETCH_INTO: updates an existing instance of the requested class, mapping the columns of the result set to named properties in the class

	- PDO::FETCH_LAZY: combines PDO::FETCH_BOTH and PDO::FETCH_OBJ, creating the object variable names as they are accessed

	- PDO::FETCH_NAMED: returns an array with the same form as PDO::FETCH_ASSOC, except that if there are multiple columns with the same name, the value referred to by that key will be an array of all the values in the row that had that column name

	- PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0

	- PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set

	- PDO::FETCH_PROPS_LATE: when used with PDO::FETCH_CLASS, the constructor of the class is called before the properties are assigned from the respective column values.
12. delete() 删除
	
    	->delete('users', array('id' => 1));
		// This is the same as running the following query
		// DELETE FROM users WHERE id = 1