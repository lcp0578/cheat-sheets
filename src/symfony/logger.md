## logger 

> Symfony comes with an outside library - called Monolog - that allows you to create logs that can be stored in a variety of different places.

- 简单的使用

		/**
         * @var  \Psr\Log\LoggerInterface $logger
         */
        $logger = $this->get('logger');
        $logger->alert('pay faild', $result);
- 配置日志存放

		monolog:
		    handlers:
		        # this "file_log" key could be anything
		        file_log:
		            type: stream
		            path: "%kernel.logs_dir%/%kernel.environment%_alert.log"
		            level: alert

https://codereviewvideos.com/course/log-log-it-s-better-than-bad-it-s-good/video/10-tips-for-a-better-symfony-debug-log