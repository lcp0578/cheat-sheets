## Linux 系统救援发行版：SystemRescue
- SystemRescue（以前称为 SystemRescueCd）是一个 Linux 系统救援系统，包含众多救援软件工具包，可用作可启动介质，用于在崩溃后管理或修复系统和数据。
- SystemRescue旨在提供一种在计算机上执行管理任务的简单方法，例如创建和编辑硬盘分区。它附带了很多Linux系统实用程序， 例如GParted、fsarchiver、文件系统工具和基本工具（编辑器、午夜指挥官、网络工具）。它可用于 Linux 和Windows 计算机、台式机和服务器。该救援系统无需安装，因为它可以从 CD/DVD 驱动器或 USB 记忆棒启动，但如果您愿意，也可以 安装在硬盘上 。内核支持所有重要的文件系统（ext4、xfs、btrfs、vfat、ntfs）以及网络文件系统，例如 Samba 和 NFS。
- 系统工具
	- GNU Parted：创建、调整大小、移动、复制分区和文件系统（等等）。
	- GParted：使用 GNU Parted 库的 GUI 实现。
	- FSArchiver：灵活的存档器，可用作系统和数据恢复软件
	- ddrescue：尝试制作存在硬件错误的块设备的副本，可以选择使用副本中用户定义的模式填充输入中相应的坏点。
	- 文件系统工具（适用于 Linux 和 Windows 文件系统）：格式化、调整大小和调试硬盘的现有分区
	- Ntfs3g：启用对 MS Windows NTFS 分区的读/写访问。
	- Test-disk：检查和恢复分区的工具，支持 reiserfs、ntfs、fat32、ext3/ext4 等
	- Memtest：测试计算机的内存（当出现崩溃或意外问题时首先要测试）
	- Rsync：非常高效且可靠的程序，可用于远程备份。
	- 网络工具（Samba、NFS、ping、nslookup 等）：通过网络备份数据。