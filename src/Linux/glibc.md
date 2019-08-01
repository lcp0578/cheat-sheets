## glibc 简介与升级
- glibc简介
> glibc是GNU发布的libc库，即c运行库。glibc是linux系统中最底层的api，几乎其它任何运行库都会依赖于glibc。glibc除了封装linux操作系统所提供的系统服务外，它本身也提供了许多其它一些必要功能服务的实现。由于 glibc 囊括了几乎所有的 UNIX 通行的标准，可以想见其内容包罗万象。而就像其他的 UNIX 系统一样，其内含的档案群分散于系统的树状目录结构中，像一个支架一般撑起整个操作系统。
- 查看glibc  
使用如下命令：`$ strings /lib64/libc.so.6 |grep GLIBC_`  
Centos 为了稳定使用的glibc版本通常比较低。而安装有些程序需要依赖新版本。升级glibc需要慎重，因很多人升级失败后导致系统不能用了。  
如果升级基本C运行库到一个太新的版本，可能会影响CentOS的运行。  
- 升级过程
	- 下载安装包
	
    		# wget http://ftp.gnu.org/gnu/glibc/glibc-2.15.tar.gz
            ##解压
            # tar xvf glibc-2.15.tar.gz
	- 安装gcc
	
    		# yum -y install gcc
	- 编译
	
    		# mkdir build
            # cd build
            # ../configure --prefix=/opt/glibc-2.15
            # make && make install
    - 若在make install时，报错
    
    		Can't open configuration file/opt/glibc-2.15/etc/ld.so.conf: No such file or directory
            # find / -name"ld.so.conf"
			/etc/ld.so.conf
			# cp /etc/ld.so.conf /opt/glibc-2.15/etc/  //执行完后，继续make install
	- 建立glibc软链
	
    		# rm -rf /lib64/libc.so.6
            # LD_PRELOAD=/lib64/libc-2.12.so ln -s /opt/glibc-2.15/lib/libc-2.15.so /lib64/libc.so.6
    - 失败回滚方法
    
    		#原理
            # ll /lib64/libc.so.6
			lrwxrwxrwx 1 root root 12 Jun 22 18:08 /lib64/libc.so.6 -> libc-2.12.so
            # LD_PRELOAD=/lib64/libc-2.12.so ln -s /lib64/libc-2.12.so /lib64/libc.so.6
	- 升级后，语言包报错问题
	
    		locale: Cannot set LC_CTYPE to default locale: No such file or directory
			locale: Cannot set LC_ALL to default locale: No such file or directory
            //复制语言包到glibc中
            cp -R /usr/lib/locale /opt/glibc-2.15/lib/
