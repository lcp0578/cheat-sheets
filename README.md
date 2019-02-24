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
		- [Whitespace Control](src/symfony/Twig/WhitespaceControl.md) 空格控制
		- [Twig tags](src/symfony/Twig/tags.md) Twig Tags用法示例
		- [Twig macro](src/symfony/Twig/macro.md) macro宏的示例
	- [Doctrine](src/symfony/Doctrine/README.md) Doctrine相关
		- [Doctrine](src/symfony/Doctrine/Doctrine.md) Doctrine基础知识
		- [Doctrine Types](src/symfony/Doctrine/Types.md) Doctrine字段类型
		- [An Entity Demo](src/symfony/Doctrine/Entity.md) 一个略复杂的Entity的示例
		- [Validation Constraints](src/symfony/Doctrine/constraints.md) 验证约束设置
		- [Custom Constraint.md](src/symfony/Doctrine/custom_constraint.md)自定义验证约束
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
		- [ColumnDefaultValue](src/symfony/Doctrine/ColumnDefaultValue.md) 设置字段默认值的那些坑
		- [Schema Manager](src/symfony/Doctrine/Schema.md) Schema管理器的使用
		- [batch processing](src/symfony/Doctrine/batch_processing.md) 批量处理
		- [truncate table](src/symfony/Doctrine/truncate_table.md) 截断表
		- [SQL log](src/symfony/Doctrine/sql_log.md) 开发模式下配置SQL log
	- [Router](src/symfony/Router/README.md) 路由相关
		- [routing.yml](src/symfony/Router/routing.yml.md) yml路由配置示例
	- [Form](src/symfony/Form/README.md) 表单相关
		- [FormBuilder examples](src/symfony/Form/FormBuilder.md "FormBuilder") 表单构造器示例
		- [Validation Note](src/symfony/Form/Validation.md) 表单验证相关  
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
		- [security authentication](src/symfony/Security/security-authentication.md)  安全相关介绍
		- [Authenticator demo](src/symfony/Security/Authenticator-demo.md) 认证器的demo
		- [Login and Register](src/symfony/Security/LoginAndRegister.md) 登录和注册相关
		- [Logout Handler](src/symfony/Security/LogoutHandler.md) 退出登录（包含失败）处理
		- [Logout Success Handler](src/symfony/Security/LogoutSuccessHandler.md) 成功退出登录处理
		- [multi field login](src/symfony/Security/multi-field-login.md) 支持多字段登录系统
		- [SetLoginToken](src/symfony/Security/SetLoginToken.md) 手动用户登录，设置token
	- [EventListener](src/symfony/EventListener/README.md) 事件监听相关
		- [EventListener](src/symfony/EventListener/EventListener.md) 事件监听
		- [Login Event Listener](src/symfony/EventListener/LoginListener.md) 登录事件监听
		- [Guzzle Http Event Listener](src/symfony/EventListener/GuzzleListener.md) GuzzleHttp事件监听
		- [Enable SQL Filter Event Listener](src/symfony/EventListener/EnableFilterListener.md) SQL Filter 事件监听
		- [Api Version](src/symfony/EventListener/ApiVersion.md) API版本控制
		- [kernel view](src/symfony/EventListener/kernel.view.md) 模板层监听
		- [Api Exception Listener](src/symfony/EventListener/ExceptionListener.md) API异常监听
		- [Doctrine Event Listeners Subscribers](src/symfony/EventListener/doctrine_event_listeners_subscribers.md)Doctrine的事件监听
	- [Command](src/symfony/Command/README.md)
		- [Console Command](src/symfony/Command/Console.md) 常用的console命令
		- [Command call Command](src/symfony/Command/CommandCallCommand.md) command之间调用
		- [command in controller](src/symfony/Command/command_in_controller.md) 在控制器调用command
		- [Custom Command](src/symfony/Command/CustomCommand.md) 自定义command
		- [Command Lifecycle](src/symfony/Command/command_lifecycle.md)Command生命周期函数
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
		- [Ldap](src/symfony/Components/Ldap.md) LDAP server连接相关
		- [Config](src/symfony/Components/Config.md) 配置文件组件，支持YAML, XML, INI格式或数据库。
		- [Debug](src/symfony/Components/Debug.md) 方便调试的组件
		- [VarDumper](src/symfony/Components/VarDumper) 调试时打印信息的组件
	- [Bundles Note](src/symfony/Bundles-Note/README.md) 第三方bundle使用笔记 
		- [DoctrineFixturesBundle](src/symfony/Bundles-Note/DoctrineFixturesBundle.md)	初始化数据Bundle笔记
	- [symfony coding standard](src/symfony/SymfonyCodingStandard/README.md) Symfony编码规范
		- [code conventions](src/symfony/SymfonyCodingStandard/code-conventions.md) 代码约定
		- [code standards](src/symfony/SymfonyCodingStandard/code-standards.md) 代码标准
	- [Others](src/symfony/Others/README.md) 其他杂项
		- [Version](src/symfony/Others/Version.md) Symfony版本查看
		- [Upload File](src/symfony/Others/UploadFile.md) 文件上传示例
		- [Cookie](src/symfony/Others/cookie.md) cookie相关
		- [Session](src/symfony/Others/session.md) session相关
		- [parameters.yml.dist](src/symfony/Others/parameters.yml.dist.md) 配置parameters.yml不更新
		- [Clear Cache In Controller](src/symfony/Others/ClearCacheInController.md)
		- [Symfony Performance](src/symfony/Others/symfony-performance.md)
		- [symfony tips and tricks](src/symfony/Others/symfony-tips-and-tricks.md)
		- [Logger](src/symfony/Others/Logger.md)配置错误日志
		- [Customize Error Pages](src/symfony/Others/customize_error_pages.md) 自定义错误页面
		- [symfony 3.3 features](src/symfony/Others/symfony-3.4-features.md)
		- [symfony 3.4 features](src/symfony/Others/symfony-3.4-features.md)
		- [web server configuration](src/symfony/Others/web_server_configuration.md)
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
	- [Varnish](src/symfony/Varnish/README.md) symfony使用Varnish加速网站
