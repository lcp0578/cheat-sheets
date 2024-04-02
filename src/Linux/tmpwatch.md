##  tmpwatch/tmpreaper 删除旧文件
- 默认情况下，tmpwatch 会根据文件的 atime（访问时间）而不是 mtime（修改时间）删除文件。
- 运行以下命令以递归方式删除过去 5 个小时未访问的文件。

		# tmpwatch 5 /tmp
