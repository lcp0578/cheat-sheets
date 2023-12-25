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
		        nameservers:
		          addresses: [202.99.192.68, 202.99.192.66] #DNS
		        routes:
		          - to: default
		            via: 172.16.10.254 # gateway
		  version: 2

- 应用网卡信息

		# netplan apply
- 十进制子网掩码换算器
	- https://www.sojson.com/convert/subnetmask.html
