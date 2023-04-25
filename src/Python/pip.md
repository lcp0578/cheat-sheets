## pip pip3 替换国内镜像源
- 在采用默认 pip3 安装第三方库的时候，经常会出现超时的情况。
 
		pip._vendor.urllib3.exceptions.ReadTimeoutError: HTTPSConnectionPool(host='files.pythonhosted.org', port=443): Read timed out.
	这时候就需要替换镜像源为国内的镜像源了。
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