## Validation 
1. 手动校验 csrf token
	  
		// "form" default tokenId in controller
		// but, FormType like WebUserType it is "web_user" 
		$this->isCsrfTokenValid('form', $token);  
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
        
2. 使用entity的constraint校验表单的数据

		/**
         * @var \Symfony\Component\Validator\Validator\ValidatorInterface $validator
         */
		$validator = $this->get('validator');
        /**
         * @var \Symfony\Component\Validator\ConstraintViolationListInterface $errors
         */
        $errors = $validator->validate($egressApply);
        if (count($errors) == 0) {
        	
        }