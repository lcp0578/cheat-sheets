## MSVC编译器介绍
#### MSVC简介：
- 与Linux系列操作系统不同，Windows原生环境不提供类似gcc，Clang的C/C++语言源程序编译运行工具链。运行在Windows上的IDE（集成开发环境），比如CodeBlocks之类，一般都使用MinGW（Minimalist GNU for Windows）配置模拟Linux下的开发环境来进行Windows下的开发。
- 但是在Windows下，与开发环境以及code编辑器协同更好的还是MSVC（Microsoft Visual C/C++）编译器。对于灵活程度更高的code编辑器，我们可以将Microsoft的Visual C/C++编译器下载并集成到code中。
- MSVC编译器工具链主要由cl.exe与link.exe构成。其中：
	- `cl.exe`用于控制在 Microsoft C/C++的编译器和链接器
	- `link.exe` 将通用对象文件格式 (COFF) 对象文件和库链接起来，以创建可执行 (.exe) 文件或动态链接库 (DLL)
	- 用户只需要调用`cl.exe`，即可完成编译-链接全过程。
#### 如何获取MSVC：
- 一般来说，获取MSVC要通过Microsoft Visual Studio来实现。对于一般的应用场景来说，我们不需要下载完整的IDE而是只需要下载单个组件下的MSVC C++ 生成工具，以及Windows 10 SDK即可。
	- MSVC C++生成工具包含了全部编译链接工具链以及大部分函数库与头文件；
	- Windows 10 SDK只是提供其它的一些必要库文件与头文件
- 在下载与安装完成之后，会在PC上生成两个目录：
（一般是在“C:\Program Files (x86)”中生成这两个目录）
	- 一个是Windows Kits目录，其中包含所有的Windows 10 SDK文件。
	- 一个是Microsoft Visual Studio目录，其中包含MSVC的全部编译链接工具链以及大部分函数库与头文件。