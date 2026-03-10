## Anaconda之conda的使用
- 常用命令
	- 查看conda版本

			$ conda --version

	- 更新conda版本

			$ conda update conda

	- 查看都安装了那些依赖库

			$ conda list
- 管理Python包
	- 安装一个 package

			$ conda install package_name

		- 这里 package_name 是需要安装包的名称。你也可以同时安装多个包，比如同时安装numpy 、scipy 和 pandas，则执行如下命令：

				$ conda install numpy scipy pandas

		- 指定安装的版本，比如安装 1.1 版本的 numpy ：

				$ conda install numpy=1.10

	- 移除一个 package

			$ conda remove package_name

	- 升级 package 版本

			$ conda update package_name

	- 查看所有的 packages

			$ conda list

	- 模糊查询

			$ conda  search search_term
- 管理Python环境
	- 默认的环境是当前用户，你也可以创建一个新环境：

			$ conda create -n env_name list of packages

		- 其中 -n 代表 name，env_name 是需要创建的环境名称，list of packages 则是列出在新环境中需要安装的工具包。
		- 例如，当安装了 Python3 版本的 Anaconda 后，默认的 root 环境自然是 Python3，但是我还需要创建一个 Python 2 的环境来运行旧版本的 Python 代码，最好还安装了 pandas 包，于是我们运行以下命令来创建：

				$ conda create -n py2 python=2.7 pandas

		细心的你一定会发现，py2 环境中不仅安装了 pandas，还安装了 numpy 等一系列 packages，这就是使用 conda 的方便之处，它会自动为你安装相应的依赖包，而不需要你一个个手动安装。

	- 进入名为 env_name 的环境

			$ source activate env_name

	- 退出当前环境

			$ source deactivate

		另外注意，在 Windows 系统中，使用 activate env_name 和 deactivate 来进入和退出某个环境。

	- 删除名为 env_name 的环境

			$ conda env remove -n env_name

	- 显示所有的环境：

			$ conda env list

	- 当分享代码的时候，同时也需要将运行环境分享给大家，执行如下命令可以将当前环境下的 package 信息存入名为 environment 的 YAML 文件中。

			$ conda env export > environment.yaml

	- 同样，当执行他人的代码时，也需要配置相应的环境。这时你可以用对方分享的 YAML 文件来创建一摸一样的运行环境。

			$ conda env create -f environment.yaml