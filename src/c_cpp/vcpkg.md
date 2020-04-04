## vcpkg
- vcpkg简介
	- Vcpkg helps you manage C and C++ libraries on Windows, Linux and MacOS.
	- vcpkg是命令行包管理工具，在使用第三方库的c或c++开发中可以简化相关的配置操作。vcpkg安装的包支持vs2015和vs2017工具集。
- vcpkg支持众多架构
	- arm-uwp
	- arm-windows
	- arm64-uwp
	- arm64-windows
	- x64-linux
	- x64-osx
	- x64-uwp
	- x64-windows
	- x64-windows-static
	- x86-uwp
	- x86-windows
	- x86-windows-static。
- 安装见[github.com/microsoft/vcpkg](https://github.com/microsoft/vcpkg)
- 常用命令
	- 搜索想要安装的包

			vcpkg search curl

	- 安装指定的包，curl包分号后面的表示架构

			vcpkg install curl:x64-windows

	- 列出已经安装的包

			vcpkg list

	- 已安装的包更新

			vcpkg upgrade

	- 删除已安装的包

			vcpkg remove curl:x64-windows
- visual studio 2017中使用vcpkg安装的包
	- 要在visual studio 2017中正确使用已安装的包，需要将头文件目录和相关的库在正确的设置。方便的是，vcpkg提供了直接的配置命令。
	- 为每一个用户设置

			vcpkg integrate install

	- 为当前项目配置，这里需要在该项目的目录下拥有一份vcpkg的拷贝

			vcpkg integrate project