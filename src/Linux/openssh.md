## Centos7.6之OpenSSH 7.4升级版本至9.4
#### 安装telnet
> 注意：安装telnet，防止ssh安装失败无法连接。
- 1、安装Telnet
	- 注意：一般Linux系统自带Telnet客户端，我们只需要安装服务端即可；另外Telnet运行需要依靠xinetd组件，安装命令如下所示：

	yum install telnet-server.x86_64 xinetd.x86_64 -y
- 2、运行telnet服务

		systemctl enable telnet.socket
		systemctl start telnet.socket
		systemctl start xinetd
		systemctl status telnet.socket

- 3、移除文件
	- 注意：Linux系统中默认不允许root账户telnet远程登录，这里需要移除配置文件，保证root账户能够远程登录。

			mv /etc/securetty /etc/securetty.bak
- 4、使用xshell测试下telnet协议连接服务器。
#### 准备工作
- 安装依赖

		yum install -y gcc gcc-c++ perl perl-IPC-Cmd pam pam-devel
- 下载tar包

		cd /home/openssh
		wget https://www.openssl.org/source/openssl-3.1.0.tar.gz --no-check-certificate
		wget https://cdn.openbsd.org/pub/OpenBSD/OpenSSH/portable/openssh-9.4p1.tar.gz 
		wget http://www.zlib.net/zlib-1.2.13.tar.gz # 如果404，则去github下载，https://github.com/madler/zlib/releases
		tar axf openssh-9.4p1.tar.gz && tar axf openssl-3.1.0.tar.gz && tar axf zlib-1.2.13.tar.gz
#### 备份文件
- 1、备份openssl

		mv /usr/bin/openssl /usr/bin/openssl.old
- 2、备份openssh

		mv /etc/ssh /etc/ssh.bak
		mkdir /usr/bin/bak
		\cp -arpf /usr/bin/{cp,sftp,ssh,ssh-add,ssh-agent,ssh-keygen,ssh-keyscan} /usr/bin/bak/
		\cp -arpf /usr/sbin/sshd /usr/sbin/sshd.bak
		\cp -arpf /etc/sysconfig/sshd /etc/sysconfig/sshd.bak
		\cp -arpf /etc/pam.d/sshd /etc/pam.d/sshd.bak
	- 说明：如果cp、sftp、ssh、ssh-add、ssh-agent、ssh-keygen、ssh-keyscan等二进制文件是软连接，这里就不需要备份，请直接删除这些软连接，后续如果还原的时候请从这些文件的源路径里拷贝即可。当前环境不是软连接，所以对这些二进制文件进行备份。
#### 编译安装zlib

	cd zlib-1.2.13
	./configure --prefix=/usr/local/zlib-1.2.13 && make -j 4 && make install
#### 编译安装openssl
- 1、编译安装

		cd openssl-3.1.0
		./config --prefix=/usr/local/openssl-3.1.0 && make -j 4 && make install
- 2、编辑ld.so.conf文件

		echo '/usr/local/openssl-3.1.0/lib64' >> /etc/ld.so.conf
		ldconfig && ldconfig -v
- 3、创建操作系统软链接

		ln -s /usr/local/openssl-3.1.0/bin/openssl /usr/bin/openssl
		ln -s /usr/local/openssl-3.1.0/include/openssl /usr/include/openssl
		ll -s /usr/bin/openssl
		ll -s /usr/include/openssl
- 4、检查Openssl版本

		openssl version
		OpenSSL 3.1.0 14 Mar 2023 (Library: OpenSSL 3.1.0 14 Mar 2023)
#### 编译安装openssh
- 1、编译安装

		cd openssh-9.4p1
		./configure --prefix=/usr/local/openssh-9.4p1 --sysconfdir=/etc/ssh  \
		--with-ssl-dir=/usr/local/openssl-3.1.0 --with-zlib=/usr/local/zlib-1.2.13 --without-hardening 
		make && make install
- 2、替换新版本openssh相关命令
		
		\cp -arpf /usr/local/openssh-9.4p1/bin/scp /usr/bin/
		\cp -arpf /usr/local/openssh-9.4p1/bin/sftp /usr/bin/
		\cp -arpf /usr/local/openssh-9.4p1/bin/ssh /usr/bin/
		\cp -arpf /usr/local/openssh-9.4p1/bin/ssh-add /usr/bin/
		\cp -arpf /usr/local/openssh-9.4p1/bin/ssh-agent /usr/bin/
		\cp -arpf /usr/local/openssh-9.4p1/bin/ssh-keygen /usr/bin/
		\cp -arpf /usr/local/openssh-9.4p1/bin/ssh-keyscan /usr/bin/
		\cp -arpf /usr/local/openssh-9.4p1/sbin/sshd /usr/sbin/sshd
- 3、拷贝启动脚本

		\cp -a contrib/redhat/sshd.init /etc/init.d/sshd
		\cp -a contrib/redhat/sshd.pam /etc/pam.d/sshd.pam
		chmod +x /etc/init.d/sshd
		mv /usr/lib/systemd/system/sshd.service /usr/lib/systemd/system/sshd.service.bak
- 4、修改配置文件

		vi /etc/ssh/sshd_config
		PermitRootLogin yes
		PasswordAuthentication yes
		UseDNS no
- 5、设置开机启动,并验证版本

		systemctl daemon-reload
		systemctl enable sshd.socket
		sshd -t
		systemctl restart sshd
		ssh -V
		OpenSSH_9.4p1, OpenSSL 3.1.0 14 Mar 2023
