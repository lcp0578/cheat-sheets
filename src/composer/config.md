## composer config 配置相关
> [composer config](https://getcomposer.org/doc/06-config.md) 官方文档

- 全局设置中国的镜像

    	composer config -g repo.packagist composer https://packagist.laravel-china.org/
	
	站点地址：[https://packagist.laravel-china.org/](https://packagist.laravel-china.org/)
    
- 为某个项目设置中国的镜像

    	composer config repo.packagist composer https://packagist.laravel-china.org/
	
	站点地址：[https://packagist.laravel-china.org/](https://packagist.laravel-china.org/)
    腾讯云镜像: [https://mirrors.cloud.tencent.com/composer/](https://mirrors.cloud.tencent.com/composer/)
    阿里云镜像: [https://mirrors.aliyun.com/composer/](https://mirrors.aliyun.com/composer/index.html)

- 查看全局配置项

		$ composer config --global --list
        [repositories.packagist.org.type] composer
        [repositories.packagist.org.url] https?://packagist.org
        [repositories.packagist.org.allow_ssl_downgrade] true
        [process-timeout] 300
        [use-include-path] false
        [preferred-install] auto
        [notify-on-install] true
        [github-protocols] [https, ssh]
        [vendor-dir] vendor (D:\phpStudy\WWW\newspace/vendor)
        [bin-dir] {$vendor-dir}/bin (D:\phpStudy\WWW\newspace/vendor/bin)
        [cache-dir] C:/Users/Administrator/AppData/Local/Composer
        [data-dir] C:/Users/Administrator/AppData/Roaming/Composer
        [cache-files-dir] {$cache-dir}/files (C:/Users/Administrator/AppData/Local/Composer/files)
        [cache-repo-dir] {$cache-dir}/repo (C:/Users/Administrator/AppData/Local/Composer/repo)
        [cache-vcs-dir] {$cache-dir}/vcs (C:/Users/Administrator/AppData/Local/Composer/vcs)
        [cache-ttl] 15552000
        [cache-files-ttl] 15552000
        [cache-files-maxsize] 300MiB (314572800)
        [bin-compat] auto
        [discard-changes] false
        [autoloader-suffix]
        [sort-packages] false
        [optimize-autoloader] false
        [classmap-authoritative] false
        [apcu-autoloader] false
        [prepend-autoloader] true
        [github-domains] [github.com]
        [bitbucket-expose-hostname] true
        [disable-tls] false
        [secure-http] true
        [cafile]
        [capath]
        [github-expose-hostname] true
        [gitlab-domains] [gitlab.com]
        [store-auths] prompt
        [archive-format] tar
        [archive-dir] .
        [htaccess-protect] 1
        [home] C:/Users/Administrator/AppData/Roaming/Composer
        

- 移除全局镜像设置

		$ composer config --global --unset repo.packagist
