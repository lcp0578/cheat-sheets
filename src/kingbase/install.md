## Kingbase install
- 目录规划
	- `/home/kingbase/install` 数据库安装包及license文件存放目录
	- `/home/kingbase/KingbaseES/V8` 数据库软件目录
	- `/home/kingbase/data` 数据库数据目录
	- `/home/kingbase/backup` 数据库备份目录
- 安装
	- 官网下载安装包：KingbaseES_V008R003C002B0320_Lin64_install.iso
	- 安装7z:`yum install p7zip p7zip-plugins`
	- 解压 `7z x KingbaseES_V008R003C002B0320_Lin64_install.iso`
	- 修改权限`chown -R kingbase:kingbase /home/kingbase`
	- 切换为kingbase用户
	- 执行 `setup.sh`
	- If you want to register KingbaseES V8 as OS service, please run，需要切换成root用户，然后执行

    		/home/kingbase/KingbaseES/V8/Scripts/root.sh
- 启动与停止
	- 通过系统服务方式管理
		- 停止数据库 
		`service kingbase8d stop` (/etc/init.d/kingbase8d stop)
		- 启动数据库 
		`service kingbase8d start` (/etc/init.d/kingbase8d start)
		- 重启 
		`service kingbase8d restart` (/etc/init.d/kingbase8d restart)
		- 查看数据库服务状态 
		`service kingbase8d status` (/etc/init.d/kingbase8d status)
	- 使用`sys_ctl`命令，位于安装目录`/Server/bin`下
		- 启动
		`sys_ctl start -D $DBDATA`
        其中$DBDATA是指Kingbase数据库的数据目录
        - 停止
        `sys_ctl stop -D $DBDATA [-m $SHUTDOWN-MODE]`
        其中-m是指定数据库的停止方式（$SHUTDOWN-MODE），有以下三种
        	- `smart`:等所有连接终止后，关闭数据库，如果客户端连接不终止，则无法关闭数据库，是默认的停止方式。
        	- `fast`:快速关闭数据库，断开客户端的连接，让已有的事务回滚，然后正常关闭数据库；相当于Oracle数据库关闭时的immediate模式。
        	- `immediate` 立即关闭数据库，相当于数据库进程立即停止，直接退出，下次启动数据库需要进行恢复。相当于Oracle数据库关闭时的abort模式。