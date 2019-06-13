## Cache Component
> The Cache component provides an extended PSR-6 implementation as well as a PSR-16 "Simple Cache" implementation for adding cache to your applications. It is designed for performance and resiliency, and ships with ready to use adapters for the most common caching backends, including proxies for adapting from/to Doctrine Cache.

- Simple Caching (PSR-16)  
支持的类型如下：
	- ApcuCache
	- ArrayCache
	- ChainCache
	- DoctrineCache
	- FilesystemCache
	- MemcachedCache
	- NullCache
	- PdoCache
	- PhpArrayCache
	- PhpFilesCache
	- RedisCache
	- TraceableCache
    ```php
    use Symfony\Component\Cache\Simple\FilesystemCache;
    $cache = new FilesystemCache();
    // save a new item in the cache
    $cache->set('stats.products_count', 4711);
    // or set it with a custom ttl
    // $cache->set('stats.products_count', 4711, 3600);
    // retrieve the cache item
    if (!$cache->has('stats.products_count')) {
        // ... item does not exists in the cache
    }
    // retrieve the value stored by the item
    $productsCount = $cache->get('stats.products_count');
    // or specify a default value, if the key doesn't exist
    // $productsCount = $cache->get('stats.products_count', 100);
    // remove the cache key
    $cache->delete('stats.products_count');
    // clear *all* cache keys
    $cache->clear();
    $cache->setMultiple([
        'stats.products_count' => 4711,
        'stats.users_count' => 1356,
    ]);
    $stats = $cache->getMultiple([
        'stats.products_count',
        'stats.users_count',
    ]);
    $cache->deleteMultiple([
        'stats.products_count',
        'stats.users_count',
    ]);
    ```
- Basic Usage (PSR-6)  
To use the more-advanced, PSR-6 Caching abilities, you'll need to learn its key concepts:
	- Item  
	A single unit of information stored as a key/value pair, where the key is the unique identifier of the information and the value is its contents;
	- Pool  
	A logical repository of cache items. All cache operations (saving items, looking for items, etc.) are performed through the pool. Applications can define as many pools as needed.
	- Adapter  
	It implements the actual caching mechanism to store the information in the filesystem, in a database, etc. The component provides several ready to use adapters for common caching backends (Redis, APCu, Doctrine, PDO, etc.)
    ``` php
    use Symfony\Component\Cache\Adapter\FilesystemAdapter;
    $cache = new FilesystemAdapter();
    // create a new item by trying to get it from the cache
    $productsCount = $cache->getItem('stats.products_count');
    // assign a value to the item and save it
    $productsCount->set(4711);
    $cache->save($productsCount);
    // retrieve the cache item
    $productsCount = $cache->getItem('stats.products_count');
    if (!$productsCount->isHit()) {
        // ... item does not exists in the cache
    }
    // retrieve the value stored by the item
    $total = $productsCount->get();
    // remove the cache item
    $cache->deleteItem('stats.products_count');
    ```