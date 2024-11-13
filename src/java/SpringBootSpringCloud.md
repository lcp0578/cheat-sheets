## Spring Boot VS Spring Cloud
#### Spring Boot
- Spring Boot 是一个开源的 Java 基础框架，用于创建独立的、生产级别的、基于 Spring 框架的应用。它旨在简化新 Spring 应用的初始搭建以及开发过程。
- 特点：
	- 约定优于配置：Spring Boot 提供了大量的默认配置，这帮助开发者快速启动和运行新应用。
	- 独立运行：Spring Boot 应用可以打包成一个带有嵌入式 HTTP 服务器（如 Tomcat 或 Jetty）的 JAR 文件，从而独立运行。
	- 自动配置：Spring Boot 自动配置特性尝试根据添加的依赖自动配置你的 Spring 应用。
	- 无代码生成和 XML 配置：不需要 XML 配置文件，也不需要代码生成，就可以构建 Spring 应用。

#### Spring Cloud
- Spring Cloud 是基于 Spring Boot 实现的一系列框架，用于简化分布式系统（如微服务架构应用）的开发、部署和运维。

- 特点：
	- 服务发现：Spring Cloud 提供了服务发现的机制，允许应用动态地发现和调用在网络中的其他服务。
	- 配置管理：集中式的、动态的配置管理支持应用在不重启的情况下更新配置。
	- 断路器：提供了断路器功能，增强了系统的容错能力。
	- API 网关：API 网关支持对外部请求的统一入口，提供路由转发、过滤等功能。
	- 分布式消息传递：简化了消息驱动的微服务应用的构建。

#### 区别与联系
- 区别
	- 目的和范围：Spring Boot 旨在简化单个微服务的创建和开发，而 Spring Cloud 关注的是微服务间的互操作性及分布式系统的全局解决方案。
	- 独立性：Spring Boot 可以独立使用来创建应用，不一定需要 Spring Cloud。而 Spring Cloud 是建立在 Spring Boot 基础之上的，用来支持服务的注册、发现、配置等。
- 联系
	- 兼容性：Spring Cloud 完全兼容于 Spring Boot，实际上，使用 Spring Cloud 构建的应用必须是 Spring Boot 应用。
	- 增强：Spring Cloud 在 Spring Boot 的基础上提供了一层高级抽象，它利用 Spring Boot 的开发便利性，增加了对微服务架构下分布式系统问题的解决方案。

#### 结论
- 简而言之，Spring Boot 是构建单个微服务的工具，而 Spring Cloud 提供了在微服务架构下构建、管理和协调分布式系统的工具。它们是现代 Java 开发者构建可靠、可维护、可扩展和易于部署的微服务应用的重要工具。