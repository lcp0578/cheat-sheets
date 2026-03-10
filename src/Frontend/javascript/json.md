## json convert
- jquery 函数转换
	
		$.parseJSON( jsonstr ); //将json字符串转换成json对象 
		jQuery.parseJSON(jsonstr);
- ie8+浏览器转换方式

		JSON.parse(jsonstr); //将json字符串转换成json对象 
		JSON.stringify(jsonobj); //将json对象转换成json对符串
	注：ie8(兼容模式),ie7和ie6没有JSON对象，推荐采用JSON官方的方式，引入[json2.js](https://github.com/douglascrockford/JSON-js)。 

- eval转换方式

		eval('(' + jsonstr + ')'); //将json字符串转换成json对象,注意需要在json字符外包裹一对小括号 

	 注：ie8(兼容模式),ie7和ie6也可以使用eval()将字符串转为JSON对象，但不推荐这种方式，这种方式不安全eval会执行json串中的表达式。 
