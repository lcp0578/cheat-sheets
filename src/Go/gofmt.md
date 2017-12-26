## gofmt VS go fmt
### gofmt

	$ gofmt --help // or go doc cmd/gofmt
	usage: gofmt [flags] [path ...]
	  -cpuprofile string
	        write cpu profile to this file
	  -d    display diffs instead of rewriting files
	  -e    report all errors (not just the first 10 on different lines)
	  -l    list files whose formatting differs from gofmt's
	  -r string
	        rewrite rule (e.g., 'a[b:len(a)] -> a[b:]')
	  -s    simplify code
	  -w    write result to (source) file instead of stdout

gofmt的参数介绍

- -l 显示那些需要格式化的文件
- -w 把改写后的内容直接写入到文件中，而不是作为结果打印到标准输出。
- -r 添加形如“a[b:len(a)] -> a[b:]”的重写规则，方便我们做批量替换
- -s 简化文件中的代码
- -d 显示格式化前后的diff而不是写入文件，默认是false
- -e 打印所有的语法错误到标准输出。如果不使用此标记，则只会打印不同行的前10个错误。
- -cpuprofile 支持调试模式，写入相应的cpufile到指定的文件

示例：

	$ gofmt -w -l logic //go代码目录
	logic\SendcloudLogic.go

### go fmt
	
	$ go help fmt //or go fmt --help
	usage: go fmt [-n] [-x] [packages]
	
	Fmt runs the command 'gofmt -l -w' on the packages named
	by the import paths. It prints the names of the files that are modified.
	
	For more about gofmt, see 'go doc cmd/gofmt'.
	For more about specifying packages, see 'go help packages'.
	
	The -n flag prints commands that would be executed.
	The -x flag prints commands as they are executed.
	
	To run gofmt with specific options, run gofmt itself.
	
	See also: go fix, go vet.



使用go fmt命令，其实是调用了gofmt  

- 打印将要执行的命令

		$ go fmt -n github.com/lcp0578/smart_lock
		C:\Go\bin\gofmt.exe -l -w main.go

- 打印出执行的命令

		$ go fmt -x github.com/lcp0578/smart_lock
		C:\Go\bin\gofmt.exe -l -w main.go
