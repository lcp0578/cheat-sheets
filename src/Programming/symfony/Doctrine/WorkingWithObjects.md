## Working with Objects
> https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/working-with-objects.html
> UnitOfWork: A Unit of Work is similar to an object-level transaction. 一个UnitOfWork就像是一个对象级的事务。

- A new Unit of Work is implicitly started when an EntityManager is initially created or after `EntityManager#flush()` has been invoked. 
- A Unit of Work is committed (and a new one started) by invoking `EntityManager#flush()`.
- A Unit of Work can be manually closed by calling `EntityManager#close()`. Any changes to objects within this Unit of Work that have not yet been persisted are lost.
- It is very important to understand that only `EntityManager#flush()` ever causes write operations against the database to be executed. Any other methods such as `EntityManager#persist($entity)` or `EntityManager#remove($entity)` only notify the UnitOfWork to perform these operations during flush.Not calling `EntityManager#flush()` will lead to all changes during that request being lost.
- Doctrine does NEVER touch the public API of methods in your entity
classes (like getters and setters) nor the constructor method. Instead, it uses reflection to get/set data from/to your entity objects. When Doctrine fetches data from DB and saves it back, any code put in your get/set methods won't be implicitly taken into account.