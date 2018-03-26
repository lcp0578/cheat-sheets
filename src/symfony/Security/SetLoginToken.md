## set login token 主动设置登录用户的Token

	/**
     * 设置登录信息
     * 
     * @param WebUser $user
     */
    private function authenticateUser(WebUser $user, $msg)
    {
        $providerKey = 'main'; // your firewall name
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());
        $this->get('security.token_storage')->setToken($token);
        $response = new JsonResponse([
            'code' => 1,
            'msg' => $msg
        ]);
        $response->headers->setCookie(new Cookie('pdd_login', uniqid(),0, '/', null, false, false));
        return $response;
    }
