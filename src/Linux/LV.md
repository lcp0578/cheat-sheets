## linux LVM 调整逻辑卷空间大小
> 调整逻辑卷空间大小和缩小空间时需要谨慎，因为它有可能导致数据丢失。

- 扩容前，搞清楚自己的分区格式

		df -hT //确定是xfs还是ext*系列
	- 特别注意的是：
		- resize2fs 更新文件系统命令 针对的是ext2、ext3、ext4文件系统
		- xfs_growfs 更新文件系统命令 针对的是xfs文件系统
- 3个基本的逻辑卷概念。
	- PV(Physical Volume)　物理卷
	- VG(Volume Group)　卷组
	- LV(Logical Volume)　逻辑卷
	- 顺序不能乱 ： 底层物理设备 ------> 创建成 PV -------> 创建 VG --------> 创建成LV ------> 格式化挂载使用
- 思路
	- 物理磁盘
	- 创建 PV
	- 创建 VG
	- 创建 LV
	- 格式化挂载使用
https://www.cnblogs.com/aaak/p/14553920.html