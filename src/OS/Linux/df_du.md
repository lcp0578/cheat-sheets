## df & du
- `du`与`df`机制对比
	- `df`读取的是超级块的内容
	- `du`是将所有文件对象大小加起来
	- 两种机制的不同会造成两者结果不一致的地方，例如你在命令行下删除了一个文件，而这个文件正在被某个程序打开占用，实际上这个文件依然占用磁盘空间，只有在使用该文件的进程关闭时才真正清楚磁盘空间，这时du显示的数据会比df显示的值小。
	- 通过`lsof`查看是否有已删除的文件仍被进程所使用：

			lsof | grep '(deleted)'

		找到某个大文件对应的进程，关闭该进程可以正确释放磁盘空间
- df 查看磁盘使用情况

		[root@lcp0578 ~]# df -h
		Filesystem      Size  Used Avail Use% Mounted on
		/dev/vda1        40G   26G   13G  68% /
		tmpfs           3.9G     0  3.9G   0% /dev/shm
- du 查看文件大小

		// 查看当前目录下所有文件大小
		[root@iZ25l72tn16Z local]# du -bsh *
		233M    aegis
		899K    autoconf-2.13
		590K    bin
		2.6M    curl
		4.0K    etc
		8.3M    freetype
		4.0K    games
		237M    go
		146K    include
		6.6M    lib
		4.0K    lib64
		4.0K    libexec
		33K     man
		5.0G    mysql
		13M     nginx
		110M    oldphp20170721121220
		112M    php
		420K    pureftpd
		16M     redis
		4.0K    sbin
		3.0M    share
		4.0K    src
		203M    wrk
		1.5M    zend
		// 查看某个目录或文件大小
		[root@iZ25l72tn16Z local]# du -sh mysql/
		5.1G    mysql/
PS：
	Gives you the apparent(-b) summarized(-s) size of all the files and directories in the current directory in human readable(-h) format