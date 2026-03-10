## Exception
- 内存不足
	
		Fatal error: Allowed memory size of 268435456 bytes exhausted (tried to allocate 4981690 bytes) 
		// 想分配的内存明明小于可用内存，为啥报错？是由于最大内存已耗尽，再尝试分配这么多内存，导致出错
		
		//php.ini
		; Maximum amount of memory a script may consume (128MB)
		; http://php.net/memory-limit
		memory_limit=512M
- 脚本超时
	
		Maximum execution time of 30 seconds exceeded
		// set_time_limit(0);
		// php.ini
		; Maximum execution time of each script, in seconds
		; http://php.net/max-execution-time
		; Note: This directive is hardcoded to 0 for the CLI SAPI
		max_execution_time=30