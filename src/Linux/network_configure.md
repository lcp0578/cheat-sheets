## network configure

- CentOS 6.x
	- 编辑网卡信息
	
    		vim /etc/sysconfig/network-scripts/ifcfg-eth0
            DEVICE=eth0
            TYPE=Ethernet
            UUID=bdddb223-ca1b-4de1-8de6-119451b847ec
            ONBOOT=yes
            NM_CONTROLLED=yes
            BOOTPROTO=static
            NETMASK=255.255.255.0
            GATEWAY=192.168.48.2
            IPADDR=192.168.48.11
	- 设置dns信息
	
        	vim /etc/resolv.conf
        	nameserver 192.168.48.2
    - 重启网络服务
    
    		service network restart