## xfs文件系统修复
- 卸载

		umount  /dev/sdf1 
- 修复

		xfs_repair /dev/sdf1
		
		Phase 1 - find and verify superblock...
		Phase 2 - using internal log
		        - zero log...
		ERROR: The filesystem has valuable metadata changes in a log which needs to
		be replayed.  Mount the filesystem to replay the log, and unmount it before
		re-running xfs_repair.  If you are unable to mount the filesystem, then use
		the -L option to destroy the log and attempt a repair.
		Note that destroying the log may cause corruption -- please attempt a mount
		of the filesystem before doing this.
		
		xfs_repair -L /dev/sdf1   #可能会造成数据丢失
		
		Phase 1 - find and verify superblock...
		Phase 2 - using internal log
		        - zero log...
		ALERT: The filesystem has valuable metadata changes in a log which is being
		destroyed because the -L option was used.
		        - scan filesystem freespace and inode maps...
		sb_icount 128, counted 4922112
		sb_ifree 123, counted 25707
		sb_fdblocks 731556628, counted 438595794
		        - found root inode chunk
		Phase 3 - for each AG...
- 检查

		xfs_check /dev/sdf1    #检查没问题即可进行挂载
- 挂载

		mount /dev/sdf1 /home/data    #手动mount
