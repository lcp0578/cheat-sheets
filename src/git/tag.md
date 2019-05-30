## git tag
- 创建标签
	- 创建轻量标签
	
    		git tag v0.3.2
	- 创建附注标签
	
    		git tag -a v0.3.4 -m "tag comment"
- 查看标签
	- 列出当前仓库所有标签

			git tag
    - 查看标签版本信息
    
    		git show v0.3.2
- 切换标签

		git checkout v0.3.2 //切换标签后处于一个空的分支上，即You are in ‘detached HEAD’ state.
- 删除标签

		git tag -d v0.3.2
        //推送到远端
        git push origin :refs/tags/v0.3.2
        To https://github.com/kitlabs-cn/KitCryptBundle.git
         - [deleted]         v0.3.2
- 补打标签

		git tag -a v0.3.3 9e768cd048356937ac7dd32e58dde42e64c3bf84 //给指定的commit打标签，查看提交ID通过git log
- 发布标签
	- 发布某个标签
	
			git push origin v0.3.2
    - 将本地所有标签一次性发布
    
    		git push origin --tags