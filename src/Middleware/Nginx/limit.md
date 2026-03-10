## nginx请求限制
- Nginx核心模块（自带,基于令牌桶算法）
	- 请求限制模块 [ngx_http_limit_req_module](http://nginx.org/en/docs/http/ngx_http_limit_req_module.html)
	- 流量限制模块 [ngx_stream_limit_conn_module](http://nginx.org/en/docs/http/ngx_http_limit_conn_module.html)
- 配置示例
	- 定义容器（只能在`http`模块下使用）
		- limit_conn_zone
		- limit_req_zone
	- 定义请求频率、并发连接数（可以在`http`, `server`, `location`下使用）
	- demo

            limit_conn_zone  $binary_remote_addr zone=conn_addr:20m; # 对每个变量(这里指IP，即$binary_remote_addr)定义一个存储session状态的容器。这个定义了一个20m的容器，按照32bytes/session，可以处理640000个session。容器名为`conn_addr`
            limit_conn conn_addr 10; #表示一个IP能发起10个并发连接数
            limit_req_zone $binary_remote_addr zone=req_addr:20m rate=12r/s; #limit_conn_zone。rate是请求频率. 每秒允许12个请求。容器名：`req_addr`
            limit_req zone=req_addr burst=120 nodelay; #burst表示缓存住的请求数;odelay参数，NGINX仍然会按照burst参数在队列中分配插槽（slot）以及利用已配置的限流，但是不是通过间隔地转发队列中的请求。相反，当某个请求来的太快，只要队列中有可用的空间（slot），NGINX会立即转发它。
- 修改配置后,一定要测试,再重启

		nginx -t