## Console
- 安装资源文件

		php bin/console assets:install
		php bin/console assets:install web --symlink --relative
- 查看commad列表(public)

		 php bin/console list

- 清除缓存
		
		php bin/console cache:clear
		php bin/console cache:clear --env=prod --no-debug  //清除生产环境的缓存

	The cache:clear command doesn't clear the Doctrine caches.  
	clear the Doctrine caches, use:

		php bin/console doctrine:cache:clear-metadata --env=prod
		php bin/console doctrine:cache:clear-query --env=prod
		php bin/console doctrine:cache:clear-result --env=prod
- 生成bundle
		
		php bin/console generate:bundle
- 生成Entity

		php bin/console doctrine:generate:entity
- 生成crud操作代码
		
		php bin/console doctrine:generate:crud
- 查看service的列表

		php bin/console  debug:container
	- 查看monolog相关的service
			
			 php bin/console  debug:container monolog

			 Select one of the following services to display its information:
			  [0 ] monolog.activation_strategy.not_found
			  [1 ] monolog.handler.fingers_crossed.error_level_activation_strategy
			  [2 ] monolog.processor.psr_log_message
			  [3 ] monolog.handler.main
			  [4 ] monolog.handler.console
			  [5 ] monolog.logger.request
			  [6 ] monolog.logger.cache
			  [7 ] monolog.logger.translation
			  [8 ] monolog.logger.templating
			  [9 ] monolog.logger.profiler
			  [10] monolog.logger.php
			  [11] monolog.logger.event
			  [12] monolog.logger.router
			  [13] monolog.logger.security
			  [14] monolog.logger.doctrine
			  [15] monolog.logger.assetic
			  [16] monolog.handler.null_internal
			 > 3
			3
			
			Information for Service "monolog.handler.main"
			==============================================
			
			 ------------------ -------------------------------
			  Option             Value
			 ------------------ -------------------------------
			  Service ID         monolog.handler.main
			  Class              Monolog\Handler\StreamHandler
			  Tags               -
			  Calls              pushProcessor
			  Public             yes
			  Synthetic          no
			  Lazy               no
			  Shared             yes
			  Abstract           no
			  Autowired          no
			  Autowiring Types   -
			 ------------------ -------------------------------
- 查看router列表   

	    $ php bin/console debug:router --help
	    Usage:
	      debug:router [options] [--] [<name>]
	    
	    Arguments:
	      nameA route name
	    
	    Options:
	      --show-controllers  Show assigned controllers in overview
	      --format=FORMAT The output format (txt, xml, json, or md) [default: "txt"]
	      --raw   To output raw route(s)
	      -h, --help  Display this help message
	      -q, --quiet Do not output any message
	      -V, --version   Display this application version
	      --ansi  Force ANSI output
	      --no-ansi   Disable ANSI output
	      -n, --no-interactionDo not ask any interactive question
	      -e, --env=ENV   The environment name [default: "dev"]
	      --no-debug  Switches off debug mode
	      -v|vv|vvv, --verboseIncrease the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
	    
	    Help:
	      The debug:router displays the configured routes:
	    
	    php bin/console debug:router
		$ php bin/console debug:router kit_admin_user
		+--------------+---------------------------------------------------------+
		| Property     | Value                                                   |
		+--------------+---------------------------------------------------------+
		| Route Name   | kit_admin_user                                          |
		| Path         | /admin/user/{page}                                      |
		| Path Regex   | #^/admin/user(?:/(?P<page>\d+))?$#s                     |
		| Host         | ANY                                                     |
		| Host Regex   |                                                         |
		| Scheme       | ANY                                                     |
		| Method       | ANY                                                     |
		| Requirements | page: \d+                                               |
		| Class        | Symfony\Component\Routing\Route                         |
		| Defaults     | _controller: KitAdminBundle:User:index                  |
		|              | page: 1                                                 |
		| Options      | compiler_class: Symfony\Component\Routing\RouteCompiler |
		+--------------+---------------------------------------------------------+



- 根据配置创建数据库

		php bin/console doctrine:database:create

- 执行更新数据库操作前，打印SQL
		
		php bin/console doctrine:schema:update --dump-sql

- 执行更新数据库

		php bin/console doctrine:schema:update --force
