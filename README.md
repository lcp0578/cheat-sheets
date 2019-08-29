# :elephant: cheat sheets :memo:

1.  [symfony](src/symfony/README.md "symfony") 
	- [Symfony Guide 入门指南](src/symfony/Guide/README.md)
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
		- [Doctrine Uuid Type](src/symfony/Doctrine/UuidType.md) UuidType自定义字段类型
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
		- [Query Builder SubQuery 查询构造器嵌套子查询](src/symfony/Doctrine/QueryBuilderSubQuery.md)
		- [RawSQLQuery examples](src/symfony/Doctrine/RawSQLQuery.md "RawSQLQuery") 原生SQL查询
		- [associations](src/symfony/Doctrine/associations.md) 表之间关联
		- [Table to Entity (reverse engineering)](src/symfony/Doctrine/TableToEntity.md) 数据表转Entity（逆向工程）
		- [MultipleDatabase](src/symfony/Doctrine/MultipleDatabase.md) 多数据库配置与使用
		- [ColumnDefaultValue](src/symfony/Doctrine/ColumnDefaultValue.md) 设置字段默认值的那些坑
		- [Schema Manager](src/symfony/Doctrine/Schema.md) Schema管理器的使用
		- [batch processing](src/symfony/Doctrine/batch_processing.md) 批量处理
		- [truncate table](src/symfony/Doctrine/truncate_table.md) 截断表
		- [SQL log](src/symfony/Doctrine/sql_log.md) 开发模式下配置SQL log
		- [Working with Objects 对象工作模式](src/symfony/Doctrine/WorkingWithObjects.md)
		- [Transactions And Concurrency 事务与并发](src/symfony/Doctrine/TransactionsAndConcurrency.md) 
		- [Doctrine使用Oracle](src/symfony/Doctrine/Oracle.md)
		- [Doctrine Sharding](src/symfony/Doctrine/sharding.md)
	- [config 框架配置相关](src/symfony/config/README.md)
		- [log日志配置](src/symfony/config/log.md)
	- [Router](src/symfony/Router/README.md) 路由相关
		- [routing.yml](src/symfony/Router/routing.yml.md) yml路由配置示例
		- [Custom Route Loader](src/symfony/Router/CustomRouteLoader.md) 自定义路由加载器
	- [Form](src/symfony/Form/README.md) 表单相关
		- [FormBuilder examples](src/symfony/Form/FormBuilder.md "FormBuilder") 表单构造器示例
        - [Validation Note](src/symfony/Form/Validation.md) 表单验证相关 
        - [Validation Groups](src/symfony/Form/ValidationGroups.md) 验证组
        - [Data Transformers](src/symfony/Form/DataTransformers.md) 数据转换
        - [Pass Custom Options Form](src/symfony/Form/PassCustomOptionsForm.md)
        - [argument value resolver](src/symfony/Form/argument_value_resolver.md)
        - [create custom field type](src/symfony/Form/create_custom_field_type.md)
        - [create form type extension](src/symfony/Form/create_form_type_extension.md)
        - [Custom Form Theme](src/symfony/Form/CustomFormTheme.md)
        - [DataTransformers](src/symfony/Form/DataTransformers.md)
		- [dynamic form modification](src/symfony/From/dynamic_form_modification.md)利用事件监听动态修改表单数据
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
		- [Ajax Authentication Listener](src/symfony/Security/AjaxAuthenticationListener.md) Ajax验证监听
	- [EventListener](src/symfony/EventListener/README.md) 事件监听相关
		- [EventListener](src/symfony/EventListener/README.md) 事件监听
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
		- [Console Command Style](src/symfony/Command/Style.md) 命令样式
	- [ReusableBundle](src/symfony/ReusableBundle/best_practices.md) 创建可重复使用bundle相关
		- [best practices](src/symfony/ReusableBundle/best_practices.md) 可复用bundle的最佳实战
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
		- [Cache](src/symfony/Components/Cache.md) 缓存组件，遵循PSR-6、PSR-16规范
	- [Bundles Note](src/symfony/Bundles-Note/README.md) 第三方bundle使用笔记 
		- [DoctrineFixturesBundle](src/symfony/Bundles-Note/DoctrineFixturesBundle.md)	初始化数据Bundle笔记
		- [KnpPaginatorBundle 分页bundle使用遇到的问题](src/symfony/Bundles-Note/knp-paginator-bundle.md)
		- [SncRedisBundle 使用redis配置doctrine、session等](src/symfony/Bundles-Note/SncRedisBundle.md)
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
	- [Deployment](src/symfony/Deployment/README.md)
        - [proxies](src/symfony/Deployment/proxies.md) 设置代理
        - [symfony deploy](src/symfony/Deployment/deploy.md) symfony项目部署文档
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
	- [360 Atlas (MySQL proxy)](src/MySQL/Atlas.md)
	- [ProxySQL (C++实现的MySQL Proxy)](src/MySQL/ProxySQL.md)
	- [kingshard (go实现，MySQL Proxy和简化分库分表)](src/MySQL/kingshard.md)
	- [MySQL 8 的变化](src/MySQL/mysql8_change.md)
	- [MySQL 8 windows install](src/MySQL/mysql8_windows_install.md) MySQL8在windows下的安装
	- [MySQL8 authentication plugin](src/MySQL/mysql8_authentication_plugin.md)MySQL8密码验证插件更换后，问题解决办法
	- [show processlist](src/MySQL/show_processlist.md) 查看正在运行的线程
	- [bin log](src/MySQL/binlog.md) bin log恢复数据
	- [Optimistic and Pessimistic Lock 乐观锁与悲观锁](src/MySQL/PessimisticOptimisticLock.md)
	- [MVCC 多版本并发控制](src/MySQL/MVCC.md)
	- [MySQL数据库事务隔离级别(Transaction Isolation Level)](src/MySQL/TransactionIsolationLevel.md)
	- [Innodb锁机制](src/MySQL/InnodbLock.md)
	- [SQL Order of Operations SQL操作顺序](src/MySQL/SQLOrderOfOperations.md)
	- [MySQL 8 新特性 Window Functions](src/MySQL/WindowFunctions.md)
	- [Overview of Partitioning in MySQL](src/MySQL/partitioning.md)
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
	- [history](src/Linux/history.md)
	- [sed](src/Linux/sed.md)
	- [rz & sz](src/Linux/rzsz.md)
	- [iconv](src/Linux/iconv.md)
	- [Aliyun服务器配置IPV6](src/Linux/ipv6_aliyun.md)
	- [chinese support](src/Linux/chinese_support.md) 中文支持
	- [fdisk](src/Linux/fdisk.md) Linux下磁盘挂载
	- [date](src/Linux/date.md) 修改服务器时间
	- [lsof](src/Linux/lsof.md) mac下查看端口。lsof（list open files）是一个查看当前系统文件的工具。
	- [SELinux](src/Linux/SELinux.md) SELinux状态与关闭
	- [glibc 简介与升级](src/Linux/glibc.md)
	- [init 6 VS reboot](src/Linux/init6_reboot.md)
	- [rpm包使用命令](src/Linux/rpm.md)
	- [logrotate 日志分割](src/Linux/logrotate.md)
	- [find 文件查找](src/Linux/find.md)
	- [升级gcc 4.8.5](src/Linux/gcc.md)
	- [kill 批量杀掉筛选的进程](src/Linux/kill.md)
