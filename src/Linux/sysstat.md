## 系统监测工具sysstat
> sysstat是一个软件包，包含监测系统性能及效率的一组工具，这些工具对于我们收集系统性能数据，比如：CPU 使用率、硬盘和网络吞吐数据，这些数据的收集和分析，有利于我们判断系统是否正常运行，是提高系统运行效率、安全运行服务器的得力助手。官方网站: http://sebastien.godard.pagesperso-orange.fr

- 包含的工具
	- `iostat` 输出CPU的统计信息和所有I/O设备的输入输出（I/O）统计信息
	- `mpstat` 关于CPU的详细信息（单独输出或者分组输出）
	- `pidstat`关于运行中的进程/任务、CPU、内存等的统计信息
	- `sar` 保存并输出不同系统资源（CPU、内存、IO、网络、内核等）的详细信息
	- `sadc` 系统活动数据收集器，用于收集sar工具的后端数据
	- `sa1` 系统收集并存储sadc数据文件的二进制数据，与sadc工具配合使用
	- `sa2` 配合sar工具使用，产生每日的摘要报告
	- `sadf` 用于以不同的数据格式（CVS或者XML）来格式化sar工具的输出
	- `sysstat` sysstat 工具包的 man 帮助页面。
	- `nfsiostat` NFS（Network File System）的I/O统计信息
	- `cifsiostat` CIFS(Common Internet File System)的统计信息


> https://paul.pub/sysstat/