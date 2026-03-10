## PDB文件说明
> https://docs.microsoft.com/zh-cn/visualstudio/debugger/specify-symbol-dot-pdb-and-source-files-in-the-visual-studio-debugger?view=vs-2022


- 程序数据库 ( .pdb) 文件（也称为符号文件）将项目源代码中的标识符和语句映射到已编译应用中的相应标识符和说明。 这些映射文件将调试器链接到源代码，以进行调试。
- 符号文件的工作方式
	- .pdb 文件保存调试和项目状态信息，使用这些信息可以对应用的调试配置进行增量链接。 在调试时，Visual Studio 调试器使用 .pdb 文件来确定两项关键信息：
		- 要在 Visual Studio IDE 中显示的源文件名和行号。
		- 在应用中停止的断点位置。
	- 符号文件还会显示源文件的位置，以及要从中检索它们的服务器（可选）。
	- 调试器只会加载与在生成应用时创建的 .pdb 文件完全匹配的 .pdb 文件（即原始 .pdb 文件或副本） 。 这样的完全重复是必需的，因为即使代码本身未更改，应用的布局也可能会更改。