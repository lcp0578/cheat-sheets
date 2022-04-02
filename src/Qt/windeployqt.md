## windeployqt
> The Windows deployment tool windeployqt is designed to automate the process of creating a deployable folder containing the Qt-related dependencies (libraries, QML imports, plugins, and translations) required to run the application from that folder. It creates a sandbox for Universal Windows Platform (UWP) or an installation tree for Windows desktop applications, which can be easily bundled into an installation package.  
> https://doc.qt.io/qt-5/windows-deployment.html
- 找到与自己工程使用的编译器版本一致的目录下，并将该目录设置为环境变量；以保证在cmd中可以直接输入windeployqt以找到windeployqt.exe。
- 会解决依赖关系，复制dll与其他必要文件。