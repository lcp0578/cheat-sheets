## Kingbase V8 Windows下使用
- [基于Windows系统的数据库软件安装指南 ](https://help.kingbase.com.cn/v8/install-updata/install-windows/index.html)
- 查看人大金仓版本

		> sys_ctl.exe -V 
		sys_ctl (Kingbase) 12.1
- 启动人大金仓
	- 进任务管理器，服务，启动`kingbase8_instance`服务
	- 命令行启动
		- `sys_ctl.exe -D "D:\Program Files\Kingbase\ES\V8\data" start`