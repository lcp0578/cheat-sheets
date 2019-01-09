## rsync 源码安装及使用
- 卸载rpm  
  
		# yum remove  rsync  
  
  
  
- 安装   
下载最新源码包：https://rsync.samba.org/

		tar -zxvf rsync-3.1.2.tar.gz  
		cd rsync-3.1.2  
	  	./configure --prefix=/usr/local/rsync --disable-ipv6  
  		make  
		make install  
  
		ln -s /usr/local/rsync/bin/rsync /usr/local/bin/rsync  
  
  
- server端配置  
  
		# vi /usr/local/rsync/rsyncd.conf  
  
		  pid file = /var/run/rsyncd.pid #pid文件
          port = 873
          uid = root #启动用户
          gid = root #启动用户组
          use chroot = no
          max connections = 5 #最大连接数
          timeout 600
          lock file = /var/run/rsyncd.lock #指定lock文件
          log file = /var/run/rsyncd.log #日志文件
          secrets file = /usr/local/rsync/rsyncd.secrets
          motd file = /usr/local/rsync/rsyncd.motd #指定欢迎消息文件

          [wateroa_code]
          path = /home/backup/code
          ignore errors
          read only = false
          list = false
          hosts allow = 172.18.1.12
          #hosts deny = 0.0.0.0/32
          auth users root
          comment = wateroa_code

          [wateroa_db]
          path = /home/backup/db
          ignore errors
          read only = false
          list = false
          hosts allow = 172.18.1.14
          #hosts deny = 0.0.0.0/32
          auth users root
          comment = wateroa_db
   
  
  
		#vi /usr/local/rsync/rsyncd.motd  
		  
		++++++++++++++++++++++++++++++++++++  
		Wlecome to ocpyang  rsync services         
		++++++++++++++++++++++++++++++++++++  
		  
		  
		--指定rsync访问的密码,密码不需要和系统账号密码相同  
		  
		# vi /usr/local/rsync/rsyncd.secrets    
		root:snow01  
  
  
		ln -s /usr/local/rsync/rsyncd.conf /etc/rsyncd.conf  
		ln -s /usr/local/rsync/rsyncd.motd /etc/rsyncd.motd  
		ln -s /usr/local/rsync/rsyncd.secrets  /etc/rsyncd.secrets  
		  
		  
		chmod 600 /usr/local/rsync/rsyncd.secrets  
		  
		chown root:root /usr/local/rsync/rsyncd.secrets  
		  
  
  
- 启动rsync  
  
		# /usr/bin/rsync --daemon --config=/etc/rsyncd.conf  
		  
		# echo "/usr/bin/rsync --daemon --config=/etc/rsyncd.conf" >> /etc/rc.d/rc.local   
		  
		# cat /etc/rc.d/rc.local   
		#!/bin/sh  
		#  
		# This script will be executed *after* all the other init scripts.  
		# You can put your own initialization stuff in here if you don't  
		# want to do the full Sys V style init stuff.  
		  
		touch /var/lock/subsys/local  
		/usr/bin/rsync --daemon  
		  
		  
		# netstat -lntp | grep 873  
		tcp        0      0 0.0.0.0:873                 0.0.0.0:*                   LISTEN      10689/rsync           
		tcp        0      0 :::873                      :::*                        LISTEN      10689/rsync     
		  
- 新建测试文件
  
		#dd if=/dev/zero of=/test/t01.file bs=1M count=50   
		#pkill rsync  
  
  
  
- 客户端服务器配置  
  
  
(1).新建客户端密码文件(客户端不带用户名)  
  
	#vi /etc/rsyncd.secrets  
	snow01  
	  
	#chmod 600 /etc/rsyncd.secrets  
	  
	rsync -vzrtopg  --progress --delete  root@192.168.5.189::test /ocpyang/   
	  
	rsync -vzrtopg --progress --delete  root@192.168.5.189::test /ocpyang/ --password-file=/etc/rsyncd.pwd  
  
  
  
(3).新建同步脚本  
  
	# vi /rsync.sh  
	#!/bin/bash  
	    
	  
	rsync -vzrtopg  --progress --delete  root@192.168.5.189::test /testbak/   
	  
	rsync -vzrtopg --progress --delete  root@192.168.5.189::test /testbak/ --password-file=/etc/rsyncd.pwd  
  
  
(4).手动同步文件  
  
	#cd /  
	#./rsync.sh  
  
  
(5).自动同步:每隔五分钟同步一次  

	# crontab -e  
	0,5 * * * * /rsync.sh  