9.  [Go](src/Go/README.md "golang")
	- [path](src/Go/path.md) 环境变量配置
	- [gofmt vs go fmt](src/Go/gofmt.md)
	- [Compiler Directives](src/Go/CompilerDirectives.md)
	- [for select](src/Go/for-select.md)
	- [string](src/Go/string.md) 字符串操作相关
	- [string number](src/Go/StringToNumber.md) 数字与字符串之间的转换
	- [number base conversion](src/Go/NumberBaseConversion.md)进制转换
	- [context 上下文](src/Go/context.md)
	- [vgo](src/Go/vgo.md) 版本控制
	- [Byte Order](src/Go/ByteOrder.md) 字节序
	- Standard library 标准库笔记
        - [strconv](src/Go/StandardLibrary/strconv.md)
        - [binary](src/Go/StandardLibrary/binary.md)
        - [hex](src/Go/StandardLibrary/hex.md) 16进制操作包
        - [context](src/Go/StandardLibrary/context.md)
        - [sync](src/Go/StandardLibrary/sync.md)
    - [Others Library](src/Go/OthersLibrary/README.md) 其他类库笔记
    - [windows下开发](src/Go/windows/README.md)
		- [call cmd.exe](src/Go/windows/call_cmd.md) 调用cmd.exe并隐藏窗口
	- [Package Management](src/Go/PackageManagement/README.md) 包管理相关
		- [go modules](src/Go/PackageManagement/gomodules.md)
		- [goproxy](src/Go/PackageManagement/goproxy.md) 包下载代理
		- [athens](src/Go/PackageManagement/athens.md)
	- [Fatal Error](src/Go/FatalError/README.md) 常见的fatal error
		- [fatal error: concurrent map read and map write](src/Go/FatalError/ConcurrentMap.md)并发读写map错误
	- [Go工具和调试详解](src/Go/go_tools.md)
	- [Goland 快捷键](src/Go/goland.md)
	- [IEEE 754 解析](src/Go/IEEE754.md)
	- [Go's Assembler](src/Go/asm.md)
10. [redis](src/Redis/README.md "redis")
	- [basic](src/Redis/basic.md) redis基础
	- [redis windows](src/Redis/redis_windows.md)redis在windows上的使用
	- [redis install](src/Redis/install.md) Redis源码编译安装
	- [redis.conf](src/Redis/redis.conf.md) redis配置文件介绍
	- [Predis VS phpredis](src/Redis/PredisVSphpredis.md) Predis与phpredis对比
	- [persistence](src/Redis/persistence.md)数据持久化
	- [commands](src/Redis/commands.md) 常用命令
	- [Redis主从 master slave ](src/Redis/master-slave.md)
    - [Redis哨兵 sentinel ](src/Redis/sentinel.md)
    - [Redis集群 cluster](src/Redis/cluster.md)
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
	- [phpize报错，升级autoconf](src/PHP/autoconf.md)
	- [Memcached](src/PHP/memcached.md) PHP Memcached扩展安装
	- [oci8](src/PHP/oci8.md)PHP Oracle连接扩展
	- [Socket](src/PHP/Socket.md)
	- [control structures alternative syntax](src/PHP/alternative-syntax.md) 流程控制的替代语法
	- [SOAP](src/PHP/soap.md) 调用SOAP服务
	- [preg_match VS preg_match_all](src/PHP/preg_match.md) 正则匹配对比
	- [PHP Functions](src/PHP/functions/README.md) PHP常用函数
	- [PHP Extensions](src/PHP/extensions/README.md) PHP常用扩展
	- [php-lua](src/PHP/php_lua.md) PHP调用lua
	- [fgets](src/PHP/fgets.md) fget读取的宽字节字符集问题
24. [PHP code](src/php_code.md)
25. [Shell](src/Shell/README.md)
	- [deploy.sh](src/Shell/deploy.sh.md) 部署项目shell脚本
	- [network configure](src/Shell/network_configure.md)
	- [exit code](src/Shell/exit_code.md)退出码
	- [backup.sh](src/Shell/backup.sh.md) 备份项目shell脚本
26. [Nginx](src/nginx.md)
	- [nginx basic](src/Nginx/nginx_basic.md) nginx基础
	- [version](src/Nginx/version.md) 版本号约定
    - [nginx conf](src/Nginx/nginx.conf.md) nginx.conf注释版
    - [vhost conf](src/Nginx/vhost.md) vhost配置示例
    - [proxy_pass](src/Nginx/proxy_pass.md) 代理转发
    - [ssl](src/Nginx/ssl.md) SSL配置示例
    - [syntax](src/Nginx/syntax.md) 配置语法
    - [nginx errors](src/Nginx/nginx_errors.md) 常见错误及修复办法
    - [install](src/Nginx/install.md) nginx源码编译安装
    - [awk](src/Nginx/awk.md) 利用awk分析access日志
    - [req limit](src/Nginx/limit.md) nginx请求限制
27. [Apache](src/Apache/README.md) 
	- [.htaccess](src/Apache/htaccess.md) 开启.htaccess配置
	- [mac](src/Apache/mac.md) mac下使用
27. [Code::Blocks](CodeBlocks.md)
	- [Code::Blocks shortcut](src/CodeBlocks/shortcut.md)
28. [Ubuntu](src/Ubuntu/README.md)
	- [开启sshd服务](src/Ubuntu/sshd.md)
	- [防火墙](src/Ubuntu/firewall.md)
29. [svg](src/svg.md)
30. [wechat](src/wechat/README.md)
31. [FFmpeg](src/FFmpeg/README.md)
	- [FFmpeg install](src/FFmpeg/install.md)  编译安装FFmpeg
	- [PHP-FFmpeg](src/FFmpeg/PHP-FFmpeg.md) PHP-FFmpeg类库
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
	- [jar](src/java/jar.md) jar运行、反编译
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
48. [DB](src/DB/README.md) 数据库相关
	- [ Sharding VS Partitioning](src/DB/ShardingPartitioning.md)
	- [TiDB](src/DB/TiDB/README.md)开源分布式 NewSQL 关系型数据库
	- [RadonDB](src/DB/RadonDB/README.md) 云原生的MySQL数据库,可以无限扩展
	- [influxdb](src/DB/influxdb/README.md) 开源时序型数据库
	- [vitess](src/DB/vitess/README.md) 数据库中间件，用于部署、扩展和管理大型MySQL实例集群。
	- [LinDB 饿了么开源的时序数据库，LinDB is an open-source Time Series Database which provides high performance, high availability and horizontal scalability.](src/DB/LinDB/README.md) 
49. [hadoop](src/hadoop/README.md) hadoop分布式计算平台
50. [TCP/IP](src/TCPIP/README.md) TCP/IP协议相关
	- [MQTT](src/TCPIP/MQTT/README.md) 消息队列遥测传输协议
51. [Docker](src/Docker/README.md) Docker相关
	- [在CentOS上安装Docker CE](src/Docker/install_centos.md)
	- [docker-compose 安装与介绍](src/Docker/compose.md)
	- [Docker Machine](src/Docker/machine.md)
	- [Docker Swarm](src/Docker/swarm.md)
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
56. 源代码安全审计
	- [cobra](cobra.md)
57. 用户认证与授权
	- 单点登录SSO
	- CAS
	- OAuth2
58. 消息队列
	- [nsq](src/MQ/nsq.md)
	- [RabbitMQ](src/MQ/RabbitMQ.md)
	- [Kafka](src/MQ/Kafka.md)
	- [ZeroMQ](src/MQ/ZeroMQ.md)
	- [ActiveMQ](src/MQ/ActiveMQ.md)
	- [RocketMQ](src/MQ/RocketMQ.md)
59. [ZooKeeper](src/ZooKeeper/README.md)
	- [基本概念](src/ZooKeeper/basic.md)
	- [典型应用场景](src/ZooKeeper/scene.md)
60. [Flink](src/Flink/README.md)
61. [Erlang](src/Erlang/README.md)
62. [Scala](src/Scala/README.md)
63. [Kotlin](src/Kotlin/README.md)
64. [Dart](src/Dart/README.md)
65. [Flutter](src/flutter/README.md)
66. [Go & PHP](src/GoPHP/README.md)
	- goridge
	- roadrunner
	- Spiral Framework
	- [github.com/VKCOM/noverify](https://github.com/VKCOM/noverify)  Pretty fast linter (code static analysis utility) for PHP
67. [crawler 爬虫相关](src/crawler/README.md)
    - selenium
        - [github.com/SeleniumHQ/selenium](https://github.com/SeleniumHQ/selenium)
    - PHP
        - [github.com/FriendsOfPHP/Goutte](https://github.com/FriendsOfPHP/Goutte) Goutte, a simple PHP Web Scraper
        - [github.com/symfony/dom-crawler](https://github.com/symfony/dom-crawler) The DomCrawler component eases DOM navigation for HTML and XML documents.
        - [github.com/symfony/browser-kit](https://github.com/symfony/browser-kit) The BrowserKit component simulates the behavior of a web browser, allowing you to make requests, click on links and submit forms programmatically. 
        - [github.com/symfony/css-selector](https://github.com/symfony/css-selector) The CssSelector component converts CSS selectors to XPath expressions.
        - [github.com/owner888/phpspider](https://github.com/owner888/phpspider)
    - Go
        - [github.com/gocolly/colly](https://github.com/gocolly/colly) Elegant Scraper and Crawler Framework for Golang 
        - [github.com/henrylee2cn/pholcus](https://github.com/henrylee2cn/pholcus) Pholcus is a distributed, high concurrency and powerful web crawler software.
        - [github.com/PuerkitoBio/gocrawl](https://github.com/PuerkitoBio/gocrawl) Polite, slim and concurrent web crawler.
        - [github.com/MontFerret/ferret](https://github.com/MontFerret/ferret) Declarative web scraping
68. [Python](src/python/README.md)
	- [upgrade python](src/python/upgrade.md) CentOS 6 升级Python 2.6到3.6
69. [OpenResty](src/OpenResty/README.md)
	- [OpenResty基础](src/OpenResty/basic.md) 
	- [cosocket](src/OpenResty/cosocket.md)
	- [LuaJIT](src/OpenResty/luajit.md)
	- [APISIX](src/OpenResty/apisix.md)  APISIX is a Cloud-Native Microservices API Gateway
70. [PostgreSQL](src/PostgreSQL/README.md)
	- [PostgreSQL for mac](src/PostgreSQL/mac.md) mac下安装及使用
71. [ICU4C VS ICU4J](src/ICU/README.md)
72. [VS Code](src/VSCode/README.md)
	- [go 环境配置](src/VSCode/go.md)
73. [PLC](src/PLC/README.md)
	- [西门子 S7-200SmartPLC](src/PLC/Siemens.md)