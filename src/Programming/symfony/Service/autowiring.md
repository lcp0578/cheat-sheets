## Defining Services Dependencies Automatically (Autowiring) 自动装配
> https://symfony.com/doc/3.4/service_container/autowiring.html
> https://symfony.com/doc/3.4/service_container/3.3-di-changes.html
- service.yml

		services:
		    _defaults:
		        autowire: true
		        autoconfigure: true
		        public: false
> classes are automatically registered as services and configured to be autowired. This means you can use them immediately without any configuration.


> The autowiring system looks for a service whose id exactly matches the type-hint.