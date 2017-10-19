## proxy_pass
www.a.com/sfapi 转发到 www.b.com

	location /sfapi/ {
	    #rewrite ^/sfapi/(.*) /$1 last;
	    proxy_pass http:/www.b.com/;
	    #proxy_redirect     off;
	    #proxy_set_header   Host $host;
	}