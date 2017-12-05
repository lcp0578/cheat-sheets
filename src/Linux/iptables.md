## iptables
- 防火墙的配置文件

		/etc/sysconfig/iptables
- 重启防火墙

		service  iptables restart

- 对某个ip开放3306

		-A INPUT -s 101.201.73.130 -p tcp -m tcp --dport 3306 -j ACCEPT
- 直接开放3306

		-A INPUT -m state --state NEW -m tcp -p tcp --dport 3306 -j ACCEPT