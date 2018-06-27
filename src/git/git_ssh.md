## git ssh
有时，我们会修改ssh的默认端口号，那么我们在使用git clone git@gitee.com:lcp0578/test会失败。
需要修改配置项：

    cat>~/.ssh/config
    # 映射一个别名
    host gitee.com
    hostname gitee.com
    port 22