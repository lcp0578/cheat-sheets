## Query Cache
- redis  
	[官方文档](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/caching.html#redis)介绍如下：  
	In order to use the Redis cache driver you must have it compiled and enabled in your php.ini. You can read about what Redis is from here. Also check A PHP extension for Redis for how you can use and install the Redis PHP extension.   
	配置redis的driver即可，需要安装redis的php扩展。

	- 修改配置
		``` yaml
        # Doctrine Configuration
        doctrine:
            dbal:
               .....

            orm:
                auto_generate_proxy_classes: "%kernel.debug%"
                naming_strategy: doctrine.orm.naming_strategy.underscore
                auto_mapping: true
                # enable metadata caching 
                metadata_cache_driver:
                    type: redis
                    host: 127.0.0.1
                    port: 3306
                    database: 1
                # enable result caching
                result_cache_driver:
                    type: redis
                    host: 127.0.0.1
                    port: 3306
                    database: 2
                # enable query caching 
                query_cache_driver:
                    type: redis
                    host: 127.0.0.1
                    port: 3306
                    database: 3
          ```
	- 使用
	``` php
    public function getLeftNav($ids)
    {
        $qb = $this->createQueryBuilder('r');
        return $qb->where($qb->expr()
            ->andX($qb->expr()
            ->eq('r.status', ':status'), $qb->expr()
            ->in('r.id', ':ids'), $qb->expr()
            ->eq('r.pid', ':pid'), $qb->expr()
            ->isNotNull('r.icon')))
            ->setParameters([
            'status' => 1,
            'ids' => $ids,
            'pid' => 0
        ])
            ->getQuery()
            ->useQueryCache(true) // query cache
            ->useResultCache(true, 86400, sprintf('left_nav_%s', implode('_' , $ids)) //result cache
            ->getResult();
    }
    ```
	- 更新或者删除时，让缓存失效
	``` php
    // in Repository
    $this->_em->getConfiguration()->getResultCacheImpl()->delete($cacheId);
    ```