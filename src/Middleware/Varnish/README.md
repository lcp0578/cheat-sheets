## Varnish 反向代理服务器和http加速器
- https://varnish-cache.org/
- Varnish Cache is a web application accelerator also known as a caching HTTP reverse proxy. You install it in front of any server that speaks HTTP and configure it to cache the contents. Varnish Cache is really, really fast. It typically speeds up delivery with a factor of 300 - 1000x, depending on your architecture.
- Varnish is industry-leading content delivery and edge computing software that speeds up websites, APIs, video streaming platforms, and content delivery platforms by leveraging uniquely powerful caching technology.
	- Originally, Varnish was a reverse caching proxy: a proxy server that speaks HTTP that you put in front of your web servers. Varnish heavily reduces the load and the latency of your web servers.
	- It does this by serving client requests with content that is cached in memory, eliminating the need to send each client request to the web servers.
	- However, when the content for a request is not available in cache, Varnish will connect to web servers to retrieve the requested content, and will attempt to store the response in cache for future requests.
	- By adding this new layer of caching, we divide the platform into two distinct tiers in terms of content delivery:
		- The origin: represents your original web servers that are inherently prone to high load and latency, and that need to be protected in order to guarantee stability.
		- The edge: the outer tier of your platform. It is secure, stable, fast and scalable. This is where users interact with your content and where Varnish really shines.