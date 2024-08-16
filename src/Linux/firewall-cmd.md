## 使用firewall-cmd开放和关闭对外端口
- 安装firewall-cmd

		sudo apt-get install firewalld
- 开放端口（比如开放8001）

		firewall-cmd --add-port=8001/tcp --permanent
		firewall-cmd --reload
- 查看开放的端口

		firewall-cmd  --list-all
- 关闭端口

		firewall-cmd --remove-port=8001/tcp --permanent
		firewall-cmd --reload
