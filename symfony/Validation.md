## Validation 
1. 手动校验 csrf token
	  
		$this->isCsrfTokenValid('form', $token); // form default tokenId
		// isCsrfTokenValid is Shortcuts method
		
		// in  Symfony\Bundle\FrameworkBundle\Controller
		protected function isCsrfTokenValid($id, $token)
	    {
	        if (!$this->container->has('security.csrf.token_manager')) {
	            throw new \LogicException('CSRF protection is not enabled in your application.');
	        }
	
	        return $this->container->get('security.csrf.token_manager')->isTokenValid(new CsrfToken($id, $token));
	    }
	手动生成csrf token
	
		$_token = $this->get('security.csrf.token_manager')->generateCsrfToken('form');