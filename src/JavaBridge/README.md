## JavaBridge & PageOffice
- PHP实现Java API接口的调用
- 命令行启动

		java -cp "pageoffice-6.5.4.1-javax.jar:JavaBridge.jar:." php.java.bridge.JavaBridge SERVLET_LOCAL:8089
- 集成到TongWeb 8.0.9.06(8.0.7.3有问题)
	- 把文件放到`/usr/local/TongWeb8.0.9.06/domains/domain1/deployment`

			[root@iZ4du01gdr5mku4tpo0wcxZ deployment]# pwd
			/usr/local/TongWeb8.0.9.06/domains/domain1/deployment
			[root@iZ4du01gdr5mku4tpo0wcxZ deployment]# cd JavaBridge/
			[root@iZ4du01gdr5mku4tpo0wcxZ JavaBridge]# ll
			total 16
			-rw-r--r-- 1 root root   25 Dec 11 14:24 index.php
			drwxr-xr-x 2 root root 4096 Dec 11 11:09 java
			drwxr-xr-x 2 root root 4096 Dec 11 10:23 META-INF
			drwxr-xr-x 6 root root 4096 Dec 11 10:38 WEB-INF
			[root@iZ4du01gdr5mku4tpo0wcxZ JavaBridge]# 

	- 修改`tongweb.xml`配置文件（需要先停止TongWeb，才可以修改，都在修改无效，重启后丢失配置）

	 		<applications>
	            .....
	            <app appFrom="fromServer" appId="JavaBridge" contextRoot="JavaBridge" deployException="false" filename="deployment/JavaBridge" type="war" webAppVersion=""/>
	        </applications>
	- 确保开启`PUT`方法，确保使用命令行访问 `http://127.0.0.1:8088/JavaBridge/java/Java.inc`不报错，不乱码。
- PageOffice需要注意的点
	- 需要把客户端软件放到`/usr/local/TongWeb8.0.9.06/domains/domain1/deployment/JavaBridge/WEB-INF/lib`
	- 下载地址：https://gitee.com/pageoffice/pageoffice6-client/releases