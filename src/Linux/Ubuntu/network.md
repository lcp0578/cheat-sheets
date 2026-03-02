## Ubuntu Server 22.04 配置固定IP
- 切换到`root`
- 查看网卡名称

		# ip addr
		1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
		    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
		    inet 127.0.0.1/8 scope host lo
		       valid_lft forever preferred_lft forever
		    inet6 ::1/128 scope host 
		       valid_lft forever preferred_lft forever
		2: eno1: <BROADCAST,MULTICAST> mtu 1500 qdisc noop state DOWN group default qlen 1000
		    link/ether 34:73:79:19:20:ee brd ff:ff:ff:ff:ff:ff
		    altname enp26s0f0
		3: eno2: <BROADCAST,MULTICAST> mtu 1500 qdisc noop state DOWN group default qlen 1000
		    link/ether 34:73:79:19:20:ef brd ff:ff:ff:ff:ff:ff
		    altname enp26s0f1
		4: eno3: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc mq state UP group default qlen 1000
		    link/ether 34:73:79:19:20:f0 brd ff:ff:ff:ff:ff:ff
		    altname enp26s0f2
		    inet 172.16.10.253/24 brd 172.16.10.255 scope global eno3
		       valid_lft forever preferred_lft forever
		    inet6 fe80::3673:79ff:fe19:20f0/64 scope link 
		       valid_lft forever preferred_lft forever
		5: eno4: <BROADCAST,MULTICAST> mtu 1500 qdisc noop state DOWN group default qlen 1000
		    link/ether 34:73:79:19:20:f1 brd ff:ff:ff:ff:ff:ff
		    altname enp26s0f3

- 编辑网卡配置文件`/etc/netplan/00-installer-config.yaml`

		# vim /etc/netplan/00-installer-config.yaml 
		
		# This is the network config written by 'subiquity'
		network:
		  ethernets: 
		      renderer: networkd
		      eno3:
		        addresses:
		          - 172.16.10.253/24 #IP和掩码
		        # addresses: [172.16.10.248/24]
		        nameservers:
		          addresses: [202.99.192.68, 202.99.192.66] #DNS
		        routes:
		          - to: default
		            via: 172.16.10.254 # gateway
		  version: 2

- 如果重启后配置丢失，请注意配置文件开头的注释

		# This file is generated from information provided by the datasource.  Changes
		# to it will not persist across an instance reboot.  To disable cloud-init's
		# network configuration capabilities, write a file
		# /etc/cloud/cloud.cfg.d/99-disable-network-config.cfg with the following:
		# network: {config: disabled}


- 应用网卡信息

		# netplan apply
- 十进制子网掩码换算器
	- https://www.sojson.com/convert/subnetmask.html

- 网卡名称命名规则
	- Ubuntu 从 15.04 开始使用 systemd 的可预测网络接口命名规则，名称如 enpXsY 的含义是：
		- en：以太网
		- pX：PCI 总线号（bus number）
		- sY：PCI 插槽号（slot/device number）
	- 这种命名依赖于硬件在 PCI 总线上的物理位置，理论上应该是固定的。但如果你发现 enp2s0、enp5s0、enp6s0、enp8s0 这些名称在不同启动时交替出现，说明每次启动时 PCI 总线号发生了变化。

- 使用mac地址匹配来配置静态IP
	- 自定义接口 ID（例如 wan 或 eth0），然后通过 match 关键字基于 MAC 地址匹配实际的网卡。这样做之后，无论系统将网卡命名为 enp5s0 还是 enp6s0，只要它的 MAC 地址是 00:e0:23:6d:40:90，就会应用这套静态 IP 配置。
	- 配置示例

			# cat /etc/netplan/00-installer-config.yaml 
			# This is the network config written by 'subiquity'
			network:
			  ethernets:
			    my_eth:
			      match:
			        macaddress: "00:e0:23:6d:40:90"
			      dhcp4: false
			      dhcp6: false
			      addresses: [192.168.1.206/24]
			      routes:
			          - to: default
			            via: 192.168.1.254
			      nameservers:
			        addresses: [114.114.114.114]
			  version: 2
