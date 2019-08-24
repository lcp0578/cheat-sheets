## SncRedisBundle
- config.yml
``` yaml
snc_redis:
    clients:
        default:
            type: phpredis
            alias: default
            dsn: redis://lcp0578@localhost:6379
            # dsn: redis://localhost #无密码
            logging: "%kernel.debug%"
        cache:
            type: phpredis
            alias: cache
            dsn: redis://lcp0578@localhost:6379
            options:
                profile: 2.2
                connection_timeout: 10
                read_write_timeout: 30
        session:
            type: phpredis
            alias: session
            dsn: redis://lcp0578@localhost:6379
    doctrine:
        metadata_cache:
            client: cache
            namespace: application_name     #应用名称，防止多个应用使用同一redis时，缓存覆盖
            entity_manager: default          # the name of your entity_manager connection
            document_manager: default        # the name of your document_manager connection
        result_cache:
            client: cache
            namespace: application_name     #应用名称，防止多个应用使用同一redis时，缓存覆盖
            entity_manager: default  # you may specify multiple entity_managers
        query_cache:
            client: cache
            namespace: application_name     #应用名称，防止多个应用使用同一redis时，缓存覆盖
            entity_manager: default
        second_level_cache:
            client: cache
            namespace: application_name     #应用名称，防止多个应用使用同一redis时，缓存覆盖
            entity_manager: default
    session:
        client: session
        prefix: session_
        ttl: 3600
        locking: true
        spin_lock_wait: 150000
```