2.  [chrome extensions](src/chrome_extensions.md "chrome extensions")
3.  [MySQL](src/MySQL/README.md "mysql") 
	- [MySQL join](src/MySQL/join.md)
	- [MySQL functions](src/MySQL/functions.md)
	- [MySQL explain](src/MySQL/explain.md)
	- [MySQL table design](src/MySQL/table_design.md)
	- [MySQL table index](src/MySQL/table_index.md)
	- [my confguire](src/MySQL/my_confguire.md) 常用的配置项
	- [MySQL Optimize](src/MySQL/optimize.md)
	- [MySQL where](src/MySQL/where.md)
	- [mysqldump](src/MySQL/mysqldump.md)
	- [Innodb](src/MySQL/Innodb.md)
	- [master slave](src/MySQL/master-slave.md) 主从配置
	- [grant](src/MySQL/grant.md)
	- [sql_mode](src/MySQL/sql_mode.md) SQL MODE设置与介绍
	- [update root password](src/MySQL/root_password.md)
	- [windows mysql](src/MySQL/windows_mysql.md) windows下安装mysql
	- [DROP INDEX](src/MySQL/DROP_INDEX.md)
	- [Atlas](src/MySQL/Atlas.md) Atlas (MySQL proxy) 使用
	- [MySQL 8 windows install](src/MySQL/mysql8_windows_install.md) MySQL8在windows下的安装
	- [MySQL8 authentication plugin](src/MySQL/mysql8_authentication_plugin.md)MySQL8密码验证插件更换后，问题解决办法
4.  [composer](src/composer/README.md "composer")
	- [composer basic](src/composer/basic.md) composer基础使用
    - [composer config](src/composer/config.md) composer配置相关
    - [composer versions](src/composer/versions.md) composer包版本约定
    - [recover composer.json](src/composer/recover_composer.json.md) 恢复composer.json
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
	- [scp](src/Linux/scp.md)
	- [rz & sz](src/Linux/rzsz.md)
	- [iconv](src/Linux/iconv.md)
	- [Aliyun服务器配置IPV6](src/Linux/ipv6_aliyun.md)
9.  [Go](src/Go/README.md "golang")
	- [gofmt vs go fmt](src/Go/gofmt.md)
	- [Compiler Directives](src/Go/CompilerDirectives.md)
	- [for select](src/Go/for-select.md)
	- [string](src/Go/string.md) 字符串操作相关
	- [string number](src/Go/StringToNumber.md) 数字与字符串之间的转换
	- [number base conversion](src/GO/NumberBaseConversion.md)进制转换
	- [vgo](src/Go/vgo.md) 版本控制
	- [Byte Order](src/Go/ByteOrder.md) 字节序
	- Standard library 标准库笔记
        - [strconv](src/Go/StandardLibrary/strconv.md)
        - [binary](src/Go/StandardLibrary/binary.md)
        - [hex](src/Go/StandardLibrary/hex.md) 16进制操作包
    - [Others Library](src/Go/OthersLibrary/README.md) 其他类库笔记
    - [windows下开发](src/Go/windows/README.md)
		- [call cmd.exe](src/Go/windows/call_cmd.md) 调用cmd.exe并隐藏窗口
	- [Fatal Error](src/Go/FatalError/README.md) 常见的fatal error
		- [fatal error: concurrent map read and map write](src/Go/FatalError/ConcurrentMap.md)并发读写map错误
