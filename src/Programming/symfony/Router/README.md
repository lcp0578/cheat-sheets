## Router
- [routing.yml](routing.yml.md) yml路由配置示例
- [Custom Route Loader](CustomRouteLoader.md) 自定义路由加载器
- 用命令调试route

		php bin/console debug:router api_login_index
        +--------------+---------------------------------------------------------+
        | Property     | Value                                                   |
        +--------------+---------------------------------------------------------+
        | Route Name   | api_login_index                                         |
        | Path         | /api/login/                                             |
        | Path Regex   | #^/api/login/$#sD                                       |
        | Host         | ANY                                                     |
        | Host Regex   |                                                         |
        | Scheme       | ANY                                                     |
        | Method       | ANY                                                     |
        | Requirements | NO CUSTOM                                               |
        | Class        | Symfony\Component\Routing\Route                         |
        | Defaults     | _controller: ApiBundle:Login:index                      |
        | Options      | compiler_class: Symfony\Component\Routing\RouteCompiler |
        | Callable     | ApiBundle\Controller\LoginController::indexAction       |
        +--------------+---------------------------------------------------------+