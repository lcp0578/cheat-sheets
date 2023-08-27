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