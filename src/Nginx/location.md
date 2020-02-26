## location表达式类型与优先级
- location表达式类型
	- `~` 表示执行一个正则匹配，区分大小写
	- `~*` 表示执行一个正则匹配，不区分大小写
	- `^~` 表示普通字符匹配。使用前缀匹配。如果匹配成功，则不再匹配其他location。
	- `=` 进行普通字符精确匹配。也就是完全匹配。
	- `@` "@" 定义一个命名的 location，使用在内部定向时，例如 error_page, try_files

- location优先级说明
	- 在nginx的location和配置中location的顺序无关。
	- 与location表达式的类型有关。
	- 相同类型的表达式，字符串长的会优先匹配。
	- 以下是按优先级排列说明：
		- 第一优先级：等号类型（=）的优先级最高。一旦匹配成功，则不再查找其他匹配项。
		- 第二优先级：^~类型表达式。一旦匹配成功，则不再查找其他匹配项。
		- 第三优先级：正则表达式类型（~ ~*）的优先级次之。如果有多个location的正则能匹配的话，则使用正则表达式最长的那个。
		- 第四优先级：常规字符串匹配类型。按前缀匹配。

- location优先级示例
配置项如下:
        location = / {
        	# 仅仅匹配请求 /
        	[ configuration A ]
        }
        
        location / {
        	# 匹配所有以 / 开头的请求。但是如果有更长的同类型的表达式，则选择更长的表达式。
            # 如果有正则表达式可以匹配，则优先匹配正则表达式。
        	[ configuration B ]
        }
        
        location /documents/ {
        	# 匹配所有以 /documents/ 开头的请求。但是如果有更长的同类型的表达式，则选择更长的表达式。
        	#如果有正则表达式可以匹配，则优先匹配正则表达式。
        	[ configuration C ]
        }
        
        location ^~ /images/ {
        	# 匹配所有以 /images/ 开头的表达式，如果匹配成功，则停止匹配查找。
            # 所以，即便有符合的正则表达式location，也不会被使用
        	[ configuration D ]
        }
        
        location ~* \.(gif|jpg|jpeg)$ {
        	# 匹配所有以 gif jpg jpeg结尾的请求。
            # 但是 以 /images/开头的请求，将使用 [Configuration D]
        	[ configuration E ]
        }

- 请求匹配示例
	- `/` -> `[configuration A]`
	- `/index.html` -> `[configuration B]`
	- `/documents/document.html` -> `[configuration C]`
	- `/images/1.gif` -> `[configuration D]`
	- `/documents/1.jpg` -> `[configuration E]`

注意，以上的匹配和在配置文件中定义的顺序无关。