10. [redis](src/Redis/README.md "redis")
	- [basic](src/Redis/basic.md) redis基础
	- [redis windows](src/Redis/redis_windows.md)redis在windows上的使用
	- [redis install](src/Redis/install.md) Redis源码编译安装
	- [master slave](src/Redis/master-slave.md) redis配置主从
	- [redis.conf](src/Redis/redis.conf.md) redis配置文件介绍
	- [Predis VS phpredis](src/Redis/PredisVSphpredis.md) Predis与phpredis对比
11. [git相关](src/git/README.md "git")
	- [git branch](src/git/branch.md) git分支相关
	- [git tag](src/git/tag.md) git标签相关
	- [rm commit log](src/git/rm-commit-log.md)
	- [git ssh](src/git/git_ssh.md) git ssh配置
	- [fork sync](src/git/fork_sync.md) fork仓库与原仓同步
	- [Github](src/git/github.md) Github clone慢配置
	- [git update](src/git/update.md) git升级
	- [rm git index](src/git/rm.md) 移除文件或目录的git索引
	- [git recover](src/git/git_recover.md) git还原某个提交ID
	- [Gogs](src/git/gogs.md) Gogs代码平台
	- [Gitea](src/git/gitea.md) Gitea(Gogs的一个克隆)
12. [javascript](src/javascript/README.md "javascript")
	- [json convert](src/javascript/json.md)
	- [flexible](src/javascript/flexible.md)
	- [Mobile Image Upload](src/javascript/MobileImageUpload.md)
	- [console](src/javascript/console.md)
	- [knockoutjs](src/javascript/knockoutjs.md)
	- [vuejs](src/javascript/vuejs.md)
	- [ActiveX Object](src/javascript/activex_object.md)判断对象是否存在的方法
	- [requirejs](src/javascript/requirejs.md) requrejs引入js、css、fonts等
	- [art template](src/javascript/art-template.md) art-template模板引擎
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
	- [PHP Extension Install](src/PHP/php-extension-install.md) PHP扩展编译安装
	- [Memcached](src/PHP/memcached.md) PHP Memcached扩展安装
	- [oci8](src/PHP/oci8.md)PHP Oracle连接扩展
	- [Socket](src/PHP/Socket.md)
	- [control structures alternative syntax](src/PHP/alternative-syntax.md) 流程控制的替代语法
	- [SOAP](src/PHP/soap.md) 调用SOAP服务
	- [preg_match VS preg_match_all](src/PHP/preg_match.md) 正则匹配对比
	- [PHP Functions](src/PHP/functions/README.md) PHP常用函数
	- [PHP Extensions](src/PHP/extensions/README.md) PHP常用扩展
24. [PHP code](src/php_code.md)
25. [Shell](src/Shell/README.md)
	- [deploy.sh](src/Shell/deploy.sh.md) 部署项目shell脚本
	- [network configure](src/Shell/network_configure.md)
	- [exit code](src/Shell/exit_code.md)退出码
	- [backup.sh](src/Shell/backup.sh.md) 备份项目shell脚本
26. [Nginx](src/nginx.md)
	- [nginx basic](src/Nginx/nginx_basic.md) nginx基础
    - [nginx conf](src/Nginx/nginx.conf.md) nginx.conf注释版
    - [vhost conf](src/Nginx/vhost.md) vhost配置示例
    - [proxy_pass](src/Nginx/proxy_pass.md) 代理转发
    - [ssl](src/Nginx/ssl.md) SSL配置示例
    - [syntax](src/Nginx/syntax.md) 配置语法
    - [nginx errors](src/Nginx/nginx_errors.md) 常见错误及修复办法
27. [Code::Blocks](CodeBlocks.md)
	- [Code::Blocks shortcut](src/CodeBlocks/shortcut.md)
28. [Ubuntu](src/Ubuntu/README.md)
	- [开启sshd服务](src/Ubuntu/sshd.md)
	- [防火墙](src/Ubuntu/firewall.md)
29. [svg](src/svg.md)
30. [wechat](src/wechat/README.md)
31. [FFmpeg](src/FFmpeg/README.md)
	- [PHP-FFMpeg](src/FFmpeg/PHP-FFMpeg.md)
