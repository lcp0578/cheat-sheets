## SQL log
- app/config/config_dev.yml

		monolog:
            handlers:
                main:
                    type: stream
                    path: '%kernel.logs_dir%/%kernel.environment%.log'
                    level: debug
                    channels: ['!event']
                console:
                    type: console
                    process_psr_3_messages: false
                    channels: ['!event', '!doctrine', '!console']
                # To follow logs in real time, execute the following command:
                # `bin/console server:log -vv`
                server_log:
                    type: server_log
                    process_psr_3_messages: false
                    host: 127.0.0.1:9911
                # uncomment to get logging in your browser
                # you may have to allow bigger header sizes in your Web server configuration
                #firephp:
                #    type: firephp
                #    level: info
                #chromephp:
                #    type: chromephp
                #    level: info
                # config doctrine handler
                doctrine:
                    bubble: false
                    action_level: DEBUG
                    type:  stream
                    path:  "%kernel.logs_dir%/%kernel.environment%_doctrine.log"
                    channels: doctrine
- app/config/config.yml

		doctrine:
            dbal:
                driver: pdo_mysql
                host: '%database_host%'
                port: '%database_port%'
                dbname: '%database_name%'
                user: '%database_user%'
                password: '%database_password%'
                charset: UTF8
                logging: '%kernel.debug%' # add this line