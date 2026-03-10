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

- 启动

		/usr/local/haproxy/sbin/haproxy -f /usr/local/haproxy/haproxy.cfg 
- 配置开机启动

		mkdir -p /etc/haproxy
		ln -s/usr/local/haproxy/haproxy.cfg /etc/haproxy/
		cp /usr/local/src/haproxy-2.1.0/examples/haproxy.init /etc/rc.d/init.d/haproxy
        chmod +x /etc/rc.d/init.d/haproxy
        ln -s/usr/local/haproxy/sbin/haproxy /usr/sbin/