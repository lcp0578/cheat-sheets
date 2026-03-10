## windeployqt
- The Windows deployment tool windeployqt is designed to automate the process of creating a deployable folder containing the Qt-related dependencies (libraries, QML imports, plugins, and translations) required to run the application from that folder. It creates a sandbox for Universal Windows Platform (UWP) or an installation tree for Windows desktop applications, which can be easily bundled into an installation package.  
- https://doc.qt.io/qt-5/windows-deployment.html
- 找到与自己工程使用的编译器版本一致的目录下，并将该目录设置为环境变量；以保证在cmd中可以直接输入windeployqt以找到windeployqt.exe。
- windeployqt.exe是Qt自带的Windows平台发布工具，它可以自动为一个应用程序复制其运行所需的各种库文件、插件和翻译文件，生成可发布的目录。
- Warning: Cannot find Visual Studio installation directory, VCINSTALLDIR is not set.
	- 意思是说，因为我们没有运行vcvarsall.bat，所以VS的环境变量没有配置好，所以不会拷贝VS相关的依赖库。
	- vcvarsall.bat是VS的自带的配置环境变量的批处理文件

			"D:\Program Files (x86)\Microsoft Visual Studio\2019\Community\VC\Auxiliary\Build\vcvars64.bat"
			**********************************************************************
			** Visual Studio 2019 Developer Command Prompt v16.11.10
			** Copyright (c) 2021 Microsoft Corporation
			**********************************************************************
			[vcvarsall.bat] Environment initialized for: 'x64'