## git 还原代码
- reset
	- 查看提交记录(查找commit id)
	
    		git log
    - 回滚到某个提交ID
    
    		git reset --hard commit_id
    - 强制提交
    
    		git push origin master -f
- checkout
	
    	git checkout commit_id