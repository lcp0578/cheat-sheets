## git push 上传大文件卡住或无法push到远程仓库
- Total 564 (delta 6), reused 0 (delta 0), pack-reused 0
	- 修改配置

			git config --global sendpack.sideband false
			git config --local sendpack.sideband false
			git config --global http.postBuffer 524288000
			git config --global https.postbuffer 524288000
- push报错`! [remote rejected] master -> master (pre-receive hook declined)`
	- 查看大文件是哪个

			git rev-list --objects -all | grep 提交ID
	- 从commit的提交历史中删除指定文件的命令为
	
			git filter-branch --tree-filter 'rm -f 文件名' HEAD
	- 重新push。