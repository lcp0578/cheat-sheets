## kill
- 批量杀进程

		ps -ef | grep firefox | grep -v grep | awk '{print "kill -9 "$2}'|sh

	- 列出了当前主机中运行的进程中包含firefox关键字的进程
	
			ps -ef | grep firefox | grep -v grep    
	 
	- 列出了要kill掉这些进程的命令，并将之打印在了屏幕上 
	
			ps -ef | grep firefox | grep -v grep | awk '{print "kill -9 "$2}'
	 
	- 后面加上|sh后，则执行这些命令，进而杀掉了这些进程
	
			ps -ef | grep firefox | grep -v grep | awk '{print "kill -9 "$2}' | sh

- 批量杀掉筛选的进程

		ps -ef | grep test | grep -v grep | awk '{print $2}' | xargs kill -9 
	其中： 
	- `|` 管道符，用来隔开两个命令，管道符左边命令的输出会作为管道符右边命令的输入。 
	- `ps` 命令用来列出系统中当前运行的进程， `ps -ef` 显示所有进程信息，联通命令行。 
	- `grep` 命令用于过滤/搜索特定字符，`grep test` 在这里为搜索过滤所有含有‘test’名称的进程 
	- `grep -v grep` 中的 `-v` 显示不包含匹配文本的所有行，在这里为筛选出所有不包含`grep`名称的进程(即剔除出自身命令)，对上一步的进程再做一次筛选(因为`ps -ef`列出了所有的命令，包括命令行) 
	- `awk` 在文件或字符串中基于指定规则浏览和抽取信息；把文件逐行读入，以空格为默认分隔符将每行切片，然后再进行后序处理。这里利用`awk '{print $2}'`将上一步中过滤得到的进程进行打印，$2表示打印第二个域(PID，进程号) $0表示所有域,$1表示第一个域，$n表示第n个域。 
	- `xargs` 命令是给命令传递参数的过滤器，善于把标准数据数据转换成命令行参数。在这里则是将获取前一个命令的标准输出然后转换成命令行参数传递给后面的kill命令。 
	- `kill -9` 强制关闭进程。 