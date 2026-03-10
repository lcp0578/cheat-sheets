## mac docker install oracle11g
- 拉取镜像

		docker pull jaspeen/oracle-11g
- 下载oracle11g源码包
	- 从oracle 官网 下载所需要的安装包，这里我们以oracle 11g 为例子，分别下载 linux.x64_11gR2_database_1of2.zip 和 linux.x64_11gR2_database_2of2.zip两个压缩包，下载完成后解压到`/Users/lcp0578/Oracle/code`
- 启动镜像（执行安装oracle）

		docker run --privileged --name oracle11g -p 1521:1521 -v /Users/lcp0578/Oracle/code:/install jaspeen/oracle-11g
	- 命令的解释：
		- docker run 启动容器的命令
		- privileged 给这个容器特权，安装oracle可能需要操作需要root权限的文件或目录
		- name 给这个容器名一个名字
		- p 映射端口
		- v 挂在文件到容器指定目录 (/Users/lcp0578/Oracle/codedatabase 对应容器 /install/database)
		- jaspeen/oracle-11g 代表启动指定的容器