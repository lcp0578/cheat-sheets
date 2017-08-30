## nodejs
### nodejs的安装
- 下载源码包  
	node-v8.4.0-linux-x64.tar.xz  
	下载地址：[http://nodejs.cn/download](http://nodejs.cn/download/)
- 解压复制

		$ xz -d node-v8.4.0-linux-x64.tar.xz //node-v8.4.0-linux-x64.tar
		$ tar -zxf node-v8.4.0-linux-x64.tar
	再复制到/usr/local/node下
- 编辑  vi /etc/profile

		export NODE_HOME=/usr/local/node
		export PATH= PATH:NODE_HOME/bin
		export NODE_PATH=$NODE_HOME/lib/node_modules
	让配置文件生效
	
		source /etc/profile
- 查看是否安装成功

		node -v
	