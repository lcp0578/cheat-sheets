## tcpdump编译安装及使用
#### tcpdump编译安装
- 下载libpcap和tcpdump源码包
	- https://www.tcpdump.org/index.html#latest-releases
- 安装C编译所需包：

		apt-get install build-essential
- 安装libpcap的依赖：

		apt-get install flex
		apt-get install bison
- 安装libpcap

		tar xvfz libpcap-1.10.4.tar.gz 
		 ./configure
		make
		make install
- 安装tcpdump

		tar xvfz tcpdump.4.99.4.tar.gz 
		./configure
		make
		make install
#### 使用示例
- 抓取所有的网络包，并存到 result.cap 文件中。

		tcpdump -w result.cap
- 抓取所有的经过eth0网卡的网络包，并存到result.cap 文件中。

		tcpdump -i eth0 -w result.cap
- 抓取源地址是192.168.1.100的包，并将结果保存到 result.cap 文件中。

		tcpdump src host 192.168.1.100 -w result.cap
- 抓取地址包含是192.168.1.100的包，并将结果保存到 result.cap 文件中。

		tcpdump host 192.168.1.100 -w result.cap
- 抓取目的地址包含是192.168.1.100的包，并将结果保存到 result.cap 文件中。

		tcpdump dst host 192.168.1.100 -w result.cap
