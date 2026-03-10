## redis for windows
- redis官方并没有发布官方的windows版本，微软自己维护了64位版本[MicrosoftArchive/redis](https://github.com/MicrosoftArchive/redis)

	> Windows  
	> The Redis project does not officially support Windows. However, the Microsoft Open Tech group develops and maintains this Windows port targeting Win64. [Learn more](https://github.com/MicrosoftArchive/redis)
- 下载windows版本redis  
	发布页：[https://github.com/MicrosoftArchive/redis/releases](https://github.com/MicrosoftArchive/redis/releases)
- 安装与配置  
	下载MSI package 安装即可，如果不想用MSI包，Windows Service Documentation.docx 文档中有具体安装步骤。  
	为了命令行下使用方便，把安装目录（示例：D:\Program Files\Redis），加入到环境变量PATH。
	安装完成测试：
		
		C:\Users\Auser>redis-cli
		127.0.0.1:6379>
		127.0.0.1:6379>
		127.0.0.1:6379>
		127.0.0.1:6379>
	证明安装成功。
- php连接redis
	- 安装redis扩展  
	下载对应的版本，redis和php版本要一致。下载地址： [http://windows.php.net/downloads/pecl/releases/redis](http://windows.php.net/downloads/pecl/releases/redis/)  
	把dll文件放到php安装目录的ext下。
	- php.ini配置  
	
		    [REDIS]
	    	extension=php_redis.dll
			// PHP7 
			extension=php_redis
	需要查看phpinfo或者php -m 查看redis扩展是否正确安装。
	- 测试
		
			$redis = new Redis();
			$result =$redis->connect('127.0.0.1', 6379);
			$redis->set('kitlabs', 'hello kitlabs');
			$val = $redis->get('kitlabs');
			var_dump($result);  // true
			print_r($val);  // hello kitlabs