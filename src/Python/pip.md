## pip pip3 替换国内镜像源与常用命令
- 在采用默认 pip3 安装第三方库的时候，经常会出现超时的情况。
 
		pip._vendor.urllib3.exceptions.ReadTimeoutError: HTTPSConnectionPool(host='files.pythonhosted.org', port=443): Read timed out.
	这时候就需要替换镜像源为国内的镜像源了。
- 配置pip源
	- 阿里云源
	
			pip config set global.index-url https://mirrors.aliyun.com/pypi/simple 
			pip config set install.trusted-host mirrors.aliyun.com
	- 清华源

			pip config set global.index-url https://pypi.tuna.tsinghua.edu.cn/simple/
			pip config set install.trusted-host pypi.tuna.tsinghua.edu.cn
- 国内的pip源
	- 阿里云：https://mirrors.aliyun.com/pypi/simple/ 
	- 清华：https://pypi.tuna.tsinghua.edu.cn/simple 
	- 中国科技大学 https://pypi.mirrors.ustc.edu.cn/simple/ 
	- 华中理工大学：http://pypi.hustunique.com/ 
	- 山东理工大学：http://pypi.sdutlinux.org/ 
	- 豆瓣：http://pypi.douban.com/simple/ 
- 临时更换镜像源

		pip3 install 库名 -i 镜像地址
- 解决报错：error: metadata-generation-failed


		pip install kiwisolver==1.2.0 --use-deprecated=legacy-resolver
- 更新升级pip，管理员方式进入CMD窗口下，执行`python -m pip install -U pip setuptools`，将pip升级到最新版本。
- pip 最常用命令
	- 显示版本和路径

			pip --version
	- 获取帮助

			pip --help
	- 升级 pip

			pip install -U pip
	- 如果这个升级命令出现问题 ，可以使用以下命令：

			sudo easy_install --upgrade pip
	- 安装包

			pip install SomePackage              # 最新版本
			pip install SomePackage==1.0.4       # 指定版本
			pip install 'SomePackage>=1.0.4'     # 最小版本
		- 比如我要安装 Django。用以下的一条命令就可以，方便快捷。

				pip install Django==1.7
	- 升级包

			pip install --upgrade SomePackage
		- 升级指定的包，通过使用==, >=, <=, >, < 来指定一个版本号。
	- 卸载包

			pip uninstall SomePackage
	- 搜索包

			pip search SomePackage
	- 显示安装包信息

			pip show 
	- 查看指定包的详细信息

			pip show -f SomePackage
	- 列出已安装的包

			pip list
	- 查看可升级的包

			pip list -o