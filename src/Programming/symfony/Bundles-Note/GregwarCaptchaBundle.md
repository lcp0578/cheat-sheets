## GregwarCaptchaBundle
- config

		gregwar_captcha:
		    expiration: 120
		    width: 70
		    height: 30
		    length: 4
		    as_url: true
		    text_color: [255, 255, 255]
		    background_color: [0, 62, 116]
		    ignore_all_effects: false
		    distortion: false
		    interpolation: false
		    charset: 'abcdefhjkmnprstuvwxyz'
- API提供验证码

		public function indexAction(Request $request)
	    {
	        $key = $request->query->get('key', 'register');
	        $keys = ['login', 'register'];
	        if(!in_array($key, $keys)){
	            return $this->json([
	                'code' => 0,
	                'error' => 'key error'
	            ]);
	        }
	        /**
	         * @var \Symfony\Component\HttpFoundation\Session\Session $session
	         */
	        $session = $this->get('session');
	        $session->set('captcha_whitelist_key', $keys);
	        return $this->forward('GregwarCaptchaBundle:Captcha:generateCaptcha', ['key' => $key]);
	    }