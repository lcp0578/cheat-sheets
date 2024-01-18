## 防火墙设置
- 查看防火墙状态

		ufw status
		ufw status verbose
- 关闭ubuntu的防火墙 

		ufw disable
- 开启防火墙

		ufw enable
- 开放端口

		sudo ufw allow 80 #tcp和udp 80
		sudo ufw allow 80/tcp #仅tcp 80
		sudo ufw allow 7100:7200/tcp #端口范围
- 设置源IP

		sudo ufw allow from 192.168.1.100 #仅允许单IP地址
		sudo ufw allow from 192.168.1.100 to any port 3306 #仅允许单IP地址连接3306
		sudo ufw allow from 192.168.1.0/24 to any port 3306
- 删除端口（根据规则编号删除）
	- 查看编号列表的规则

			ufw status numbered
	- 根据规则编号删除

			ufe delete 11