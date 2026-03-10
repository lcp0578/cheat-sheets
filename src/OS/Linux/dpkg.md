## dpkg 安装 .deb文件
- deb文件
	- deb包是Debian，Ubuntu等Linux发行版的软件安装包，扩展名为.deb，是类似于rpm的软件包
- 示例
	- 查看linuxidc.deb软件包的详细信息，包括软件名称、版本以及大小等（其中-I等价于--info）

			sudo dpkg -I linuxidc.deb
	- 查看linuxidc.deb软件包中包含的文件结构（其中-c等价于--contents）

			sudo dpkg -c linuxidc.deb
	- 安装linuxidc.deb软件包（其中-i等价于--install）

			sudo dpkg -i linuxidc.deb
	- 查看linuxidc软件包的信息（软件名称可通过dpkg -I命令查看，其中-l等价于--list）

			sudo dpkg -l linuxidc

	- 列出linuxidc软件包安装的所有文件清单（软件名称可通过dpkg -I命令查看，其中-L等价于--listfiles）

			sudo dpkg -L linuxidc

	- 显示linuxidc软件包的详细信息（软件名称可通过dpkg -I命令查看，其中-s等价于--status）

			sudo dpkg -s linuxidc

	- 卸载linuxidc软件包（软件名称可通过dpkg -I命令查看，其中-r等价于--remove）

			sudo dpkg -r linuxidc

	- 完全清除一个已安装的包裹。和 remove 不同的是，remove 只是删掉数据和可执行文件，purge 另外还删除所有的配制文件：

			sudo dpkg -P linuxidc

	- 重新配制一个已经安装的包，如果它使用的是 debconf （debconf 为包安装提供了一个统一的配制界面）：

			dpkg-reconfigure linuxidc

- 注：dpkg命令无法自动解决依赖关系。如果安装的deb包存在依赖包，则应避免使用此命令，或者按照依赖关系顺序安装依赖包。