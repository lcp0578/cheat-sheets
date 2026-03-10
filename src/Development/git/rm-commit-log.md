## rm commit log
发现有些敏感信息已被提交，删除远端仓库的提交记录

- 查看log

		$ git log
		commit 9016398d05b86fb0048f851ab30208823ba2a23e (HEAD -> master, origin/master)
		Author: lcp0578 <lcp0578@gmail.com>
		Date:   Thu Dec 7 00:45:45 2017 +0800
		
		    [MOD] update readme
		
		commit 50d84b8b7ffee236f5984e906d662280edc9a180
		Author: lcp0578 <lcp0578@gmail.com>
		Date:   Thu Dec 7 00:34:19 2017 +0800
		
		    [MOD] ci && composer
- 回到某个commit id

		$ git reset --hard 50d84b8b7ffee236f5984e906d662280edc9a180
		HEAD is now at 50d84b8 [MOD] ci && composer
- 推送到远端仓库

		$ git push origin HEAD --force
		Total 0 (delta 0), reused 0 (delta 0)
		To https://github.com/lcp0578/CodeIgniter-Composer.git
		 + 9016398...50d84b8 HEAD -> master (forced update)

