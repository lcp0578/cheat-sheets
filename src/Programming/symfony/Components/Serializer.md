## Serializer

> The Serializer component is meant to be used to turn objects into a specific format (XML, JSON, YAML, ...) and the other way around.

官方文档： [The Serializer Component document.](https://symfony.com/doc/current/components/serializer.html)   
serializer_workflow  
![serializer_workflow](../../../images/serializer_workflow.png)

- 经常遇到的场景，需要把entity的object转成json
	- symfony > 3.1  
		参考：[New in Symfony 3.1: DateTime Normalizer](http://symfony.com/blog/new-in-symfony-3-1-datetime-normalizer)
		
			# config.yml
			framework:
				...
				serializer: { enabled: true }
			# service.yml
			# 把datetime_normalizer放到前面
			datetime_normalizer:                                                                                                                                
		        class: Symfony\Component\Serializer\Normalizer\DateTimeNormalizer
		        arguments: ['Y-m-d H:i:s']
		        tags:
		            - { name: serializer.normalizer }
		    get_set_method_normalizer:
		        class: Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer
		        public: false
		        tags: 
		            - { name: serializer.normalizer }
		    
		    // call code
			$serializer = $this->get('serializer');
	        $entities = $this->getDoctrine()->getRepository('KitSystemBundle:Dictionary')->findAll();
	        // serialize all of your entities
	        $json = $serializer->serialize($entities, 'json');
	        dump($json);
			// output
			[{"id":1,"createAt":"2017-06-05 10:12:34","updateAt":"2017-06-05 10:12:34","admin":null,"ip":null,"content":"\u6253\u67b6","classId":"1","numerical":null,"numericalType":0,"caseType":0},{"id":21,"createAt":"2017-07-07 10:38:10","updateAt":"2017-07-07 10:38:10","admin":"lcpeng","ip":"127.0.0.1","content":"\u6bb4\u6253","classId":"5","numerical":"0","numericalType":1,"caseType":0},{"id":22,"createAt":"2017-07-07 10:38:31","updateAt":"2017-07-07 10:38:31","admin":"lcpeng","ip":"127.0.0.1","content":"\u5165\u5ba4,\u76d7\u7a83","classId":"5","numerical":"0","numericalType":1,"caseType":0}]
	- 另外一种解决方案[JMSSerializerBundle](https://github.com/schmittjoh/JMSSerializerBundle)