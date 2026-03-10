## Symfony Guide 入门指南
- composer 相关
- 安装框架
	- 安装框架有两种方式
		- symfony安装器
		- composer安装(推荐)
		``` php
        composer create-project symfony/framework-standard-edition my_project_name "3.4.*"
        ```
- vhost介绍
	- 配置多站点虚拟域名访问
	- apache
	- nginx
- yaml文件介绍
	- 使用缩进表示层级关系
	- 缩进时不允许使用Tab键，只允许使用空格
	- [YAML 语言教程 阮一峰](http://www.ruanyifeng.com/blog/2016/07/yaml.html)
- symfony环境介绍
	- 分为三种环境：prod，生产环境；dev，开发环境；test，测试环境
	- 一般在开发过程中，使用dev模式，需要在链接上加上`app_dev.php`
	- 修改了代码后，想要在prod模式生效，必须执行清除缓存的命令
	``` php
	php bin/console cache:clear --env=prod
    ```
- bundles 介绍
- annotations 注解介绍
- Configuring 配置相关
- 编码规范
- Profiler 框架调试
- Logging Log调试
- Routing 路由相关
- Twig 相关
	- Twig介绍
	- Twig Extension Twig扩展
- Doctrine 相关
- From 相关
- Validation 相关
- console 相关
- Service Container 相关
- Events and Event Listeners 事件和事件监听
- performance 性能调优