## OpenResty 配置
- 关闭Lua代码缓存 `lua_code_cache`

        $ cat conf/nginx.conf
        events {
            worker_connections 1024;
        }

        http {
            server {
                listen 8080;
            	lua_code_cache off; #Lua 代码在第一个请求时会被加载，并默认缓存起来。关闭 lua_code_cache 就能避免重新加载,这种方法只能临时用于开发和调试
                location / {
                    content_by_lua_file lua/hello.lua;
                }
            }

            server {
                listen 8081;
                location / {
                    content_by_lua_file lua/hello.lua;
                }
            }
        }
- 设置Lua模块的查找路径`lua_package_path`

        # http模块
         lua_package_path $prefix/lua_pkg/?.lua;;
	- `$prefix`就是启动参数中的 `-p PATH`；
	- `/lua_pkg/?.lua`表示 `lua_pkg` 目录下所有以 `.lua` 作为后缀的文件；
	- 最后的两个分号，则代表内置的代码搜索路径。

