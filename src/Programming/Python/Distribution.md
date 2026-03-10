## Python发行版
- Python编译器
	- CPython
		- 标准Python的解释型编译器。
		- IPython：基于CPython的一个交互式解释器，也就是说，IPython只是在交互方式上有所增强，但是执行Python代码的功能和CPython是完全一样的。
	- Jython
		- 使用Java模块可以和Java无缝集成。Jython可以被动态或静态地编译成Java字节码。解释型编译器。
	- PyPy
		- 基于Python编译器子集RPython实现的python。动态编译型编译器
	- IronPython
		- 运行在微软.Net平台上的Python解释器，可以直接把Python代码编译成.Net的字节码。
- 常用Python版本
	- CPython，一般我们所说的python默认是指这个发行版本的python现在一般用2.7/3.6。这个版本只提供标准库，第三方库需要自己用pip命令安装。
		- Mac下安装位置：`/Library/Frameworks/Python.framework/Versions/3.8`
	- Anaconda，这个发行版的Python是科学计算及研究中经常使用到的发行版Python，这个发行版Python会自动集成很多方便易用和常用的第三方库。
		- 安装了Anaconda，就安装了Python+NumPy+SciPy+Matplotlib+IPython+IPython Notebook。IPython Notebook是比较常见结合PyCharm开发使用的工具。
		- Mac下安装位置：`/Users/lcp0578/opt/anaconda3`

