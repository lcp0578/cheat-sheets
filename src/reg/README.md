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
- 匹配中文

		\#\[Route\(\'\/(\w+)\'\, name\: \'(\w+)\'\, options\: \[ \'menu\' \=\> \[\'name\' \=\> \'(\w*[\u4e00-\u9fa5]*)\'\, \'icon\' \=\> \'(\w*)\'\, \'status\' \=\> \'(\w+)\'\, \'is_show\' \=\> \'(\w+)\'\, \'is_authorize\' \=\> \'(\w+)\'\, \'level\' \=\> \'(\w+)\'\,\'node\' \=\> \'(\w+)\'\, \'parent_route\' \=\> \'(\w+)\'\]\]\)\]

		\#\[Route\(
		        \'\/$1',
		        name\: \'$2\',
		        options\: \[
		            \'menu\' \=\> \[
		                \'name\' \=\>\ \'$3\',
		                'icon' => '$4',
		                'status' => '$5',
		                'is_show' => '$6',
		                'is_authorize' => '$7',
		                'level' => '$8',
		                'node' => '$9',
		                'parent_route' => '$10'
		            ]
		        ]
		    )]