## composer使用常见错误
- `proc_open(): fork failed - Cannot allocate memory`
	- 解决办法：创建swap分区
	
    		dd if=/dev/zero of=/var/swap.1 bs=1M count=1024 //从/dev/zero设备复制出一个1G大小的文件
            mkswap /var/swap.1 //格式化
            swapon /var/swap.1 //将swap分区挂在到文件系统