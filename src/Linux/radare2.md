## 逆向工程工具集 radare2
- https://github.com/radareorg/radare2
- UNIX-like reverse engineering framework and command-line toolset.
- https://www.radare.org/n/radare2.html
- 基础使用流程
	- 打开文件

			r2 /path/to/binary
	- 自动分析文件，进阶分析：aaa（更全面）或 aaaa（深度分析）

			[0x00400000]> aa   # 分析所有函数和符号
			

	- 查看入口点

			[0x00400000]> ie   # 显示程序入口点
	- 列出函数

			[0x00400000]> afl   # 列出所有函数
	- 反汇编函数

			[0x00400000]> pdf @ main     # 反汇编 main 函数
			[0x00400000]> pdf @ sym.vuln # 反汇编名为 vuln 的函数
	- 查看字符串

			[0x00400000]> izz   # 提取所有字符串
			[0x00400000]> izzq  # 简洁模式显示字符串
