## CentOS Local yum repo
- 挂载镜像文件或者手动添加  
	在/root下创建rpm目录，可以在此下载对应rpm包，https://mirrors.aliyun.com/centos/6.9/os/x86_64/Packages/
	
		/root/rpm/
			----- Packages/ 存放rpm包
			----- repodata/ rpm包的索引目录
- 备份其他的repo
	
		# cd /etc/yum.repos.d/
		# mv CentOS-Base.repo CentOS-Base.repo_bak
		# mv CentOS-Debuginfo.repo CentOS-Debuginfo.repo_bak
- 创建本地repo

		# vim CentOS-Local.repo
		[CentOS-Local] # 不能有空格
		baseurl=file:///root/rpm/   # 挂载目录或者rpm包目录
		gpgcheck=0 # 是否校验签名，0不校验，1校验
		enabled=1 # 是否开启
- 清除缓存

		yum clean all
		yum list 