## git note
- [git branch](branch.md)
- [git tag](tag.md)
- 删除远端仓库的文件

		git rm --cached "/path/filename" //不物理删除，仅将该文件从缓存中删除，再commit push即可
		git rm -f "/path/filename" //缓存和物理都删除，且不会回收到垃圾桶