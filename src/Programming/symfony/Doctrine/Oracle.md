## Doctrine使用Oracle
- 配置`config.yml`
``` yaml
# Doctrine Configuration
doctrine:
    dbal:
        default_connection: default
        connections:
            default:
                driver: pdo_mysql
                host: '%database_host%'
                port: '%database_port%'
                dbname: '%database_name%'
                user: '%database_user%'
                password: '%database_password%'
                charset: utf8mb4
                default_table_options:
                    charset: utf8mb4
                    collate: utf8mb4_unicode_ci
                logging: '%kernel.debug%'
                # if using pdo_sqlite as your database driver:
                #   1. add the path in parameters.yml
                #     e.g. database_path: '%kernel.project_dir%/var/data/data.sqlite'
                #   2. Uncomment database_path in parameters.yml.dist
                #   3. Uncomment next line:
                #path: '%database_path%'
            oracle:
                driver: oci8
                host: '%database_oracle_host%'
                port: '%database_oracle_port%'
                dbname: '%database_oracle_name%'
                user: '%database_oracle_user%'
                password: '%database_oracle_password%'
                #servicename: '%database_oracle_servicename%'
                #sessionMode: 4
                charset: AL32UTF8
    orm:
        auto_generate_proxy_classes: '%kernel.debug%'
        default_entity_manager: default
        entity_managers:
            default:
                naming_strategy: doctrine.orm.naming_strategy.underscore
                auto_mapping: true
                dql:
                    string_functions:
                        DATE_FORMAT: DoctrineExtensions\Query\Mysql\DateFormat # only for DATE_FORMAT
                        FIND_IN_SET: DoctrineExtensions\Query\Mysql\FindInSet
                        TO_DATE: DoctrineExtensions\Query\Oracle\ToDate
                filters:
                    base.area_filter: BaseBundle\Doctrine\Filter\AreaFilter
                    base.organization_filter: BaseBundle\Doctrine\Filter\OrganizationFilter
                    organ.organ_filter: OrganBundle\Doctrine\Filter\OrganFilter
            oracle:
                connection: oracle
                mappings:
                    SwapBundle: ~
```
- 解决：`ORA-01861:literal does not match format string`，修改`service.yml`
``` yaml
services:
   ...
   oracle.listener:
        class: Doctrine\DBAL\Event\Listeners\OracleSessionInit
        tags:
            - { name: doctrine.event_listener, event: postConnect }
```
