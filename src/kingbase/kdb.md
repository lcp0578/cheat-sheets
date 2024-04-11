## 在Linux下pdo_kdb扩展安装
- 查看php的版本以及是否线程安全

		# php8 -v
		PHP 8.1.19 (cli) (built: Apr  2 2024 16:37:49) (NTS)
		Copyright (c) The PHP Group
		Zend Engine v4.1.19, Copyright (c) Zend Technologies
- 下载官方扩展
	- https://www.kingbase.com.cn/downdriven/index.htm
	- 注意
		- `xxx_zts.tar.gz` 代表TS
		- `xxx_uzts.tar.gz` 代表NTS
- 把扩展的文件放到扩展目录

		# php8 -i | grep extension_dir
		extension_dir => /usr/local/php8.1/lib/php/extensions/no-debug-non-zts-20210902 => /usr/local/php8.1/lib/php/extensions/no-debug-non-zts-20210902
		sqlite3.extension_dir => no value => no value
		
		:/usr/local/php8.1/lib/php/extensions/no-debug-non-zts-20210902# ll
		total 12904
		drwxr-xr-x 2 root root    4096 Apr 11 19:08 ./
		drwxr-xr-x 3 root root    4096 Apr  2 16:39 ../
		-rwxr-xr-x 1 root root 2521144 Oct 24 15:29 libcrypto.so.10*
		-rwxr-xr-x 1 root root  354768 Oct 24 15:29 libpq.so*
		-rwxr-xr-x 1 root root  354768 Oct 24 15:29 libpq.so.5*
		-rwxr-xr-x 1 root root  354768 Oct 24 15:29 libpq.so.5.12*
		-rwxr-xr-x 1 root root  470376 Oct 24 15:29 libssl.so.10*
		-rwxr-xr-x 1 root root  211392 Oct 24 15:29 pdo_kdb.so*
- 配置`$LD_LIBRARY_PATH`

		# vim ~/.bashrc
		
		# 添加
		export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/php8.1/lib/php/extensions/no-debug-non-zts-20210902/
- 更新`~/.bashrc`

		source ~/.bashrc
- 查看扩展是否安装成功

		# php8 -m | grep pdo_kdb
		pdo_kdb




