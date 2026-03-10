## lsblk 列出所有可用块设备的信息
- 命令简介
	- lsblk命令的英文是“list block”，即用于列出所有可用块设备的信息，而且还能显示他们之间的依赖关系，但是它不会列出RAM盘的信息。块设备有硬盘，闪存盘，CD-ROM等等。
- 使用示例

		# lsblk
		NAME MAJ:MIN RM SIZE RO TYPE MOUNTPOINT
		sda 8:0 0 40G 0 disk
		├─sda1 8:1 0 300M 0 part /boot
		├─sda2 8:2 0 2G 0 part [SWAP]
		└─sda3 8:3 0 37.7G 0 part /
		sr0 11:0 1 1024M 0 rom

	- NAME：这是块设备名。
	- MAJ:MIN：本栏显示主要和次要设备号。
	- RM：本栏显示设备是否可移动设备。注意，在本例中设备sdb和sr0的RM值等于1，这说明他们是可移动设备。
	- SIZE：本栏列出设备的容量大小信息。例如298.1G表明该设备大小为298.1GB，而1K表明该设备大小为1KB。
	- RO：该项表明设备是否为只读。在本案例中，所有设备的RO值为0，表明他们不是只读的。
	- TYPE：本栏显示块设备是否是磁盘或磁盘上的一个分区。在本例中，sda和sdb是磁盘，而sr0是只读存储（rom）。
	- MOUNTPOINT：本栏指出设备挂载的挂载点。
