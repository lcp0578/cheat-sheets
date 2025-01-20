## git_stats
> GitStats is a git repository statistics generator. It browses the repository and outputs html page with statistics.

- 安装
		gem install git_stats
- 加入环境变量
	/usr/local/Homebrew/lib/ruby/gems/2.6.0/bin
- 指定生成目录生成统计信息
	
    	git_stats generate -o /Users/lcp0578/htdocs/workspace2020/git_stats/sfcms
- 另一种计算方法

		git log --format='%aN' | sort -u | while read name; do echo -en "$name\t"; git log --author="$name" --pretty=tformat: --numstat | awk '{ add += $1; subs += $2; loc += $1 - $2 } END { printf "added lines: %s, removed lines: %s, total lines: %s\n", add, subs, loc }' -; done