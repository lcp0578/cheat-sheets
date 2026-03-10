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
- 复制已有分支到新分支
	- 检出远程分支。　　

			git checkout -b old-branch origin/old-branch
	- 从当前分支复制出新的分支

 			git checkout -b new-branch
	- 把新建的分支push到远程库

 			git push origin new-branch:new-branch
	- 拉取远程分支

			git pull # 经过验证，当前的分支并没有和本地分支关联，根据提示进行下一步
	- 关联

 			git branch --set-upstream-to=origin/new-branch new-branch
	- 再次拉取，成功

 			git pull
- 相关参考
	- http://blog.csdn.net/wirelessqa/article/details/20153689
	- http://blog.csdn.net/xiruanliuwei/article/details/6919319