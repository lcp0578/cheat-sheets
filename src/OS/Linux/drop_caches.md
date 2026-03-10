## 内存查看与手动释放
- 手动释放内存的命令

		echo 3 > /proc/sys/vm/drop_caches 
    - drop_caches的值可以是0-3之间的数字，代表不同的含义：
        - 0：不释放（系统默认值）
        - 1：释放页缓存
        - 2：释放dentries和inodes
        - 3：释放所有缓存
- 查看内存

		free -h
    - total——总物理内存
	- used——已使用内存，一般情况这个值会比较大，因为这个值包括了cache+应用程序使用的内存
	- free——完全未被使用的内存
	- shared——应用程序共享内存
	- buffers——缓存，主要用于目录方面,inode值等（ls大目录可看到这个值增加）
	- cached——缓存，用于已打开的文件