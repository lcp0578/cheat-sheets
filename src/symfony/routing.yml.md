## routing.yml

	kit_data_smslog:
	    resource: "@KitDataBundle/Resources/config/routing/smslog.yml"
	    prefix:   /smslog
	kit_data_search_excel:
	    path:     /search/excel
	    defaults: { _controller: KitDataBundle:Search:excel }
	    methods: [GET,POST]
	    options:
	        expose: true
	kit_rbac_user:
	    path:     /user/{page}
	    defaults: { _controller: KitRbacBundle:Default:index, page: 1 }
	    requirements:
	        page: '\d+'