## Linux LVM 逻辑卷管理
#### 零、LVM是什么
- 概念解释
	- LVM(Logical Volume Manager), 逻辑卷管理, 是一种将一至多个硬盘的分区在逻辑上进行组合, 当成一个大硬盘来使用.
	- 当硬盘空间不足时, 可以动态地添加其它硬盘的分区到已有的卷组中 —— 磁盘空间的动态管理.
- 使用LVM时的扩容思路
	- 使用LVM时技术时, 情况有所不同:
		- (1) 硬盘的多个分区由LVM统一管理为卷组, 可以很轻松地加入或移走某个分区 —— 也就是扩大或减小卷组的可用容量, 充分利用硬盘空间;
		- (2) 文件系统建立在逻辑卷上, 而逻辑卷可以根据需要改变大小(在卷组容量范围内)以满足要求;
		- (3) 文件系统建立在LVM上, 可以跨分区存储访问, 更加方便;
	- 强烈建议对拥有多个磁盘的系统, 使用LVM管理磁盘.
> 调整逻辑卷空间大小和缩小空间时需要谨慎，因为它有可能导致数据丢失。

- 扩容前，搞清楚自己的分区格式

		df -hT //确定是xfs还是ext*系列
	- 特别注意的是：
		- resize2fs 更新文件系统命令 针对的是ext2、ext3、ext4文件系统
		- xfs_growfs 更新文件系统命令 针对的是xfs文件系统

#### 一、 创建逻辑卷
- 3个基本的逻辑卷概念。
	- PV(Physical Volume): 物理卷, 处于LVM最底层, 可以是物理硬盘或者分区;
	- PP(Physical Extend): 物理区域, PV中可以用于分配的最小存储单元, 可以在创建PV的时候指定, 如1M, 2M, 4M, 8M…..组成同一VG中所有PV的PE大小应该相同;
	- VG(Volume Group): 卷组, 建立在PV之上, 可以含有一个到多个PV;
	- LV(Logical Volume): 逻辑卷, 建立在VG之上, 相当于原来分区的概念, 不过大小可以动态改变.
	- 顺序不能乱 ： 底层物理设备 ------> 创建成 PV -------> 创建 VG --------> 创建成LV ------> 格式化挂载使用

- 1、准备物理磁盘

		# sdb
		#路径 /dev/sdb
- 2、创建 PV

		# pvcreate /dev/sdb
		创建物理卷
- 3、创建 VG

		# vgcreate vg01 /dev/sdb
		创建卷组vg01， 并把物理卷添加到卷组中
- 4、创建 LV

		#  lvcreate  -l 100%vg  -n lv01  vg01
		创建大小为卷组100%空间的 名字为lv01  来源卷组为vg01 的逻辑卷
		# 或
		# lvcreate  -L 3G  -n lv01  vg01
		创建名字为lv01的逻辑卷 -L 大小 3G  来源卷组vg01
- 5、格式化挂载使用
	- 逻辑卷最终在系统中保存为以下两个路径：
		- /dev/卷组名/逻辑卷
		- /dve/mapper/卷组名-逻辑卷

				格式化
				# mkfs.xfs /dev/vg01/lv01
				
				挂载使用
				# mount /dev/vg01/lv01 /app     # 临时挂载，重启后丢失
				
				写到文件中，永久挂载
				# cat /etc/fstab
				
				/dev/vg01/lv01  /app                         xfs    defaults        0 0
- 6、 查看
	<table>
		<tr>
			<th>查看</th>
			<th>简单查看</th>
			<th>详细查看</th>
		</tr>
		<tr>
			<td>逻辑卷</td>
			<td>lvs</td>
			<td>lvdisplay</td>
		</tr>
		<tr>
			<td>卷组</td>
			<td>vgs	</td>
			<td>vgdisplay</td>
		</tr>
		<tr>
			<td>物理卷</td>
			<td>pvs</td>
			<td>pvdisplay</td>
		</tr>
	</table>

#### 二、 扩展逻辑卷
- 1、准备物理磁盘(略)
- 2、 创建物理卷

		# pvcreate /dev/sdc
- 3、扩容卷组

		# vgextend vg01 /dev/sdc

- 4、扩容逻辑卷

		# lvextend -L +5G /dev/mapper/vg01-lv01
		# 在原有的容量大小上面 +5G
	- 案例：
		- 增加 1G 空间

				[root@localhost /]# lvextend -L +1G /dve/mapper/vg01-lv01
		- 指定总空间 10 G
		
				[root@localhost /]# lvextend -L 10G /dve/mapper/vg01-lv01
		- 把当前卷组空间全部给逻辑卷

				[root@localhost /]# lvextend -l 100%vg /dve/mapper/vg01-lv01

- 5、更新文件系统，刷新逻辑卷 

		# xfs_growfs /dve/mapper/vg01-lv01
		# resize2fs /dve/mapper/vg01-lv01

- 6、查看挂载目录大小变化

		# df -h 
#### 三、删除LVM过程
- 删除LVM的过程
	- 1.先卸载系统上面的 LVM 文件系统 (包括快照与所有 LV)
	- 2.使用 `lvremove` 移除 LV
	- 3.使用 `vgchange -a n VGname` 让 VGname 这个 VG 不具有 Active 的标志
	- 4.使用 `vgremove` 移除 VG
	- 5.使用 `pvremove` 移除 PV
	- 6.使用 `fdisk` 修改 ID 


