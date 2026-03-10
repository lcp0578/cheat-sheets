## CentOS 安装 OpenResty
- 安装依赖

		yum install readline-devel
- 安装lua 5.1.5，下载lua 5.1.5源码

		make
- 安装luarocks
	- 解压到 `/usr/local/luarocks` 
	- 寻找lua安装路径下`lua.h`的位置，即`find / -name "lua.h"`
	- 在`/usr/local/luarocks`下执行`./configure --prefix=/usr/local/luarocks --with-lua-include=/usr/local/lua/src'
		- predix是指定LuaRocks 安装路径
		- `--with-lua-include`指定lua文件位置，默认为`$LUA_DIR/include` 
	- 执行 `make bootstrap` 
	- 安装完成，将`/usr/local/luarocks/bin`添加到环境变量中即可。
- 下载rpm包，https://openresty.org/package/centos/
	- openresty
	- openresty-resty
	- openresty-doc
	- openresty-openssl
	- openresty-zlib
	- openresty-pcre
- 安装
	
    	rpm -ivh openresty-1.15.8.3-1.el6.x86_64.rpm
        rpm -ivh openresty-resty-1.15.8.3-1.el6.noarch.rpm
        rpm -ivh openresty-doc-1.15.8.3-1.el6.noarch.rpm
        rpm -ivh openresty-openssl-1.1.0l-1.el6.x86_64.rpm
        rpm -ivh openresty-zlib-1.2.11-3.el6.x86_64.rpm
        rpm -ivh openresty-pcre-8.44-1.el6.x86_64.rpm
        rpm -ivh openresty-opm-1.15.8.3-1.el6.noarch.rpm
- 编译安装lua-resty-waf
	- https://github.com/p0pr0ck5/lua-resty-waf/#installation
	- 执行 `make && make install`，编译安装时需要额外下载依赖包，需要手动安装
	- 安装到了 `{openresty_path}/site/lualib/resty`，包含了 `waf`目录和`waf.lua`
	- 安全规则文件在`{openresty_path}/site/lualib/rules`下
- 安装后的文件
	- openresty目录，`/usr/local/openresty/`
	- openresty命令，`/usr/bin/openresty` 为 `/usr/local/openresty/nginx/sbin/nginx`的软链接。
	- 服务命令
	
    		service openresty start //stop, restart or reload
	- 指定application directories
		- `openresty -p /opt/my-fancy-app/ -c /opt/my-fancy-app/conf/nginx.conf`
		- 在`my-fancy-app`下创建子目录：`conf/`, `html/` , `logs/`
- 隐藏openresty版本号

		http {
        	server_tokens off;
            ....
        }
- openresty启动时遇到错误
	- 未找到 `rex_pcre`，修复建立软连接`ln -s /usr/local/luarocks/lib/lua/5.1/rex_pcre.so  /usr/local/openresty/lualib/rex_pcre.so`

            [error] 757#757: init_by_lua error: /usr/local/openresty/site/lualib/resty/waf/translate.lua:5: module 'rex_pcre' not found:
                no field package.preload['rex_pcre']
                no file '/usr/local/openresty/site/lualib/rex_pcre.ljbc'
                no file '/usr/local/openresty/site/lualib/rex_pcre/init.ljbc'
                no file '/usr/local/openresty/lualib/rex_pcre.ljbc'
                no file '/usr/local/openresty/lualib/rex_pcre/init.ljbc'
                no file '/usr/local/openresty/site/lualib/rex_pcre.lua'
                no file '/usr/local/openresty/site/lualib/rex_pcre/init.lua'
                no file '/usr/local/openresty/lualib/rex_pcre.lua'
                no file '/usr/local/openresty/lualib/rex_pcre/init.lua'
                no file './rex_pcre.lua'
                no file '/usr/local/openresty/luajit/share/luajit-2.1.0-beta3/rex_pcre.lua'
                no file '/usr/local/share/lua/5.1/rex_pcre.lua'
                no file '/usr/local/share/lua/5.1/rex_pcre/init.lua'
                no file '/usr/local/openresty/luajit/share/lua/5.1/rex_pcre.lua'
                no file '/usr/local/openresty/luajit/share/lua/5.1/rex_pcre/init.lua'
                no file '/usr/local/openresty/site/lualib/rex_pcre.so'
                no file '/usr/local/openresty/lualib/rex_pcre.so'
                no file './rex_pcre.so'
                no file '/usr/local/lib/lua/5.1/rex_pcre.so'
                no file '/usr/local/openresty/luajit/lib/lua/5.1/rex_pcre.so'
                no file '/usr/local/lib/lua/5.1/loadall.so'
- 修改配置文件nginx.conf

        http {
            server_tokens off;
            include waf_init.conf;
            ...
            server {
                listen       8080;
                server_name  localhost;
				...
                location / {
                    include waf_exec.conf;
                    ....
                }
            }
        }
- waf_init.conf

		init_by_lua_block {
                -- use resty.core for performance improvement, see the status note above
                require "resty.core"

                -- require the base module
                local lua_resty_waf = require "resty.waf"

                -- perform some preloading and optimization
                lua_resty_waf.init()
        }
- waf_exec.conf

        access_by_lua_block {
            local lua_resty_waf = require "resty.waf"

            local waf = lua_resty_waf:new()

            -- define options that will be inherited across all scopes
            waf:set_option("debug", true)
            waf:set_option("mode", "ACTIVE")

            -- this may be desirable for low-traffic or testing sites
            -- by default, event logs are not written until the buffer is full
            -- for testing, flush the log buffer every 5 seconds
            --
            -- this is only necessary when configuring a remote TCP/UDP
            -- socket server for event logs. otherwise, this is ignored
            waf:set_option("event_log_periodic_flush", 5)

            -- run the firewall
            waf:exec()
        }

        header_filter_by_lua_block {
            local lua_resty_waf = require "resty.waf"

            -- note that options set in previous handlers (in the same scope)
            -- do not need to be set again
            local waf = lua_resty_waf:new()

            waf:exec()
        }

        body_filter_by_lua_block {
            local lua_resty_waf = require "resty.waf"

            local waf = lua_resty_waf:new()

            waf:exec()
        }

        log_by_lua_block {
            local lua_resty_waf = require "resty.waf"

            local waf = lua_resty_waf:new()

            waf:exec()
        }