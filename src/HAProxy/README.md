## HAProxy
> http://www.haproxy.org

- 相关资料
	- [HAProxy Documentation Converter 官方文档](http://cbonte.github.io/haproxy-dconv/)
	- [https://segmentfault.com/a/1190000007532860](https://segmentfault.com/a/1190000007532860)
	- [HAProxy用法详解 全网最详细中文文档](http://www.ttlsa.com/linux/haproxy-study-tutorial/)
	- [HAproxy功能配置](https://www.jianshu.com/p/8af373981cfe)

- 下载

		wget http://www.haproxy.org/download/2.0/src/haproxy-2.0.3.tar.gz
- 解压

		tar -zxvf haproxy-2.0.3.tar.gz
		cd haproxy-2.0.3
- 安装

		make TARGET=linux2628 ARCH=x86_64 USE_NS= PREFIX=/usr/local/haproxy
		make install PREFIX=/usr/local/haproxy

		// 参数说明

		TARGET=linux26 #内核版本，使用uname -r查看内核，如：2.6.18-371.el5，此时该参数就为linux26；kernel 大于2.6.28的用：TARGET=linux2628
		ARCH=x86_64 #系统位数
        USE_NS= #在centos6下会报错，`undefined reference to setns`，原因：setns() is supported since linux kernel 3.0，所以centos6（kernel 2.6）安装时需要禁用它
		PREFIX=/usr/local/haprpxy # /usr/local/haprpxy为haprpxy安装路径

- 配置文件haproxy.cfg

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
- 启动

		/usr/local/haproxy/sbin/haproxy -f /usr/local/haproxy/haproxy.cfg 