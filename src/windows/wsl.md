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