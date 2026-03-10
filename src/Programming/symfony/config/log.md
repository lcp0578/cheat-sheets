## log相关配置
- config_dev.yml

        monolog:
            handlers:
                main:
                    type:  rotating_file #日志切割，每天生成一个日志文件，类似dev-2019-06-23.log
                    path: '%kernel.logs_dir%/%kernel.environment%.log'
                    level: debug
                    channels: ['!event']
                    max_files: 10 #最多保存10个日志文件，多余的会被删除
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