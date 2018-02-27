# :elephant: cheat sheets :memo:

1.  [symfony](src/symfony/README.md "symfony") 
	- [Basic](src/symfony/Basic/README.md) 基础和常用
		- [Basic](src/symfony/Basic/Basic.md) 基础知识点
		- [Symfony Twig Extensions](src/symfony/Basic/SymfonyTwigExtensions.md) symfony对Twig的扩展
		- [Shortcuts Methods](src/symfony/Basic/ShortcutsMethods.md) 控制器中的快捷方法
		- [FileControllerHelper](src/symfony/Basic/FileControllerHelper.md) 文件处理的helper
		- [Json Response](src/symfony/Basic/JsonResponse.md) Json响应及参数设置
		- [Streamed Response](src/symfony/Basic/StreamedResponse.md) 流响应
	- [Twig](src/symfony/Twig/README.md) Twig相关
		- [Twig](src/symfony/Twig/Twig.md) Twig基础
		- [Twig Extension](src/symfony/Twig/TwigExtension.md) Twig扩展示例
		- [Twig Form Reference](src/symfony/Twig/TwigFormReference.md) Twig From相关的函数与变量
		- [Twig functions](src/symfony/Twig/functions.md) Twig函数用法示例
	- [Doctrine](src/symfony/Doctrine/README.md) Doctrine相关
		- [Doctrine](src/symfony/Doctrine/Doctrine.md) Doctrine基础知识
		- [An Entity Demo](src/symfony/Doctrine/Entity.md) 一个略复杂的Entity的示例
		- [Doctrine Cache](src/symfony/Doctrine/DoctrineCache.md) 配置Doctrine缓存配置
		- [Doctrine Annotations Reference](src/symfony/Doctrine/DoctrineAnnotationsReference.md)
		- [Doctrine Schema Manager](src/symfony/Doctrine/DoctrineSchemaManager.md) Doctrine 模式管理器
		- [Doctrine SQL Filter](src/symfony/Doctrine/SQLFilter.md) SQL过滤器示例
		- [Doctrine Query Functions](src/symfony/Doctrine/DoctrineQueryFunctions.md) DQL使用SQL函数，例如：DATE_FORMAT
		- [Custom DQL Funtions](src/symfony/Doctrine/CustomDQLFunctions.md) 自定义DQL函数
		- [DQL(Doctrine Query Language)](src/symfony/Doctrine/DQL.md) DQL相关
		- [QueryBuilder examples](src/symfony/Doctrine/QueryBuilder.md "QueryBuilder") 查询构造器示例
		- [RawSQLQuery examples](src/symfony/Doctrine/RawSQLQuery.md "RawSQLQuery") 原生SQL查询
		- [associations](src/symfony/Doctrine/associations.md) 表之间关联
		- [Table to Entity (reverse engineering)](src/symfony/Doctrine/TableToEntity.md) 数据表转Entity（逆向工程）
		- [MultipleDatabase](src/symfony/Doctrine/MultipleDatabase.md) 多数据库配置与使用
	- [Router](src/symfony/Router/README.md) 路由相关
		- [routing.yml](src/symfony/Router/routing.yml.md) yml路由配置示例
	- [Form](src/symfony/Form/README.md) 表单相关
		- [FormBuilder examples](src/symfony/Form/FormBuilder.md "FormBuilder")
		- [Validation Note](src/symfony/Form/Validation.md)  
		- [argument value resolver](src/symfony/Form/argument_value_resolver.md)
		- [create custom field type](src/symfony/Form/create_custom_field_type.md)
		- [create form type extension](src/symfony/Form/create_form_type_extension.md)
		- [Custom Form Theme](src/symfony/Form/CustomFormTheme.md)
		- [DataTransformers](src/symfony/Form/DataTransformers.md)
		- [Pass Custom Options Form](src/symfony/Form/PassCustomOptionsForm.md)
	- [Service](src/symfony/Service/README.md) 服务相关
		- [Service](src/symfony/Service/Service.md)
		- [service id](src/symfony/Service/Service_id.md) 服务ID
		- [autowiring](src/symfony/Service/autowiring.md) 服务的自动装配
		- [alias private service](src/symfony/Service/alias_private_service.md)
		- [Custom Service Tags](src/symfony/Service/CustomServiceTags.md)
		- [service decoration](src/symfony/Service/service_decoration.md)
		- [Service Container](src/symfony/Service/ServiceContainer.md)
	- [Dependency Injection](src/symfony/DependencyInjection/REAMDE.md) 依赖注入相关
		- [Dependency Injection Tags](src/symfony/DependencyInjection/DependencyInjectionTags.md)
		- [Compiler Pass](src/symfony/DependencyInjection/CompilerPass.md)
	- [Security](src/symfony/Security/README.md) 安全相关
		- [security authentication](src/symfony/Security/security-authentication.md)
		- [Authenticator demo](src/symfony/Security/Authenticator-demo.md)
		- [Login and Register](src/symfony/Security/LoginAndRegister.md)
		- [Logout Handler](src/symfony/Security/LogoutHandler.md)
		- [Logout Success Handler](src/symfony/Security/LogoutSuccessHandler.md)
		- [multi field login](src/symfony/Security/multi-field-login.md)
	- [EventListener](src/symfony/EventListener/README.md) 事件监听相关
		- [EventListener](src/symfony/EventListener/EventListener.md) 事件监听
		- [Login Event Listener](src/symfony/EventListener/LoginListener.md) 登录事件监听
		- [Api Version](src/symfony/EventListener/ApiVersion.md) API版本控制
	- [Command](src/symfony/Command/README.md)
		- [Console Command](src/symfony/Command/Console.md) 常用的console命令
		- [Command call Command](src/symfony/Command/CommandCallCommand.md) command之间调用
		- [command in controller](src/symfony/Command/command_in_controller.md) 在控制器调用command
		- [Custom Command](src/symfony/Command/CustomCommand.md) 自定义command
	- [ReusableBundle](src/symfony/ReusableBundle/REAMDE.md) 创建可重复使用bundle相关
		- [BundleStruct](src/symfony/ReusableBundle/BundleStruct.md) 可复用bundle结构
		- [Bundle Configuration](src/symfony/ReusableBundle/BundleConfiguration.md) Bundle配置示例
	- [Components](src/symfony/Components/README.md) 组件相关
		- [Process](src/symfony/Components/Process.md) 在子进程下执行命令
		- [Asset](src/symfony/Components/Asset.md) 管理静态资源。 
		- [Serializer](src/symfony/Components/Serializer.md) 序列化和反序列化
		- [Event Dispatcher](src/symfony/Components/EventDispatcher.md) 事件调度（事件派遣）
		- [Workflow](src/symfony/Components/Workflow.md) 工作流
		- [Stopwatch](src/symfony/Components/Stopwatch.md) 性能调试（时间和内存，可分组）
		- [Finder](src/symfony/Components/Finder.md) 文件和目录查找
		- [Filesystem](src/symfony/Components/Filesystem.md) 对文件系统做了面向对象的封装
		- [Dotenv](src/symfony/Components/Dotenv.md) 设置环境变量
	- [Bundles Note](src/symfony/Bundles-Note/README.md) 第三方bundle使用笔记 
	- [symfony coding standard](src/symfony/SymfonyCodingStandard/README.md) Symfony编码规范
		- [code conventions](src/symfony/SymfonyCodingStandard/code-conventions.md) 代码约定
		- [code standards](src/symfony/SymfonyCodingStandard/code-standards.md) 代码标准
	- [Others](src/symfony/Others/README.md) 其他杂项
		- [Version](src/symfony/Others/Version.md) Symfony版本查看
		- [Upload File](src/symfony/Others/UploadFile.md) 文件上传示例
		- [Cookie](src/symfony/Others/cookie.md) cookie相关
		- [Session](src/symfony/Others/session.md) session相关
		- [Clear Cache In Controller](src/symfony/Others/ClearCacheInController.md)
		- [Symfony Performance](src/symfony/Others/symfony-performance.md)
		- [symfony tips and tricks](src/symfony/Others/symfony-tips-and-tricks.md)
		- [Logger](src/symfony/Others/Logger.md)
		- [symfony 3.3 features](src/symfony/Others/symfony-3.4-features.md)
		- [symfony 3.4 features](src/symfony/Others/symfony-3.4-features.md)
	- [Webpack Encore](src/symfony/WebpackEncore/README.md) Webpack Encore相关
		- [Webpack Encore](src/symfony/WebpackEncore/README.md) Webpack Encore介绍
		- [Webpack Encore Example](src/symfony/WebpackEncore/example.md) Webpack Encore使用示例
	- [Symfony4](src/symfony/Symfony4/README.md) sf4相关
		- [flex](src/symfony/Symfony4/flex.md)
		- [maker-bundle](src/symfony/Symfony4/maker-bundle.md)
		- [recipes-contrib](src/symfony/Symfony4/recipes-contrib.md)
		- [recipes](src/symfony/Symfony4/recipes.md)
	- [Symfony 1.x](src/symfony/Symfony1/README.md)
		- [symfony1.4](src/symfony/Symfony1/symfony1.4) symfony1.4笔记
