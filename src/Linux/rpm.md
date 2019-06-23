## rpm
- 安装一个包 
　　
  	# rpm -ivh < rpm package name> 
- 升级一个包 
　　
  	# rpm -Uvh < rpm package name> 
- 移走一个包 
　　
  	# rpm -e < rpm package name> 
- 安装参数 
	- –force 即使覆盖属于其它包的文件也强迫安装 
	- –nodeps 如果该RPM包的安装依赖其它包，即使其它包没装，也强迫安装。 
- 查询一个包是否被安装 
　　
  	# rpm -q < rpm package name> 
- 得到被安装的包的信息 
　　
  	# rpm -qi < rpm package name> 
- 列出该包中有哪些文件 
　　
  	# rpm -ql < rpm package name> 
- 列出服务器上的一个文件属于哪一个RPM包 
　　
  	# rpm -qf 
- 可综合好几个参数一起用 
　　
  	# rpm -qil < rpm package name> 
- 列出所有被安装的rpm package

      # rpm -qa 
- 列出一个未被安装进系统的RPM包文件中包含有哪些文件？ 
　　
  	# rpm -qilp < rpm package name>