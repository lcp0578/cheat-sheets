## Kingbase V8 Windows下使用
- [基于Windows系统的数据库软件安装指南 ](https://help.kingbase.com.cn/v8/install-updata/install-windows/index.html)
- 查看人大金仓版本

		> sys_ctl.exe -V 
		sys_ctl (Kingbase) 12.1
- 启动人大金仓
	- 进任务管理器，服务，启动`kingbase8_instance`服务
	- 命令行启动
		- `sys_ctl.exe -D "D:\Program Files\Kingbase\ES\V8\data" start`
- 注册windows服务

		D:\Program Files\Kingbase\ES\V8R6C9\KESRealPro\V008R006C009B0014\Server\bin>.\sys_ctl.exe register -N kingbase8_V8R6C9 -D "D:\Program Files\Kingbase\ES\V8R6C9\data" -S demand
	- `demand` 表示手动启动
	- `auto` 表示自动启动
	- 注册命令说明

			sys_ctl.exe register -N "你的服务名" -D "你的数据目录路径" -S auto