2.  [chrome extensions](src/chrome_extensions.md "chrome extensions")
3.  [MySQL](src/MySQL/README.md "mysql") 
	- [MySQL join](src/MySQL/join.md)
	- [MySQL functions](src/MySQL/functions.md)
	- [MySQL explain](src/MySQL/explain.md)
	- [MySQL table design](src/MySQL/table_design.md)
	- [MySQL table index](src/MySQL/table_index.md)
	- [my confguire](src/MySQL/my_confguire.md)
	- [MySQL Optimize](src/MySQL/optimize.md)
	- [MySQL where](src/MySQL/where.md)
	- [mysqldump](src/MySQL/mysqldump.md)
	- [Innodb](src/MySQL/Innodb.md)
	- [master slave](src/MySQL/master-slave.md)
	- [grant](src/MySQL/grant.md)
	- [sql_mode](src/MySQL/sql_mode.md)
	- [update root password](src/MySQL/root_password.md)
4.  [composer](src/composer.md "mysql") 
5.  [zend studio](src/zend_studio.md "zend studio")
6.  [guzzle http](src/guzzlehttp.md "guzzle http")
7.  [silex](src/silex.md "silex")
8.  [linux](src/Linux/README.md "linux")
	- [basic](src/Linux/basic.md)
	- [network configure](src/Linux/network_configure.md)
	- [nohup](src/Linux/nohup.md)
	- [sudo](src/Linux/sudo.md)
	- [crontab](src/Linux/crontab.md)
	- [package management](src/Linux/package_management.md)
	- [rsync](src/Linux/rsync.md)
	- [CentOS Local yum repo](src/Linux/CentOSLocalYumRepo.md)
	- [log view](src/Linux/log_view.md)
	- [netstat](src/Linux/netstat.md)
	- [telnet](src/Linux/telnet.md)
	- [iptables](src/Linux/iptables.md)
	- [tar](src/Linux/tar.md)
	- [df & du](src/Linux/df_du.md)