32. [OAuth 2.0](src/OAuth2.0/README.md)
	- [rfc 6749](src/OAuth2.0/rfc6749.md)
    - Go
        - [github.com/golang/oauth2](https://github.com/golang/oauth2)
        - [github.com/dexidp/dex](https://github.com/dexidp/dex)
        - [github.com/ory/fosite](https://github.com/ory/fosite)
    - PHP
33. [Modbus](src/Modbus/README.md)
	- [SSCOM串口调试软件](src/Modbus/SSCOM.md)
34. [CSS3](src/CSS3/README.md)
	- [rem](src/CSS3/rem.md)
35. [webpack](src/webpack/README.md)
36. [vuejs](src/vuejs/README.md)
37. [HAProxy](src/HAProxy/README.md)
38. [phpStudy](src/phpStudy.md)  phpStudy升级php&MySQL
39. [windows](src/windows/README.md)
	- [taskkill](src/windows/taskkill.md) 杀进程
40. [assembly](src/assembly/README.md)汇编语言
41. [CEF](src/cef/README.md)
42. [VisualStudio](src/VisualStudio/README.md)
	- [InstallShield](src/VisualStudio/InstallShield.md)
43. [java](src/java/README.md)
	- [eclipse](src/java/eclipse.md)eclipse相关
	- [jar](src/java/jar.md) jar反编译
	- [jdk](src/java/jdk.md) jdk安装
	- [tomcat](src/java/tomcat.md)Tomcat安装
44. [xunsearch](src/xunsearch/README.md)
45. [mac](src/mac/README.md) mac相关
	- [keyboard](src/mac/keyboard.md)系统快捷键
	- [chrome](src/mac/chrome.md) Chrome快捷键
46. [MSSQL](src/MSSQL/README.md)
	- [install php sqlsrv extension](src/MSSQL/sqlsrv.md) 安装sqlsrv扩展
47. [Oracle](src/Oracle/README.md) Oracle数据库相关
	- [mac docker oracle](src/Oracle/mac_docker_oracle.md) mac下通过docker安装Oracle
	- [SQL errors](src/Oracle/sql_errors.md) SQL错误笔记
48. [DB](src/DB/README.md) 新型数据相关
	- [TiDB](src/DB/TiDB/README.md)开源分布式 NewSQL 关系型数据库
	- [RadonDB](src/DB/RadonDB/README.md) 云原生的MySQL数据库,可以无限扩展
	- [influxdb](src/DB/influxdb/README.md) 开源时序型数据库
	- [vitess](src/DB/vitess/README.md) 数据库中间件，用于部署、扩展和管理大型MySQL实例集群。
49. [hadoop](src/hadoop/README.md) hadoop分布式计算平台
50. [TCP/IP](src/TCPIP/README.md) TCP/IP协议相关
	- [MQTT](src/TCPIP/MQTT/README.md) 消息队列遥测传输协议
51. [Docker](src/Docker/README.md) Docker相关
52. [OA](src/OA/README.md)
	- [file2pdf](src/OA/file2pdf.md) 文件转PDF
	- [install fonts](src/OA/install_fonts.md)安装中文字体 	
53. [JavaBridge](src/JavaBridge/README.md)
54. [ios](src/ios/README.md)
	- [xcode](src/ios/xcode.md)
55. **Security代码安全**
	- [APP接口安全设计要点](src/Security/APP_API.md)
	- 源代码安全审计
		- [cobra](src/Security/cobra.md)
55. 源代码安全审计
	- [cobra](cobra.md)
56. 用户认证与授权
	- 单点登录SSO
	- CAS
	- OAuth2
57. 消息队列
	- [nsq](src/MQ/nsq.md)
	- [RabbitMQ](src/MQ/RabbitMQ.md)
	- [Kafka](src/MQ/Kafka.md)
	- [ZeroMQ](src/MQ/ZeroMQ.md)
	- [ActiveMQ](src/MQ/ActiveMQ.md)
	- [RocketMQ](src/MQ/RocketMQ.md)
58. [ZooKeeper](src/ZooKeeper/README.md)
	- [基本概念](src/ZooKeeper/basic.md)
	- [典型应用场景](src/ZooKeeper/scene.md)
59. [Erlang](src/Erlang/README.md)
60. [Scala](src/Scala/README.md)
61. [Kotlin](src/Kotlin/README.md)
62. [Go & PHP](src/GoPHP/README.md)
	- goridge
	- roadrunner
	- Spiral Framework