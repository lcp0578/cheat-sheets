## git note
- [git branch](branch.md)分支相关
- [git tag](tag.md)标签相关
- [rm commit log](rm-commit-log.md)
- [git ssh](git_ssh.md) git ssh配置
- [fork sync](fork_sync.md) fork仓库与原仓同步
- [Github](github.md) Github clone慢配置
- [Git update](update.md) git升级
- [rm git index](rm.md) 移除文件或目录的git索引
- [git recover](git_recover.md) git还原某个提交ID
- 删除远端仓库的文件

		git rm --cached "/path/filename" //不物理删除，仅将该文件从缓存中删除，再commit push即可
		git rm -f "/path/filename" //缓存和物理都删除，且不会回收到垃圾桶