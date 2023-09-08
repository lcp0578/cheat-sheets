## git note
- [git branch](branch.md)分支相关
- [git tag](tag.md)标签相关
- [rm commit log](rm-commit-log.md)
- [git config 配置](config.md)
- [git ssh](git_ssh.md) git ssh配置
- [fork sync](fork_sync.md) fork仓库与原仓同步
- [Github访问或clone慢配置](github.md) Github 
- [Github Help 使用技巧](github_help.md)
- [Github token凭据配置](github_token.md)
- [Git update](update.md) git升级
- [rm git index](rm.md) 移除文件或目录的git索引
- [git recover](git_recover.md) git还原某个提交ID
- [git moji](https://gitmoji.carloscuesta.me/)
- [git_stats](git_stats.md) git提交统计
- [git reset 撤销本地commit](reset.md)
- 删除远端仓库的文件

		git rm --cached "/path/filename" //不物理删除，仅将该文件从缓存中删除，再commit push即可
		git rm -f "/path/filename" //缓存和物理都删除，且不会回收到垃圾桶