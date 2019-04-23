## 配置中文支持
- 1、安装中文包：

		# yum -y groupinstall chinese-support    安装所有与中文支持相关的包

- 2、修改字符编码配置文件

		# vi /etc/sysconfig/i18n

        修改后内容如下：

        LANG="zh_CN.UTF-8"

        SUPPORTED="zh_CN:zh:en_US.UTF-8:en_US:en:zh_CN.GB18030"

        SYSFONT="latarcyrheb-sun16"

- 3、最后重启服务器：

		#reboot