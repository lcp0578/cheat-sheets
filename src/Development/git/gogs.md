## Gogs
- 服务启动

		nohup ./gogs web &
- 以服务方式运行并设置开机自启

		#设置开机自启
		
		#将gogs的启动脚本复制到/etc/init.d/路径下：
		
		#gogs自己提供了默认的启动脚本，在gogs安装包的scripts/init/路径下,可以根据自己的操作系统选择不同的脚本
		
		cp /gogs/scripts/init/centos/gogs /etc/rc.d/init.d/
		
		#编辑启动脚本
		
		vim /etc/rc.d/init.d/gogs
		
		#修改启动脚本的GOGS_HOME和GOGS_USER，它们分别是gogs的安装路径和gogs的启动用户
		
		#进入/etc/init.d路径
		
		cd /etc/init.d
		
		#给启动脚本赋予可执行权限
		
		chmod +x gogs
		
		#启动gogs
		
		service gogs start
		
		#关闭gogs
		
		service gogs stop
		
		#重启gogs
		
		service gogs restart
		
		#将gogs设置为开机自启动
		
		chkconfig gogs on
		
		#检查是否加入成功
		
		chkconfig –list gogs
- 备份与恢复
	- https://github.com/gogs/gogs/discussions/6876