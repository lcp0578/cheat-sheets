## logger 

> Symfony comes with an outside library - called Monolog - that allows you to create logs that can be stored in a variety of different places.

- 修改symfony prod.log下日志信息

		# app/config/config_prod.yml
        monolog:
            handlers:
                main:
                    type: fingers_crossed
                    action_level: error
                    handler: nested
                nested:
                    type: stream
                    path: '%kernel.logs_dir%/%kernel.environment%.log'
                    level: debug # 更改为error
                console:
                    type: console
                    process_psr_3_messages: false
- 简单的使用

		/**
         * @var  \Psr\Log\LoggerInterface $logger
         */
        $logger = $this->get('logger');
        $logger->alert('pay faild', $result); // $result is array
- 配置日志存放

		monolog:
		    handlers:
		        # this "file_log" key could be anything
		        file_log:
		            type: stream
		            path: "%kernel.logs_dir%/%kernel.environment%_alert.log"
		            level: alert

- 日志的分割

		# app/config/config_dev.yml
        monolog:
            handlers:
                main:
                    type:  rotating_file
                    path:  '%kernel.logs_dir%/%kernel.environment%.log'
                    level: debug
                    # max number of log files to keep
                    # defaults to zero, which means infinite files
                    max_files: 10
- 日志的错误级别
> The LoggerInterface exposes eight methods to write logs to the eight RFC 5424 levels (debug, info, notice, warning, error, critical, alert, emergency).  

https://codereviewvideos.com/course/log-log-it-s-better-than-bad-it-s-good/video/10-tips-for-a-better-symfony-debug-log