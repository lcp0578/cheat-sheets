## javascript

- jquery
	- get() 方法获得由选择器指定的 DOM 元素。
	- $(selector).data(name,value)  使用带有名称/值对的对象向被选元素添加数据。
	- $.extend合并两个json对象
		
			var jsonObj1 = {'a': 1, 'b': 2}
			var jsonObj2 = {'c': 3, 'd': 4}
			var jsonObj3 = {'test':{'a': 1, 'b': 2}}
			var jsonObj4 = {'test':{'c': 3, 'd': 4}}
			var obj1 = $.extend({}, jsonObj1, jsonObj2); // {'a': 1, 'b': 2,'c': 3, 'd': 4}
			var obj2 = $.extend(true, {}, jsonObj3, jsonObj4); // {'test':{'a': 1, 'b': 2,'c': 3, 'd': 4}}
- [json convert](json.md)
- 判断方法是否存在
	
		if (typeof funcName != 'undefined' && funcName instanceof Function) {  
		   funcName();  
		}  
	
		if(objName.funcName) {
			objName.funcName();
		}

		if(typeof(objName.funcName)=="function"){     
		      //存在     
		}else{     
		      //不存在     
		}  
- 检测jQuery方法是否存在

		if( jQuery.isFunction(jQuery.fn.funcName) ) {
			// 如果该方法存在，才去调用
			jQuery(document).funcName();
		}