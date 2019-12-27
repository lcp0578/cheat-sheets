## HAProxy
> http://www.haproxy.org

- 相关资料
	- [HAProxy Documentation Converter 官方文档](http://cbonte.github.io/haproxy-dconv/)
	- [https://segmentfault.com/a/1190000007532860](https://segmentfault.com/a/1190000007532860)
	- [HAProxy用法详解 全网最详细中文文档](http://www.ttlsa.com/linux/haproxy-study-tutorial/)
	- [HAproxy功能配置](https://www.jianshu.com/p/8af373981cfe)

- 下载

		wget http://www.haproxy.org/download/2.0/src/haproxy-2.1.0.tar.gz
- 解压

		tar -zxvf haproxy-2.1.0.tar.gz
		cd haproxy-2.1.0
- 安装

		make TARGET=linux-glibc ARCH=x86_64 USE_NS= PREFIX=/usr/local/haproxy
		make install PREFIX=/usr/local/haproxy

		// 参数说明

		TARGET=linux26 #内核版本，使用uname -r查看内核，如：2.6.18-371.el5，此时该参数就为linux26；kernel 大于2.6.28的用：TARGET=linux2628
		ARCH=x86_64 #系统位数
        USE_NS= #在centos6下会报错，`undefined reference to setns`，原因：setns() is supported since linux kernel 3.0，所以centos6（kernel 2.6）安装时需要禁用它
		PREFIX=/usr/local/haprpxy # /usr/local/haprpxy为haprpxy安装路径

- 配置文件haproxy.cfg
	- 应用转发

			global
				daemon
				maxconn 65535
			defaults
				mode http
				timeout connect 5000ms
				timeout client 5000ms
				timeout server 5000ms
			frontend http-in
				bind *:80
				default_backend servers
			backend servers
				server server1 192.168.1.2:80 cookie ser1 weight 10 check inter 2000 rise 2 fall 3
				server server2 192.168.1.3:80 cookie ser2 weight 10 check inter 2000 rise 2 fall 3
				server server3 192.168.1.4:80 cookie ser3 weight 10 check inter 2000 rise 2 fall 3
    - 根据uri转发
    
    		global
                daemon
                maxconn 65535
            defaults
                mode http
                timeout connect 5000ms
                timeout client 5000ms
                timeout server 5000ms
            frontend http-in
                bind *:80
                acl location_app path_beg -i /app/v1/location/report /app/v1/ruim/
                acl bigdata_app path_beg -i /admin/bigdata
                use_backend location_server if location_app
                use_backend bigdata_server if bigdata_app #if后面可写多个条件，空格隔开
                default_backend default_server
            backend default_server
                server server1 127.0.0.1:8080 cookie ser1 weight 100 check inter 2000 rise 2 fall 3
            backend location_server
                #mode http
                balance roundrobin
                server location01 192.168.124.25:8080
                server location02 192.168.124.27:8080
            backend bigdata_server
                server bigdata 192.168.124.26:8080

	- 数据库转发

            global
                daemon
                maxconn 65535
            defaults
                mode tcp
                timeout connect 5000ms
                timeout client 5000ms
                timeout server 5000ms
            listen mysql_server
                bind 0.0.0.0:13306
            	server s1 192.168.124.21:3306
- 启动

		/usr/local/haproxy/sbin/haproxy -f /usr/local/haproxy/haproxy.cfg 
- ACL详解
	- HAProxy 通过ACL 规则完成两种主要的功能，分别是：
		- 通过设置的ACL 规则检查客户端请求是否合法。如果符合ACL 规则要求，那么就将放行，反正，如果不符合规则，则直接中断请求。
		- 符合ACL 规则要求的请求将被提交到后端的backend 服务器集群，进而实现基于ACL 规则的负载均衡。
	- HAProxy 中的ACL 规则经常使用在frontend 段中，使用方法如下：
	
    		acl  自定义的acl名称  acl方法 -i  [匹配的路径或文件]
	- 参数说明，其中：
		- acl：是一个关键字，表示定义ACL 规则的开始。后面需要跟上自定义的ACL 名称 。
		- acl 方法 : 这个字段用来定义实现ACL 的方法，HAProxy 定义了很多ACL 方法，经常使用的方法有hdr_reg(host)、hdr_dom(host)、hdr_beg(host)、url_sub、url_dir、path_beg、path_end 等。
			- hdr_beg(host) #精确匹配主机, 表示以什么开头的域名
			- hdr_reg(host) #正则匹配主机,表示以什么开头的域名
			- path_beg #匹配路径，表示以什么路径开头
			- path_end #匹配路径结尾，表示以什么路径结尾
			- url_sub : 表示请求url 中包含什么字符串，例如：acl file_req url_sub -i killall=，表示在请求url 中包含killall=，则此控制策略返回true
			- url_dir : 表示请求url 中存在哪些字符串作为部分地址路径，例如 acl dir_req url_dir -i allow，表示在请求url 中存在allow作为部分地址路径，则此控制策略返回true,否则返回false
		- -i：表示忽略大小写，后面需要跟上匹配的路径或文件或正则表达式。
	- 与ACL 规则一起使用的HAProxy 参数还有use_backend，use_backend 后面需要跟上一个backend 实例名，表示在满足ACL 规则后去请求哪个backend实例，与use_backend 对应的还有default_backend 参数，它表示在没有满足ACL 条件的时候默认使用哪个后端backend。