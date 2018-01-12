## Twig functions
- attribute 需要动态的调取某个对象的方法或者数组的key的值

		{{ attribute(object, method) }}
		{{ attribute(object, method, arguments) }}
		{{ attribute(array, item) }}
		// 判断是否存在
		{{ attribute(object, method) is defined ? 'Method exists' : 'Method does not exist' }}