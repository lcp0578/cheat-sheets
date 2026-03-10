## Customize Error Pages 自定义错误页面
- 配置view模板规则

        app/
        └─ Resources/
           └─ TwigBundle/
              └─ views/
                 └─ Exception/
                    ├─ error404.html.twig
                    ├─ error403.html.twig
                    ├─ error.html.twig      # All other HTML errors (including 500)
                    ├─ error404.json.twig
                    ├─ error403.json.twig
                    └─ error.json.twig      # All other JSON errors (including 500)
- 在开发环境测试错误页面
	- 增加路由
	
    		# app/config/routing_dev.yml
            _errors:
                resource: "@TwigBundle/Resources/config/routing/errors.xml"
                prefix:   /_error
    - 测试链接
    
    		http://localhost/app_dev.php/_error/{statusCode}
			http://localhost/app_dev.php/_error/{statusCode}.{format}
- 自定义ExceptionController

		# app/config/config.yml
        twig:
            exception_controller: AppBundle:Exception:showException

	PS: ExceptionController定义		    https://api.symfony.com/3.4/Symfony/Bundle/TwigBundle/Controller/ExceptionController.html