## Linux下磁盘挂载与删除磁盘分区
#### 磁盘挂载
- 查看是否已经分配

		# fdisk -l
- 若发现有磁盘，路径为/dev/sdb。然后使用fdisk命令进行建立分区

		# fdisk /dev/vdb
        命令(输入 m 获取帮助)：m
        命令操作
           a   toggle a bootable flag
           b   edit bsd disklabel
           c   toggle the dos compatibility flag
           d   delete a partition
           g   create a new empty GPT partition table
           G   create an IRIX (SGI) partition table
           l   list known partition types
           m   print this menu
           n   add a new partition
           o   create a new empty DOS partition table
           p   print the partition table
           q   quit without saving changes
           s   create a new empty Sun disklabel
           t   change a partition's system id
           u   change display/entry units
           v   verify the partition table
           w   write table to disk and exit
           x   extra functionality (experts only)
           命令(输入 m 获取帮助)：n //第一步，创建分区
            Partition type:
               p   primary (0 primary, 0 extended, 4 free)
               e   extended
            Select (default p): p //第二步，输入分区类型
            Using default response p
            分区号 (1-4，默认 1)：1 //第三步，输入分区号
            起始 扇区 (2048-3221225471，默认为 2048)：
            将使用默认值 2048
            Last 扇区, +扇区 or +size{K,M,G} (2048-3221225471，默认为 3221225471)： //第四步，设置结束扇区，默认值即可
            将使用默认值 3221225471
            分区 1 已设置为 Linux 类型，大小设为 1.5 TiB
            
            命令(输入 m 获取帮助)：w //第五步，进行保存
            The partition table has been altered!

            Calling ioctl() to re-read partition table.
            正在同步磁盘。
- 使用fdisk -l命令查看，已经有分区了（多了如下内容）

		Device     Boot Start       End   Sectors  Size Id Type
		/dev/vdb1        2048 838860799 838858752  400G 83 Linux
- 建好分区后要格式化分区，建立文件系统

		# mkfs.xfs -f /dev/vdb1  # xfs文件系统
		# mkfs -t ext4 /dev/vdb1 # ext4文件系统

			meta-data=/dev/vdb1              isize=512    agcount=4, agsize=26214336 blks
			         =                       sectsz=512   attr=2, projid32bit=1
			         =                       crc=1        finobt=1, sparse=1, rmapbt=0
			         =                       reflink=1
			data     =                       bsize=4096   blocks=104857344, imaxpct=25
			         =                       sunit=0      swidth=0 blks
			naming   =version 2              bsize=4096   ascii-ci=0, ftype=1
			log      =internal log           bsize=4096   blocks=51199, version=2
			         =                       sectsz=512   sunit=0 blks, lazy-count=1
			realtime =none                   extsz=4096   blocks=0, rtextents=0

- 选择一个挂载点挂上就可以了，我挂载在/home/data/ 下了

		# mkdir /home/data
		# mount /dev/vdb1 /home/data
- 查看一下挂载是否成功了

		df -TH /home/data/
- 修改一下系统配置加入下列行到/etc/fstab，让系统启动后自动挂载，否则有可能会掉

		/dev/vdb1  /home/data xfs  defaults  0  0 #注意是xfs还是ext4
- PS：文件系统的区别
	- 文件系统EXT3，EXT4和XFS的区别： 
		- EXT3 
        （1）最多只能支持32TB的文件系统和2TB的文件，实际只能容纳2TB的文件系统和16GB的文件 
        （2）Ext3目前只支持32000个子目录 
        （3）Ext3文件系统使用32位空间记录块数量和i-节点数量 
        （4）当数据写入到Ext3文件系统中时，Ext3的数据块分配器每次只能分配一个4KB的块 
        - EXT4 
        EXT4是Linux系统下的日志文件系统，是EXT3文件系统的后继版本。 
        （1）Ext4的文件系统容量达到1EB，而文件容量则达到16TB 
        （2）理论上支持无限数量的子目录 
        （3）Ext4文件系统使用64位空间记录块数量和i-节点数量 
        （4）Ext4的多块分配器支持一次调用分配多个数据块 
        - XFS 
        （1）根据所记录的日志在很短的时间内迅速恢复磁盘文件内容 
        （2）采用优化算法，日志记录对整体文件操作影响非常小 
        （3） 是一个全64-bit的文件系统，它可以支持上百万T字节的存储空间 
        （4）能以接近裸设备I/O的性能存储数据
#### 删除分区
- 查看磁盘分区信息，并确定要删除的分区编号
	- `fdisk -l` 或者 `lsblk`
- 删除分区
	- `fdisk /dev/sda`
	- 输入`d`
	- 输入分区编号`{n}`
	- 输入`w`保存并退出工具
- 更新分区表
	- `partprobe`
- 如果使用的是GPT分区表，则使用`gdisk`命令来删除分区，步骤类似。
- 注意：在删除分区之前请务必备份重要的数据，因为删除操作是无法撤销的。
