## git lfs
- Github的坑：流量、存储空间，需要联系Github技术支持清除lfs的文件
- 查看跟踪的文件

		 git lfs ls-files --all --long
- 使用bfg工具删除文件https://rtyley.github.io/bfg-repo-cleaner/

		java -jar bfg-1.14.0.jar --delete-files 'xxxx.pdf' .git

- 重新构建

		git reflog expire --expire=now --all && git gc --prune=now --aggressive
- 强制提交

		git push -f