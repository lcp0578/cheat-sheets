## HAProxy 配置示例
> http://www.haproxy.org

- 相关资料
	- [HAProxy Documentation Converter 官方文档](http://cbonte.github.io/haproxy-dconv/)
	- [https://segmentfault.com/a/1190000007532860](https://segmentfault.com/a/1190000007532860)
	- [HAProxy用法详解 全网最详细中文文档](http://www.ttlsa.com/linux/haproxy-study-tutorial/)
	- [HAproxy功能配置](https://www.jianshu.com/p/8af373981cfe)

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