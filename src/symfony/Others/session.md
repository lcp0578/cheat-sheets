## session

	// use Symfony\Component\HttpFoundation\Session\Session;
	$session = new Session();
	$session->start();
	
	// set and get session attributes
	$session->set('name', 'Drak');
	$session->get('name');
	
	// set flash messages
	$session->getFlashBag()->add('notice', 'Profile updated');