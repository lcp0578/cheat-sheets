## Linux下的tmpfs文件系统(/dev/shm)
- 介绍
	- `/dev/shm/`是一个使用就是tmpfs文件系统的设备，其实就是一个特殊的文件系统。redhat中默认大小为物理内存的一半,使用时不用mkfs格式化。
	- tmpfs是Linux/Unix系统上的一种基于内存的虚拟文件系统。
	- tmpfs可以使用您的内存或swap分区来存储文件(即它的存储空间在virtual memory 中, VM由real memory和swap组成)。由此可见，tmpfs主要存储暂存的文件。
	- 它有如下2个优势 : 1. 动态文件系统的大小。2. tmpfs 使用VM建的文件系统，速度当然快。3.重启后数据丢失。
	- 当删除tmpfs中的文件时,tmpfs会动态减少文件系统并释放VM资源,LINUX中可以把一些程序的临时文件放置在tmpfs中，利用tmpfs比硬盘速度快的特点提升系统性能。
	- 实际应用中，为应用的特定需求设定此文件系统，可以提升应用读写性能，如将squid 缓存目录放在/tmp, php session 文件放在/tmp, socket文件放在/tmp, 或者使用/tmp作为其它应用的缓存设备

- 临时修改/dev/shm大小

        #mount -o size=1500M -o nr_inodes=1000000 -o noatime,nodiratime -o remount /dev/shm
        mount -t tmpfs -o size=20m tmpfs /tmp 临时挂载使用

- 开机启用的配置
	- 可以在/etc/fstab 中定义其大小

            tmpfs /dev/shm tmpfs,defaults,size=512m 0 0

            tmpfs /tmp tmpfs defaults,size=25M 0 0

	修改后执行mount -o remoount /dev/shm 后生效

- mkdir /dev/shm/tmp (/dev/shm/ 下新建的目录与/tmp绑定, 则/tmp 即使用tmpfs文件系统)

        chmod 1777 /dev/shm/tmp
        mount --bind /dev/shm/tmp /tmp