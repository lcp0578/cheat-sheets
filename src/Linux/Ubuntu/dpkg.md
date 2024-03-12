## dpkg命令
- dpkg 命令安装软件

		sudo dpkg -i fping_4.2-1_amd64.deb
- 列出当前系统中已经安装的软件以及软件包的状态

		dpkg -l
		dpkg -l | grep docker
- 卸载

		sudo dpkg -r vim