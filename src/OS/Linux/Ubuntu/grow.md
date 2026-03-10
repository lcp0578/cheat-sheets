## 服务器磁盘扩容
- https://help.aliyun.com/zh/ecs/user-guide/extend-the-partitions-and-file-systems-of-disks-on-a-linux-instance
- 获取目标云盘信息

		sudo fdisk -lu
- 扩容分区（只能扩容最后一个分区，需要看/dev/vda{N},N目前是几，示例为3）

		sudo growpart /dev/vda 3 
	- 若命令不存在，则安装growpart

			yum install cloud-utils-growpart
- 扩容文件系统
	- 查看文件系统的类型

			df -Th
	- 扩容文件系统
		- ext*文件系统

				sudo resize2fs /dev/vda3
		- xfs文件系统（以扩容挂载目录为/mnt的xfs文件系统为例）

				xfs_growfs /mnt
- 查看扩容是否成功

		df -Th
