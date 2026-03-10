## 第三方包管理：OPM和LuaRocks
- OPM（OpenResty Package Manager）是 OpenResty 自带的包管理器,https://opm.openresty.org/

        $ opm search lua-resty-http
        ledgetech/lua-resty-http                          Lua HTTP client cosocket driver for OpenResty/ngx_lua
        ledgetech/lua-resty-http                          Lua HTTP client cosocket driver for OpenResty/ngx_lua
        pintsized/lua-resty-http                          Lua HTTP client cosocket driver for OpenResty/ngx_lua
        agentzh/lua-resty-http                            Lua HTTP client cosocket driver for OpenResty/ngx_lua
PS:在 OpenResty 世界中，如果你使用 cosocket 实现了一个包，那么就要使用 lua-resty- 这个前缀，算是一个不成文的规定。
        $ opm search lua-resty-waf
        p0pr0ck5/lua-resty-waf                            High-performance WAF built on the OpenResty stack
        $ opm install p0pr0ck5/lua-resty-waf
        * Fetching p0pr0ck5/lua-resty-waf
          Downloading https://opm.openresty.org/api/pkg/tarball/p0pr0ck5/lua-resty-waf-0.8.2.opm.tar.gz
          % Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                         Dload  Upload   Total   Spent    Left  Speed
        100 47681  100 47681    0     0  83797      0 --:--:-- --:--:-- --:--:-- 83650
        Package p0pr0ck5/lua-resty-waf 0.8.2 installed successfully under /usr/local/Homebrew/Cellar/openresty/1.15.8.3_1/site/ .
- LuaRocks 是 OpenResty 世界的另一个包管理器，诞生在 OPM 之前。不同于 OPM 里只包含 OpenResty 相关的包，LuaRocks 里面还包含 Lua 世界的库。

		$ luarocks search lua-resty-http
PS:在 OpenResty 中，除了 Lua 代码外，我们还经常会调用 C 代码，这时候就需要编译才能使用。LuaRocks 是支持这么做的，你可以在 rockspec 文件中，指定 C 源码的路径和名称，这样 LuaRocks 就会帮你本地编译。而 OPM 暂时还不支持这种特性。
PS: OPM 和 LuaRocks 都不支持私有包。
- [awesome-resty](https://github.com/bungle/awesome-resty)