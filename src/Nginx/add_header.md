## add_header 指令与XSS
> Adds the specified field to a response header provided that the response code equals 200, 201 (1.3.10), 204, 206, 301, 302, 303, 304, 307 (1.1.16, 1.0.13), or 308 (1.13.0). The value can contain variables.  
> There could be several add_header directives. These directives are inherited from the previous level if and only if there are no add_header directives defined on the current level.  
> If the always parameter is specified (1.7.5), the header field will be added regardless of the response code.  

- add_header指令使用说明
	- 在响应状态码成功时，`add_header` 指令才生效，并且当前作用域下没有 `add_header` 指令时，会向上层继承。
	- 可能会遇到上级指令被覆盖的情况，如：

			server {
			    add_header x-name nginx;
			
			    location / {
			        root /path;
			    }
			
			    location /static/ {
			        add_header x-name2 nginx2;
			    }
			}
	当匹配到 `/` 时，由于 `location /` 中没有 `add_header` 指令，所以会继承 `server` 中的 `x-name` ，而当匹配到 `/static/` 时，由于内容已经有 `add_header` 指令，则上层的 `x-name` 不会被继承，导致只会输出 `x-name2` 。
- X-XSS-Protection

		add_header X-XSS-Protection "1; mode=block";
	该响应头是用于防范及过滤 XSS 的。可用的几个指令如下：

		X-XSS-Protection: 0
		X-XSS-Protection: 1
		X-XSS-Protection: 1; mode=block
		X-XSS-Protection: 1; report=
	- 说明
		- `0`，禁用 XSS 过滤
		- `1`，开启 XSS 过滤
		- `1; mode=block`，开启 XSS 过滤，并且若检查到 XSS 攻击，停止渲染页面。
		- `1; report=<reporting-uri>`，开启 XSS 过滤，并且若检查到 XSS 攻击，将使用指导的 url 来发送报告。