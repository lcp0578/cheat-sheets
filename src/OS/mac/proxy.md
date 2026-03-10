## mac终端走代理
- 查看sock5的端口

		$ export http_proxy=socks5://127.0.0.1:1086 # 配置http 代理访问
        $ export https_proxy=socks5://127.0.0.1:1086 # 配置https 代理访问
        $ export all_proxy=socks5://127.0.0.1:1086 # 配置http和https访问
        $ unset http_proxy  # 取消http 代理访问
        $ unset https_proxy # 取消https 代理访问
