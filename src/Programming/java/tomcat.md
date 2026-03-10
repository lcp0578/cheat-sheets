## tomcat安装
- 下载源码包  
	下载地址：https://tomcat.apache.org/download-90.cgi
    
    	wget http://mirrors.hust.edu.cn/apache/tomcat/tomcat-9/v9.0.12/bin/apache-tomcat-9.0.12.tar.gz
- 解压

		tar zxvf apache-tomcat-9.0.12.tar.gz
        mv apache-tomcat-9.0.12 /usr/local/tomcat
- 配置文件（如果需要修改tomcat默认端口8080)

		vim /usr/local/tomcat/conf/server.xml

		Connector port="8080" protocol="HTTP/1.1"
- 启动

		./bin/startup.sh
        Using CATALINA_BASE:   /usr/local/tomcat
        Using CATALINA_HOME:   /usr/local/tomcat
        Using CATALINA_TMPDIR: /usr/local/tomcat/temp
        Using JRE_HOME:        /usr/local/java/jdk1.8.0_181/jre
        Using CLASSPATH:       /usr/local/tomcat/bin/bootstrap.jar:/usr/local/tomcat/bin/tomcat-juli.jar
        Tomcat started.