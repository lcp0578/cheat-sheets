## git banch
- 列出本地已存在分支

		git branch
- 列出远程分支

		git branch -r
- 列出本地分支和远程分支

		git branch -a
- 拉取远程某个分支到本地，需要本地分支和远程分支建立映射关系
执行如下命令：

		git checkout -b 本地分支xxx  origin/远程分支xxx

	使用这种方式会在本地仓库新建本地分支xxx，并自动切换到新建的本地分支xxx，当然了远程分支xxx的代码也拉取到了本地分支xxx中。采用这种方法建立的本地分支会和远程分支建立映射关系。

http://blog.csdn.net/wirelessqa/article/details/20153689

http://blog.csdn.net/xiruanliuwei/article/details/6919319