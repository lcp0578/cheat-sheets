## wheel（.whl）包
- wheel包本质上是一个zip文件。是已编译发行版的一种格式。需要注意的是，尽管它是已经编译好的，包里面一般不包含.pyc或是Python字节码。一个wheel包的文件名由以下这些部分组成：

		{dist}-{version}(-{build})?-{python}-{abi}-{platform}.whl

- 举个例子：

		tensorflow-2.3.1-cp36-cp36m-macosx_10_9_x86_64.whl

	- tensorflow是包名（dist）。
	- 2.3.1是包的版本号（version）。
	- cp36是对python解释器和版本的要求（python）。cp指的是CPython解释器，35指的是版本3.5的Python。比如你拿JPython解释器，这个包就不能用了。
	- cp36m是ABI的标签（python）。ABI即应用二进制接口（Application Binary Interface）。这个一般来说我们不用关心。
	- macosx_10_9_x86_64是平台标签（platform），告诉我们这个包是为macOS操作系统的，使用10.9的macOS developer SDK编译，适用于x86-64指令集。
- 再举个例子：

		requests-2.7.0-py2.py3-none-any.whl (470.6 kB)

	- py2.py3告诉我们这个包对Python2和3都能支持。
	- none是ABI标签，在这里是没有，也不用考虑。
	- any是平台，意味着这个包在任何平台上都能用。
	- 一般如果遇上py2.py3-none-any结尾的whl包，那说明这个包是通用wheel包（universal wheel）——对Python版本、ABI和平台都没有要求。
- 还有个例子：

		tensorflow-2.3.1-cp35-cp35m-manylinux2010_x86_64.whl

	- manylinux是一个比较有意思的平台标签。鉴于Linux系统有不同的发行版（Ubuntu，CentOS，Fedora等等），而你的包里有需要编译的C/C++代码，那有可能不同Linux发行版就不能运行你的包了，而为每个Linux发行版生成一个wheel又太麻烦，所以就诞生了manylinux系列标签：manylinux1（PEP513），manylinux2010（PEP571）和manylinux2014（PEP599）。
	- manylinux标签的核心是一个CentOS的Docker镜像，打包了一些编译器套件、多版本Python和pip、动态库等来确保兼容性。这个在PEP513里面有提到。
- wheel包的好处
	- 安装快；
	- 一般比源发行版体积小很多。比方说matplotlib，它的wheel包最大只有11.6MB，而源码却有37.9MB。网络传输的压力显然是wheel小；
	- 免除了setup.py的执行。setup.py是Python的disutils、setuptools编译机制所需要的文件，需要执行大量的编译、安装工作，如果没有wheel的存在，包的安装、维护都会很麻烦；
	- 不需要编译器。pip在下载时帮你确定了版本、平台等信息；
	- 使用wheel的话，pip自动为你生成.pyc文件，方便Python解释器的读取。
- `pip wheel` 命令使用:https://pip.pypa.io/en/stable/cli/pip_wheel/