- How to avoid memory leaks in Symfony Commands 
  
  - dirty Entity Manager  
	Use clear() method once a while, it detaches doctrine objects that are not used any more.

	    	$this->em->flush();
	     	$this->em->clear();
  - SQL Logger, this one was the worst to find  
	  Every time you query database SQL Logger stores information about that.   
	  Normally, it’s not a problem but in commands running infinitely every KB counts.  
	  You can turn it off like this.

			$this->em = $this->getContainer()->get('doctrine')->getEntityManager();
	    	$this->em->getConnection()->getConfiguration()->setSQLLogger(null);
- Symfony requirements 检查和优化建议

		$ php bin/symfony_requirements
		
		    Symfony Requirements Checker
		    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		    
		    > PHP is using the following php.ini file:
		      F:\xampp\php\php.ini
		    
		    > Checking Symfony requirements:
		      ................................W.WWW.....
		    
		    
		     [OK]
		     Your system is ready to run Symfony projects
		    
		    
		    Optional recommendations to improve your setup
		    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		    
		     * intl ICU version installed on your system is outdated (51.2) and
		       does not match the ICU data bundled with Symfony (57.1)
		       > To get the latest internationalization data upgrade the ICU
		       > system package and the intl PHP extension.
		    
		     * a PHP accelerator should be installed
		       > Install and/or enable a PHP accelerator (highly recommended).
		    
		     * realpath_cache_size should be at least 5M in php.ini
		       > Setting "realpath_cache_size" to e.g. "5242880" or "5M" in
		       > php.ini* may improve performance on Windows significantly in some
		       > cases.
		    
		     * short_open_tag should be disabled in php.ini
		       > Set short_open_tag to off in php.ini*.
		    
		    
		    Note  The command console could use a different php.ini file
		    ~~~~  than the one used with your web server. To be on the
		      safe side, please check the requirements from your web
		      server using the web/config.php script.   
- 打印bundle configure reference

		# displays the default config values defined by Symfony
 		php bin/console config:dump-reference twig
		# displays the actual config values used by your application
 		php bin/console debug:config twig

		$ php bin/console config:dump-reference kit_pay
		# Default configuration for extension with alias: "kit_pay"
		kit_pay:
		    config:
		        alipay:
		            use_sandbox:          true
		            partner:              ~
		            app_id:               ~
		            sign_type:            RAS # One of "RSA"; "RSA2"
		            ali_public_key:       ~
		            rsa_private_key:      ~
		            limit_pay:            []
		            notify_url:           ~
		            return_url:           ~
		            return_raw:           true
		        weipay:
		            use_sandbox:          true
		            app_id:               ~
		            mch_id:               ~
		            md5_key:              ~
		            app_cert_pem:         ~
		            app_key_pem:          ~
		            sign_type:            MD5 # One of "MD5"; "HMAC-SHA256"
		            fee_type:             ~ # One of "CNY"
		            limit_pay:            []
		            notify_url:           ~
		            redirect_url:         ~
		            return_raw:           true
