## Snap 和 Snapd
- 官方文档：https://snapcraft.io/docs
- Snap 是由 Ubuntu 开发商 Canonical 推出的一种通用软件包格式，旨在简化软件分发，而且与具体的 Linux 发行版无关。
- 在不同的 Linux 发行版中，通常会使用各自的包管理器和格式，比如：
	- Debian 系使用的 APT
	- Fedora/RHEL 系使用的 DNF
	- Arch Linux 系使用的 Pacman 等
- 但在不同系的 Linux 发行版中，各包管理器和软件包存在兼容性问题，而 Snap 类似于 Flatpak，它通过容器化技术，将应用程序及其依赖项打包成一个独立的包，来解决兼容性问题。以下是 Snap 的主要特点：
	- 通用兼容性：可以在不同 Linux 发行版上运行，开发者无需为每个发行版创建单独的包。
	- 隔离和安全性：每个 Snap 都在独立的环境中运行，不受其他应用影响，提升了安全性。
	- 自动更新：Snap 应用可以在后台自动更新，让你始终使用最新版本。
	- 依赖管理：Snap 包含了所有所需的依赖项，无需额外安装其他库。
	- 轻松回滚：如果更新出现问题，可以方便地回滚到先前版本。
- 除了 Snap，另一个关键组件是 snapd，它是管理 Snap 包的后台服务，负责安装、更新和删除 Snap 包。简单来说：
	- Snap 是实际的应用包，包含了应用程序和所有依赖项，能在任何支持 Snap 的 Linux 发行版上运行。
	- snapd 是负责管理这些 Snap 包的后台服务，确保应用的安全性、更新以及与系统的隔离。

#### 基本 Snap 命令
- 搜索软件包

		snap find <关键字或软件包名称>
-  查看软件包详情

		snap info <软件包名称>
- 安装 Snap 软件包

		sudo snap install <软件包名称>
- 卸载 Snap 软件包

		sudo snap remove <软件包名称>
		sudo snap remove <软件包1> <软件包2>
- 列出已安装的 Snap 软件包

		snap list