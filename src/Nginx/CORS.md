## CORS跨域请求--简单请求与复杂请求与跨域预请求OPTIONS处理
- CORS即Cross Origin Resource Sharing（跨来源资源共享）
#### 简单请求
- 一个简单的请求大致如下：
	- HTTP方法是下列之一

			HEAD
			GET
			POST

	- HTTP头信息不超出以下几种字段

			Accept
			Accept-Language
			Content-Language
			Last-Event-ID
			Content-Type，但仅能是下列之一
			application/x-www-form-urlencoded
			multipart/form-data
			text/plain

	- 任何一个不满足上述要求的请求，即被认为是复杂请求。一个复杂请求不仅有包含通信内容的请求，同时也包含预请求（preflight request）。
- 简单请求的发送从代码上来看和普通的XHR没太大区别，但是HTTP头当中要求总是包含一个域（Origin）的信息。该域包含协议名、地址以及一个可选的端口。不过这一项实际上由浏览器代为发送，并不是开发者代码可以触及到的。

#### 复杂请求
- 复杂请求表面上看起来和简单请求使用上差不多，但实际上浏览器发送了不止一个请求。其中最先发送的是一种"预请求"，此时作为服务端，也需要返回"预回应"作为响应。预请求实际上是对服务端的一种权限请求，只有当预请求成功返回，实际请求才开始执行。

- 预请求以OPTIONS形式发送，当中同样包含域，并且还包含了两项CORS特有的内容：
	- Access-Control-Request-Method： 该项内容是实际请求的种类，可以是GET、POST之类的简单请求，也可以是PUT、DELETE等等。
	- Access-Control-Request-Headers： 该项是一个以逗号分隔的列表，当中是复杂请求所使用的头部。
- 显而易见，这个预请求实际上就是在为之后的实际请求发送一个权限请求，在预回应返回的内容当中，服务端应当对这两项进行回复，以让浏览器确定请求是否能够成功完成。
	- 复杂请求的部分响应头及解释如下：

			Access-Control-Allow-Origin（必含） – 和简单请求一样的，必须包含一个域。
			Access-Control-Allow-Methods（必含） – 这是对预请求当中Access-Control-Request-Method的回复，这一回复将是一个以逗号分隔的列表。尽管客户端或许只请求某一方法，但服务端仍然可以返回所有允许的方法，以便客户端将其缓存。
			Access-Control-Allow-Headers（当预请求中包含Access-Control-Request-Headers时必须包含） – 这是对预请求当中Access-Control-Request-Headers的回复，和上面一样是以逗号分隔的列表，可以返回所有支持的头部。这里在实际使用中有遇到，所有支持的头部一时可能不能完全写出来，而又不想在这一层做过多的判断，没关系，事实上通过request的header可以直接取到Access-Control-Request-Headers，直接把对应的value设置到Access-Control-Allow-Headers即可。
			Access-Control-Allow-Credentials（可选） – 和简单请求当中作用相同。
			Access-Control-Max-Age（可选） – 以秒为单位的缓存时间。预请求的的发送并非免费午餐，允许时应当尽可能缓存。

	- 一旦预回应如期而至，所请求的权限也都已满足，则实际请求开始发送。

#### nginx配置处理预请求OPTIONS

	location /api/  {
        if ( $request_method = 'OPTIONS' ) {
                add_header Access-Control-Allow-Origin '*';
                add_header Access-Control-Allow-Headers Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,X-Data-Type,X-Requested-With;
                add_header Access-Control-Allow-Methods 'GET,POST,OPTIONS,HEAD,PUT';
                add_header Access-Control-Allow-Credentials true;
                return 204;
        }
        try_files $uri /index.php/$is_args$args;
	}
