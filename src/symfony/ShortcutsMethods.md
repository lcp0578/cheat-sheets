## Shortcuts methods in Controller
1. 获取服务

		$this->get($serviceId);
2. 重定向
		
		$this->redirectToRoute($routeName, $parameters, $status = 302);
3. 生成路由的url

		$this->generateUrl($routeName, $parameters, $referenceType);
4. 返回一个json response
		
		$this->json($data, $status = 200, $headers = array(), $context = array());
5. 添加一个flash message

		$this->addFlash($type, $message);
6. 判断是否授权进入某个方法

		$this->isGranted('ROLE_ADMIN');
7. 判断用户是否授权，否，抛出异常
	
		$this->denyAccessUnlessGranted('ROLE_EDIT', $item, 'You cannot edit this item.');
8. 手动判断 CSRF token是否合法

		$this->isCsrfTokenValid('token_id', $token);