## session
- 直接new Session

		// use Symfony\Component\HttpFoundation\Session\Session;
		$session = new Session();
		$session->start();
		
		// set and get session attributes
		$session->set('name', 'Drak');
		$session->get('name');
		
		// set flash messages
		$session->getFlashBag()->add('notice', 'Profile updated');
- symfony <= 3.2

		public function indexAction(Request $request)
		{
		    $session = $request->getSession();
		
		    // store an attribute for reuse during a later user request
		    $session->set('foo', 'bar');
		
		    // get the attribute set by another controller in another request
		    $foobar = $session->get('foobar');
		}
- symfony >= 3.3

		// To retrieve the session, add the SessionInterface type-hint to your argument and Symfony will provide you with a session
		public function indexAction(SessionInterface $session)
		{
		    // store an attribute for reuse during a later user request
		    $session->set('foo', 'bar');
		
		    // get the attribute set by another controller in another request
		    $foobar = $session->get('foobar');
		
		    // use a default value if the attribute doesn't exist
		    $filters = $session->get('filters', array());
		}