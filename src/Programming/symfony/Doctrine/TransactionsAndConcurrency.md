## Transactions and Concurrency
> https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/transactions-and-concurrency.html

- Transaction Demarcation 事务划分
	- For the most part, Doctrine 2 already takes care of proper transaction demarcation for you: All the write operations (INSERT/UPDATE/DELETE) are queued until EntityManager#flush() is invoked which wraps all of these changes in a single transaction. 
	- 在大多数情况下，Doctrine 2已经为你完成了正确的事务划分：所有写操作（INSERT / UPDATE / DELETE）都会排队，直到调用EntityManager＃flush（），它会在单个事务中包装所有这些更改。
	- Doctrine 2 also allows (and encourages) you to take over and control transaction demarcation yourself.
- Approach
	- Implicitly 隐式
		- The first approach is to use the implicit transaction handling provided by the Doctrine ORM EntityManager. 
		- Since we do not do any custom transaction demarcation in the above code, `EntityManager#flush()` will begin and commit/rollback a transaction. This behavior is made possible by the aggregation of the DML operations by the Doctrine ORM and is sufficient if all the data manipulation that is part of a unit of work happens through the domain model and thus the ORM.
	-  Explicitly 显式
		- Explicit transaction demarcation is required when you want to include custom DBAL operations in a unit of work or when you want to make use of some methods of the `EntityManager` API that require an active transaction. Such methods will throw a `TransactionRequiredException` to inform you of that requirement. 
		``` php
        <?php
        // $em instanceof EntityManager
        $em->getConnection()->beginTransaction(); // suspend auto-commit
        try {
            //... do some work
            $user = new User;
            $user->setName('George');
            $em->persist($user);
            $em->flush();
            $em->getConnection()->commit();
        } catch (Exception $e) {
            $em->getConnection()->rollBack();
            throw $e;
        }
        
        <?php
        // $em instanceof EntityManager
        $em->transactional(function($em) {
            //... do some work
            $user = new User;
            $user->setName('George');
            $em->persist($user);
        });
        ```
        - The difference between`Connection#transactional($func)` and `EntityManager#transactional($func)` is that the latter abstraction flushes the EntityManager prior to transaction commit and rolls back the transaction when an exception occurs.
- Locking Support 锁的支持
	- Optimistic Locking 乐观锁
	- Pessimistic Locking 悲观锁