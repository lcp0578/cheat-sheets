## eclipse
- eclipse启动错误：Java was started but returned exit code=13  
	由软件的兼容性引起的。 比如，装的是64位的JDK+32位的eclipse
- 为eclipse设置fiddler代理
	
	Windows > preferences > java > installed jres   
	选中installed jres > edit   
	设置Default VM arguments为 **-Dhttp.proxySet="true" -Dhttp.proxyHost="127.0.0.1" -Dhttp.proxyPort="8888"**
	
	也可在代码中添加

		System.setProperty("http.proxySet", "true"); 
		System.setProperty("http.proxyHost", "127.0.0.1"); 
		System.setProperty("http.proxyPort", "8888"); 