9.  [Go](src/Go/README.md "golang")
	- [gofmt vs go fmt](src/Go/gofmt.md)
	- [Compiler Directives](src/Go/CompilerDirectives.md)
	- [for select](src/Go/for-select.md)
	- [string](src/Go/string.md) 字符串操作相关
	- [string number](src/Go/StringToNumber.md) 数字与字符串之间的转换
	- [vgo](src/Go/vgo.md) 版本控制
10. [redis](src/Redis/README.md "redis")
	- [basic](src/Redis/basic.md) redis基础
	- [redis windows](src/Redis/redis_windows.md)redis在windows上的使用
	- [master slave](src/Redis/master-slave.md) redis配置主从
	- [redis.conf](src/Redis/redis.conf.md) redis配置文件介绍
	- [Predis VS phpredis](src/Redis/PredisVSphpredis.md) Predis与phpredis对比
11. [git note](src/git/README.md "git")
	- [git branch](src/git/branch.md)
	- [git tag](src/git/tag.md)
	- [rm commit log](src/git/rm-commit-log.md)
12. [javascript](src/javascript/README.md "javascript")
	- [json convert](src/javascript/json.md)
	- [flexible](src/javascript/flexible.md)
	- [Mobile Image Upload](src/javascript/MobileImageUpload.md)
13. [framework7](src/framework7.md "framework7")
14. [markdown](src/markdown.md "markdown")
15. [yii2](src/yii2.md)
16. [select2](src/select2.md)
17. [discuz](src/discuz.md)
18. [destoon](src/destoon.md)
19. [CodeIgniter](src/CodeIgniter.md)
20. [cakephp](src/cakephp.md)
21. [yaf](src/yaf.md)
22. [yar](src/yar.md)
23. [PHP](src/php.md)
	- [PHP Extension Install](src/PHP/php-extension-install.md)
	- [Socket](src/PHP/Socket.md)
	- [control structures alternative syntax](src/PHP/alternative-syntax.md) 流程控制的替代语法
24. [PHP code](src/php_code.md)
25. [Shell](src/Shell/README.md)
	- [deploy.sh](src/Shell/deploy.sh.md)
	- [network configure](src/Shell/network_configure.md)
26. [Nginx](src/nginx.md)
	- [nginx basic](src/Nginx/nginx_basic.md)
	- [nginx conf](src/Nginx/nginx.conf.md)
	- [vhost conf](src/Nginx/vhost.md)
	- [proxy_pass](src/Nginx/proxy_pass.md)
	- [ssl](src/Nginx/ssl.md)
27. [Code::Blocks](CodeBlocks.md)
	- [Code::Blocks shortcut](src/CodeBlocks/shortcut.md)
28. [Ubuntu](src/Ubuntu/README.md)
	- [开启sshd服务](src/Ubuntu/sshd.md)
	- [防火墙](src/Ubuntu/firewall.md)
29. [svg](src/svg.md)
30. [wechat](src/wechat/README.md)
31. [FFmpeg](src/FFmpeg.md)
32. [OAuth 2.0](src/OAuth2.0/README.md)
33. [Modbus](src/Modbus/README.md)
	- [SSCOM串口调试软件](src/Modbus/SSCOM.md)
34. [CSS3](src/CSS3/README.md)
	- [rem](src/CSS3/rem.md)
35. [webpack](src/webpack/README.md)
36. [vuejs](src/vuejs/README.md)
37. [HAProxy](src/HAProxy/README.md)
38. [phpStudy](src/phpStudy.md)
39. [windows](src/windows/README.md)
	- [taskkill](src/windows/taskkill.md) 杀进程
40. [assembly](assembly/README.md)汇编语言