- 调试与查看当前配置文件信息
    <details>
    <summary>$ php bin/console debug:config monolog</summary>

     Current configuration for extension with alias "monolog"
            ========================================================

            monolog:
                handlers:
                    main:
                        type: stream
                        path: /home/data/wateroa.sxjicheng.com/wateroa/var/logs/dev.log
                        level: debug
                        channels:
                            type: exclusive
                            elements:
                                - event
                        priority: 0
                        bubble: true
                        app_name: null
                        include_stacktraces: false
                        process_psr_3_messages: true
                        file_permission: null
                        filename_format: '{filename}-{date}'
                        date_format: Y-m-d
                        ident: false
                        logopts: 1
                        facility: user
                        max_files: 0
                        action_level: WARNING
                        activation_strategy: null
                        stop_buffering: true
                        passthru_level: null
                        excluded_404s: {  }
                        excluded_http_codes: {  }
                        accepted_levels: {  }
                        min_level: DEBUG
                        max_level: EMERGENCY
                        buffer_size: 0
                        flush_on_overflow: false
                        exchange_name: log
                        message_format: text
                        api_version: null
                        channel: null
                        bot_name: Monolog
                        use_attachment: true
                        use_short_attachment: false
                        include_extra: false
                        icon_emoji: null
                        notify: false
                        nickname: Monolog
                        use_ssl: true
                        title: null
                        host: null
                        port: 514
                        index: monolog
                        document_type: logs
                        ignore_error: false
                        config: {  }
                        members: {  }
                        to_email: {  }
                        content_type: null
                        mailer: mailer
                        lazy: true
                        time: 60
                        deduplication_level: 400
                        store: null
                        client_id: null
                        auto_log_stacks: false
                        release: null
                        message_type: 0
                        tags: {  }
                        nested: false
                    console:
                        type: console
                        process_psr_3_messages: false
                        channels:
                            type: exclusive
                            elements:
                                - event
                                - doctrine
                                - console
                        priority: 0
                        level: DEBUG
                        bubble: true
                        app_name: null
                        include_stacktraces: false
                        path: /home/data/wateroa.sxjicheng.com/wateroa/var/logs/dev.log
                        file_permission: null
                        filename_format: '{filename}-{date}'
                        date_format: Y-m-d
                        ident: false
                        logopts: 1
                        facility: user
                        max_files: 0
                        action_level: WARNING
                        activation_strategy: null
                        stop_buffering: true
                        passthru_level: null
                        excluded_404s: {  }
                        excluded_http_codes: {  }
                        accepted_levels: {  }
                        min_level: DEBUG
                        max_level: EMERGENCY
                        buffer_size: 0
                        flush_on_overflow: false
                        exchange_name: log
                        message_format: text
                        api_version: null
                        channel: null
                        bot_name: Monolog
                        use_attachment: true
                        use_short_attachment: false
                        include_extra: false
                        icon_emoji: null
                        notify: false
                        nickname: Monolog
                        use_ssl: true
                        title: null
                        host: null
                        port: 514
                        index: monolog
                        document_type: logs
                        ignore_error: false
                        config: {  }
                        members: {  }
                        to_email: {  }
                        content_type: null
                        mailer: mailer
                        lazy: true
                        time: 60
                        deduplication_level: 400
                        store: null
                        client_id: null
                        auto_log_stacks: false
                        release: null
                        message_type: 0
                        tags: {  }
                        nested: false
                    server_log:
                        type: server_log
                        process_psr_3_messages: false
                        host: '127.0.0.1:9911'
                        priority: 0
                        level: DEBUG
                        bubble: true
                        app_name: null
                        include_stacktraces: false
                        path: /home/data/wateroa.sxjicheng.com/wateroa/var/logs/dev.log
                        file_permission: null
                        filename_format: '{filename}-{date}'
                        date_format: Y-m-d
                        ident: false
                        logopts: 1
                        facility: user
                        max_files: 0
                        action_level: WARNING
                        activation_strategy: null
                        stop_buffering: true
                        passthru_level: null
                        excluded_404s: {  }
                        excluded_http_codes: {  }
                        accepted_levels: {  }
                        min_level: DEBUG
                        max_level: EMERGENCY
                        buffer_size: 0
                        flush_on_overflow: false
                        exchange_name: log
                        message_format: text
                        api_version: null
                        channel: null
                        bot_name: Monolog
                        use_attachment: true
                        use_short_attachment: false
                        include_extra: false
                        icon_emoji: null
                        notify: false
                        nickname: Monolog
                        use_ssl: true
                        title: null
                        port: 514
                        index: monolog
                        document_type: logs
                        ignore_error: false
                        config: {  }
                        members: {  }
                        to_email: {  }
                        content_type: null
                        mailer: mailer
                        lazy: true
                        time: 60
                        deduplication_level: 400
                        store: null
                        client_id: null
                        auto_log_stacks: false
                        release: null
                        message_type: 0
                        tags: {  }
                        nested: false
                use_microseconds: true
                channels: {  }
    </details>

- 调试和查看 event dispatcher

		$ php bin/console debug:event-dispatcher kernel.response

		Registered Listeners for "kernel.response" Event
		================================================
		
		 ------- -------------------------------------------------------------------------------------------- ----------
		  Order   Callable                                                                                     Priority
		 ------- -------------------------------------------------------------------------------------------- ----------
		  #1      Symfony\Component\HttpKernel\EventListener\ResponseListener::onKernelResponse()              0
		  #2      Symfony\Bundle\FrameworkBundle\DataCollector\RequestDataCollector::onKernelResponse()        0
		  #3      Symfony\Component\Security\Http\RememberMe\ResponseListener::onKernelResponse()              0
		  #4      Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener::onKernelResponse()       0
		  #5      Symfony\Component\HttpKernel\EventListener\ProfilerListener::onKernelResponse()              -100
		  #6      Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener::onKernelResponse()   -128
		  #7      Symfony\Component\HttpKernel\EventListener\SaveSessionListener::onKernelResponse()           -1000
		  #8      Symfony\Component\HttpKernel\EventListener\StreamedResponseListener::onKernelResponse()      -1024
		 ------- -------------------------------------------------------------------------------------------- ----------



