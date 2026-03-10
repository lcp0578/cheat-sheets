## ContainerBagInterface
- if some service needs access to lots of parameters, instead of injecting each of them individually, you can inject all the application parameters at once by type-hinting any of its constructor arguments with the ContainerBagInterface

		// src/Service/MessageGenerator.php
		namespace App\Service;
		
		// ...
		
		use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
		
		class MessageGenerator
		{
		    private $params;
		
		    public function __construct(ContainerBagInterface $params)
		    {
		        $this->params = $params;
		    }
		
		    public function someMethod()
		    {
		        // get any container parameter from $this->params, which stores all of them
		        $sender = $this->params->get('mailer_sender');
		        // ...
				$this->params->all();
		    }
		}