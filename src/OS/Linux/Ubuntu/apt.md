## apt-get 卸载docker与相关命令
- 找到已安装的包

		dpkg -l | grep -i docker
- 卸载

		sudo apt-get purge -y docker-engine docker docker.io docker-ce docker-ce-cli docker-compose-plugin
		sudo apt-get autoremove -y --purge docker-engine docker docker.io docker-ce docker-compose-plugin
- 删除容器、镜像等

		sudo rm -rf /var/lib/docker 
		sudo rm -rf /etc/docker
		sudo rm /etc/apparmor.d/docker
		sudo groupdel docker
		sudo rm -rf /var/run/docker.sock
- 卸载相关命令说明
	- 删除已安装的软件包（保留配置文件），不会删除依赖软件包，且保留配置文件。

			apt-get autoremove
	-  删除已安装的软件包（保留配置文件）

			apt-get remove 
	- 删除已安装包（不保留配置文件)，删除软件包，同时删除相应依赖软件包。 

			apt-get purge 
			apt-get --purge remove 
	- 清理下载的软件安装包，会将 `/var/cache/apt/archives/` 下的 所有 `deb` 删掉

			apt-get clean
	- 删除为了满足某些依赖安装的，但现在不再需要的软件包。

			apt-get autoclean