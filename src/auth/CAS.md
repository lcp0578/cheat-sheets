## CAS
#### CAS 简介
- 1.1. What is CAS ？
	- CAS （ Central Authentication Service ） 是 Yale 大学发起的一个企业级的、开源的项目，旨在为 Web 应用系统提供一种可靠的单点登录解决方法（属于 Web SSO ）。
	- CAS 开始于 2001 年， 并在 2004 年 12 月正式成为 JA-SIG 的一个项目。
- 1.2. 主要特性
	- 1、 开源的、多协议的 SSO 解决方案； Protocols ： Custom Protocol 、 CAS 、 OAuth 、 OpenID 、 RESTful API 、 SAML1.1 、 SAML2.0 等。
	- 2、 支持多种认证机制： Active Directory 、 JAAS 、 JDBC 、 LDAP 、 X.509 Certificates 等；
	- 3、 安全策略：使用票据（ Ticket ）来实现支持的认证协议；
	- 4、 支持授权：可以决定哪些服务可以请求和验证服务票据（ Service Ticket ）；
	- 5、 提供高可用性：通过把认证过的状态数据存储在 TicketRegistry 组件中，这些组件有很多支持分布式环境的实现， 如： BerkleyDB 、 Default 、 EhcacheTicketRegistry 、 JDBCTicketRegistry 、 JBOSS TreeCache 、 JpaTicketRegistry 、 MemcacheTicketRegistry 等；
	- 6、 支持多种客户端： Java 、 .Net 、 PHP 、 Perl 、 Apache, uPortal 等。

#### CAS 的基本原理
- 结构体系
	- CAS Server
		- CAS Server 负责完成对用户的认证工作, 需要独立部署, CAS Server 会处理用户名/密码等凭证(Credentials) 。
	- CAS Client
		- 负责处理对客户端受保护资源的访问请求，需要对请求方进行身份认证时，重定向到 CAS Server 进行认证。（原则上，客户端应用不再接受任何的用户名密码等 Credentials ）。
		- CAS Client 与受保护的客户端应用部署在一起，以 Filter 方式保护受保护的资源。

- CAS 原理和协议
	- 基础模式
		- 基础模式 SSO 访问流程主要有以下步骤：
			- 访问服务： SSO 客户端发送请求访问应用系统提供的服务资源。
			- 定向认证： SSO 客户端会重定向用户请求到 SSO 服务器。
			- 用户认证：用户身份认证。
			- 发放票据： SSO 服务器会产生一个随机的 Service Ticket 。
			- 验证票据： SSO 服务器验证票据 Service Ticket 的合法性，验证通过后，允许客户端访问服务。
			- 传输用户信息： SSO 服务器验证票据通过后，传输用户认证结果信息给客户端。