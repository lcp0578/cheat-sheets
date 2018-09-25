## ActiveX Object
- 判断ActiveX object是否存在
	- typeof
	
            if(typeof(window.ActiveXObject)=="undefined"){
                alert("ActiveX Object not supported");
            }else {
                alert("ActiveX Object  supported");
            }
    - in
    		
            var hasAX = "ActiveXObject" in window;