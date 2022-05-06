## 正则表达式
- 借助IDE与正则表达式进行批量替换

			search reg: \bdefaults:\s\{\s_controller:\s\"(\w+):(\w+):(\w+)\"\s\}
			
				defaults: { _controller: "AclBundle:Role:index" }
			
			
			replace reg: controller: App\\$1\\Controller\\$2Controller::$3Action
			
				controller: App\AclBundleontroller\RoleController::indexAction

			search reg: \bdefaults:\s\{\s_controller:\s(\w+):(\w+):(\w+)\s\}
			
				defaults: { _controller: AclBundle:Role:index }
			
			
			replace reg: controller: App\\$1\\Controller\\$2Controller::$3Action
			
				controller: App\AclBundleontroller\RoleController::indexAction

			search reg: \bdefaults:\s\{\s_controller:\s\"(\w+):(\w+)\/(\w+):(\w+)\"\s\}
			
				defaults: { _controller: "ApiBundle:V1/Help:index" }
			
			
			replace reg: controller: App\\$1\\Controller\\$2\\$3Controller::$4Action
			
				controller: App\ApiBundle\Controller\V1\HelpController::indexAction