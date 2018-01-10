## cookie
- 设置cookie

		// use Symfony\Component\HttpFoundation\Cookie;
		$response = new JsonResponse();
		// $response = new Response();
        $response->headers->setCookie(new Cookie('login', uniqid(), $expire));