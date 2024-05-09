##  查看 Linux 重启历史记录
- 使用 journalctl 命令查看 Linux 重启历史记录

		[root@localhost ~]# sudo journalctl --list-boots
		 0 274565ad0ecf43a3b44941716aba875f Wed 2024-05-08 15:32:54 CST?Thu 2024-05-09 14:59:10 CST
- 使用 uptime 命令查看 Linux 运行时间

		[root@localhost ~]# uptime
		 14:59:33 up 23:26,  3 users,  load average: 0.08, 0.11, 0.10
- 使用 who -b 命令查看 Linux 最后启动时间

		[root@localhost ~]# who -b
		         system boot  2024-05-08 15:32
- 使用 last 命令查看 Linux 重启记录

		[root@localhost ~]# last reboot
		reboot   system boot  3.10.0-957.el7.x Wed May  8 15:32 - 15:02  (23:29)    
		reboot   system boot  3.10.0-957.el7.x Thu Apr 25 10:18 - 15:02 (14+04:43)  
		reboot   system boot  3.10.0-957.el7.x Thu Feb  1 13:13 - 15:02 (98+01:49)  
		reboot   system boot  3.10.0-957.el7.x Tue Jan  2 08:50 - 13:10 (30+04:19)  
		reboot   system boot  3.10.0-957.el7.x Fri Dec  8 08:18 - 13:10 (55+04:51)  
		reboot   system boot  3.10.0-957.el7.x Thu Dec  7 08:48 - 13:10 (56+04:21)  
		reboot   system boot  3.10.0-957.el7.x Wed Nov  1 09:46 - 13:10 (92+03:23)  
		reboot   system boot  3.10.0-957.el7.x Sat Oct 28 08:48 - 13:10 (96+04:22)  
		reboot   system boot  3.10.0-957.el7.x Tue Oct 24 17:39 - 13:10 (99+19:31)  
		reboot   system boot  3.10.0-957.el7.x Sat Sep 16 12:13 - 13:10 (138+00:56) 
		reboot   system boot  3.10.0-957.el7.x Fri Sep  8 17:40 - 13:10 (145+19:29) 
		reboot   system boot  3.10.0-957.el7.x Sat Sep  2 08:40 - 13:10 (152+04:30) 
		reboot   system boot  3.10.0-957.el7.x Tue Jun 13 09:46 - 13:10 (233+03:23) 
		reboot   system boot  3.10.0-957.el7.x Mon Jun 12 12:03 - 13:10 (234+01:07) 