## symfony
#### [Symfony Guide 入门指南](Guide/README.md)
#### [Basic](Basic/README.md) 基础和常用
- [Basic](Basic/Basic.md) 基础知识点
- [Symfony Twig Extensions](Basic/SymfonyTwigExtensions.md) symfony对Twig的扩展
- [Shortcuts Methods](Basic/ShortcutsMethods.md) 控制器中的快捷方法
- [FileControllerHelper](Basic/FileControllerHelper.md) 文件处理的helper
- [Json Response](Basic/JsonResponse.md) Json响应及参数设置
- [Streamed Response](Basic/StreamedResponse.md) 流响应
#### [Twig](Twig/README.md) Twig相关
- [Twig](Twig/Twig.md) Twig基础
- [Twig Extension](Twig/TwigExtension.md) Twig扩展示例
- [Twig Form Reference](Twig/TwigFormReference.md) Twig From相关的函数与变量
- [Twig functions](Twig/functions.md) Twig函数用法示例
- [Whitespace Control](Twig/WhitespaceControl.md) 空格控制
- [Twig tags](Twig/tags.md) Twig Tags用法示例
- [Twig macro](Twig/macro.md) macro宏的示例
#### [Doctrine](Doctrine/README.md) Doctrine相关
- [Doctrine](Doctrine/Doctrine.md) Doctrine基础知识
- [Doctrine Types](Doctrine/Types.md) Doctrine字段类型
- [Doctrine Uuid Type](Doctrine/UuidType.md) UuidType自定义字段类型
- [An Entity Demo](Doctrine/Entity.md) 一个略复杂的Entity的示例
- [Validation Constraints](Doctrine/constraints.md) 验证约束设置
- [Custom Constraint.md](Doctrine/custom_constraint.md)自定义验证约束
- [Doctrine Cache](Doctrine/DoctrineCache.md) 配置Doctrine缓存配置
- [Doctrine Annotations Reference](Doctrine/DoctrineAnnotationsReference.md)
- [Doctrine Schema Manager](Doctrine/DoctrineSchemaManager.md) Doctrine 模式管理器
- [Doctrine SQL Filter](Doctrine/SQLFilter.md) SQL过滤器示例
- [Doctrine Query Functions](Doctrine/DoctrineQueryFunctions.md) DQL使用SQL函数，例如：DATE_FORMAT
- [Custom DQL Funtions](Doctrine/CustomDQLFunctions.md) 自定义DQL函数
- [DQL(Doctrine Query Language)](Doctrine/DQL.md) DQL相关
- [QueryBuilder examples](Doctrine/QueryBuilder.md "QueryBuilder") 查询构造器示例
- [Query Builder SubQuery 查询构造器嵌套子查询](Doctrine/QueryBuilderSubQuery.md)
- [RawSQLQuery examples](Doctrine/RawSQLQuery.md "RawSQLQuery") 原生SQL查询
- [associations](Doctrine/associations.md) 表之间关联
- [Table to Entity (reverse engineering)](Doctrine/TableToEntity.md) 数据表转Entity（逆向工程）
- [MultipleDatabase](Doctrine/MultipleDatabase.md) 多数据库配置与使用
- [ColumnDefaultValue](Doctrine/ColumnDefaultValue.md) 设置字段默认值的那些坑
- [Schema Manager](Doctrine/Schema.md) Schema管理器的使用
- [batch processing](Doctrine/batch_processing.md) 批量处理
- [truncate table](Doctrine/truncate_table.md) 截断表
- [SQL log](Doctrine/sql_log.md) 开发模式下配置SQL log
- [Working with Objects 对象工作模式](Doctrine/WorkingWithObjects.md)
- [Transactions And Concurrency 事务与并发](Doctrine/TransactionsAndConcurrency.md) 
- [Doctrine使用Oracle](Doctrine/Oracle.md)
- [Doctrine Sharding](Doctrine/sharding.md)
#### [config 框架配置相关](config/README.md)
- [log日志配置](config/log.md)
#### [Router](Router/README.md) 路由相关
- [routing.yml](Router/routing.yml.md) yml路由配置示例
- [Custom Route Loader](Router/CustomRouteLoader.md) 自定义路由加载器
#### [Form](Form/README.md) 表单相关
- [FormBuilder examples](Form/FormBuilder.md "FormBuilder") 表单构造器示例
- [Validation Note](Form/Validation.md) 表单验证相关 
- [Validation Groups](Form/ValidationGroups.md) 验证组
- [Data Transformers](Form/DataTransformers.md)
- [Pass Custom Options Form](Form/PassCustomOptionsForm.md)
- [argument value resolver](Form/argument_value_resolver.md)
- [create custom field type](Form/create_custom_field_type.md)
- [create form type extension](Form/create_form_type_extension.md)
- [Custom Form Theme](Form/CustomFormTheme.md)
- [DataTransformers](Form/DataTransformers.md)
- [dynamic form modification](From/dynamic_form_modification.md)利用事件监听动态修改表单数据
#### [Service](Service/README.md) 服务相关
- [Service](Service/Service.md)
- [service id](Service/Service_id.md) 服务ID
- [autowiring](Service/autowiring.md) 服务的自动装配
- [alias private service](Service/alias_private_service.md)
- [Custom Service Tags](Service/CustomServiceTags.md)
- [service decoration](Service/service_decoration.md)
- [Service Container](Service/ServiceContainer.md)
#### [Dependency Injection](DependencyInjection/REAMDE.md) 依赖注入相关
- [Dependency Injection Tags](DependencyInjection/DependencyInjectionTags.md)
- [Compiler Pass](DependencyInjection/CompilerPass.md)
#### [Security](Security/README.md) 安全相关
- [security authentication](Security/security-authentication.md) 安全相关介绍
- [Authenticator demo](Security/Authenticator-demo.md) 认证器的demo
- [Login and Register](Security/LoginAndRegister.md) 登录和注册相关
- [Logout Handler](Security/LogoutHandler.md) 退出登录（包含失败）处理
- [Logout Success Handler](Security/LogoutSuccessHandler.md) 成功退出登录处理
- [multi field login](Security/multi-field-login.md) 支持多字段登录系统
- [SetLoginToken](Security/SetLoginToken.md) 手动用户登录，设置token
- [Ajax Authentication Listener](Security/AjaxAuthenticationListener.md) Ajax验证监听
#### [EventListener](EventListener/README.md) 事件监听相关
- [EventListener](EventListener/README.md) 事件监听
- [Login Event Listener](EventListener/LoginListener.md) 登录事件监听
- [Guzzle Http Event Listener](EventListener/GuzzleListener.md) GuzzleHttp事件监听
- [Enable SQL Filter Event Listener](EventListener/EnableFilterListener.md) SQL Filter 事件监听
- [Api Version](EventListener/ApiVersion.md) API版本控制
- [kernel view](EventListener/kernel.view.md) 模板层监听
- [Api Exception Listener](EventListener/ExceptionListener.md) API异常监听
- [Doctrine Event Listeners Subscribers](EventListener/doctrine_event_listeners_subscribers.md)Doctrine的事件监听
#### [Command](Command/README.md)
- [Console Command](Command/Console.md) 常用的console命令
- [Command call Command](Command/CommandCallCommand.md) command之间调用
- [command in controller](Command/command_in_controller.md) 在控制器调用command
- [Custom Command](Command/CustomCommand.md) 自定义command
- [command lifecycle](Command/command_lifecycle.md)Command生命周期函数
- [Console Command Style](Command/Style.md) 命令样式
#### [ReusableBundle](ReusableBundle/best_practices.md) 创建可重复使用bundle相关
- [best practices](ReusableBundle/best_practices.md) 可复用bundle的最佳实战
- [Bundle Configuration](ReusableBundle/BundleConfiguration.md) Bundle配置示例
#### [Components](Components/README.md) 组件相关
- [Process](Components/Process.md) 在子进程下执行命令
- [Asset](Components/Asset.md) 管理静态资源。 
- [Serializer](Components/Serializer.md) 序列化和反序列化
- [Event Dispatcher](Components/EventDispatcher.md) 事件调度（事件派遣）
- [Workflow](Components/Workflow.md) 工作流
- [Stopwatch](Components/Stopwatch.md) 性能调试（时间和内存，可分组）
- [Finder](Components/Finder.md) 文件和目录查找
- [Filesystem](Components/Filesystem.md) 对文件系统做了面向对象的封装
- [Dotenv](Components/Dotenv.md) 设置环境变量
- [Ldap](Components/Ldap.md) LDAP server连接相关
- [Config](Components/Config.md) 配置文件组件，支持YAML, XML, INI格式或数据库。
- [Debug](Components/Debug.md) 方便调试的组件
- [VarDumper](Components/VarDumper) 调试时打印信息的组件
- [Cache](Components/Cache.md) 缓存组件，遵循PSR-6、PSR-16规范
#### [Bundles Note](Bundles-Note/README.md) 第三方bundle使用笔记 
- [DoctrineFixturesBundle](Bundles-Note/DoctrineFixturesBundle.md)	初始化数据Bundle笔记
- [KnpPaginatorBundle 分页bundle使用遇到的问题](Bundles-Note/knp-paginator-bundle.md)
- [SncRedisBundle 使用redis配置doctrine、session等](Bundles-Note/SncRedisBundle.md)
#### [symfony coding standard](SymfonyCodingStandard/README.md) Symfony编码规范
- [code conventions](SymfonyCodingStandard/code-conventions.md) 代码约定
- [code standards](SymfonyCodingStandard/code-standards.md) 代码标准
#### [Others](Others/README.md) 其他杂项
- [Version](Others/Version.md) Symfony版本查看
- [Upload File](Others/UploadFile.md) 文件上传示例
- [Cookie](Others/cookie.md) cookie相关
- [Session](Others/session.md) session相关
- [parameters.yml.dist](Others/parameters.yml.dist.md) 配置parameters.yml不更新
- [Clear Cache In Controller](Others/ClearCacheInController.md)
- [Symfony Performance](Others/symfony-performance.md)
- [symfony tips and tricks](Others/symfony-tips-and-tricks.md)
- [Customize Error Pages](src/symfony/Others/customize_error_pages.md) 自定义错误页面
- [Logger](Others/Logger.md)
- [symfony 3.3 features](Others/symfony-3.4-features.md)
- [symfony 3.4 features](Others/symfony-3.4-features.md)
- [web server configuration](Others/web_server_configuration.md)
#### [Deployment](Deployment/README.md)
- [proxies](Deployment/proxies.md) 设置代理
- [symfony deploy](Deployment/deploy.md) symfony项目部署文档
#### [Webpack Encore](WebpackEncore/README.md) Webpack Encore相关
- [Webpack Encore](WebpackEncore/README.md) Webpack Encore介绍
- [Webpack Encore Example](example.md) Webpack Encore使用示例
#### [Symfony4](Symfony4/README.md) sf4相关
- [flex](Symfony4/flex.md)
- [maker-bundle](Symfony4/maker-bundle.md)
- [recipes-contrib](Symfony4/recipes-contrib.md)
- [recipes](Symfony4/recipes.md)
#### [Symfony 1.x](Symfony1/README.md)
- [symfony1.4](Symfony1/symfony1.4) symfony1.4笔记