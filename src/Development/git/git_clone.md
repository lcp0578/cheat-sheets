## git clone 报错
- 多次拉取一直报错如下

		Enumerating objects: 27, done.
		Counting objects: 100% (27/27), done.
		Delta compression using up to 16 threads
		Compressing objects: 100% (24/24), done.
		Writing objects: 100% (25/25), 187.79 KiB | 9.39 MiB/s, done.
		Total 25 (delta 1), reused 0 (delta 0), pack-reused 0
		send-pack: unexpected disconnect while reading sideband packet
		fatal: the remote end hung up unexpectedly
- 修改配置

		set GIT_TRACE_PACKET=1
		set GIT_TRACE=1
		set GIT_CURL_VERBOSE=1