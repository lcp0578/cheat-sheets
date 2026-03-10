## dumpbin、Dependencies查看dll的附加依赖项
#### VS的dumpbin
- visual studio编译器自带有dumpbin工具，可以通过它查看exe或者dll的依赖项。通过开始菜单打开vs命令行工具。

		dumpbin.exe /dependents filename.exe
#### lucasg/Dependencies
- 开源版的现代 Dependency Walker.
- https://github.com/lucasg/Dependencies
- 下载解压后，找到 `DependenciesGui.exe` 打开软件。命令行使用则用 `Dependencies.exe`。
- Dependency Walker（过时）此软件在 Windows 10 下分析任何 exe 都会进入未响应状态，无法使用。