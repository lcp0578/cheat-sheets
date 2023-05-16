## WSL( Windows Subsystem for Linux)
#### WSL简介
- The Windows Subsystem for Linux lets developers run a GNU/Linux environment -- including most command-line tools, utilities, and applications -- directly on Windows, unmodified, without the overhead of a traditional virtual machine or dualboot setup.
#### 安装
- 默认安装命令

		wsl --install
- 查看微软提供的系统

		wsl --list --online
- 安装指定版本

		wsl --install -d <DistroName>
- 列出已安装的 Linux 发行版

		wsl --list --verbose
- 通过 PowerShell 或 CMD 运行特定的 Linux 发行版

		wsl --distribution <Distribution Name> --user <User Name>
- 关闭

		wsl --shutdown
	- 立即终止所有正在运行的发行版和 WSL 2 轻量级实用工具虚拟机。 在需要重启 WSL 2 虚拟机环境的情形下，例如更改内存使用限制或更改 `.wslconfig` 文件，可能必须使用此命令。
- 注销或卸载 Linux 发行版

		wsl --unregister <DistributionName>
	- 如果将 <DistributionName> 替换为目标 Linux 发行版的名称，则将从 WSL 取消注册该发行版，以便可以重新安装或清理它。 警告：取消注册后，与该分发版关联的所有数据、设置和软件将永久丢失。 从 Store 重新安装会安装分发版的干净副本。 例如：wsl --unregister Ubuntu 将从可用于 WSL 的发行版中删除 Ubuntu。 运行 wsl --list 将会显示它不再列出。
	- 还可以像卸载任何其他应用商店应用程序一样卸载 Windows 计算机上的 Linux 发行版应用。 若要重新安装，请在 Microsoft Store 中找到该发行版，然后选择“启动”。
- 装载磁盘或设备

		wsl --mount <DiskPath>