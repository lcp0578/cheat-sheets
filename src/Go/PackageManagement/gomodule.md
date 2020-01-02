## Go Module
- 前言  
   随着 go1.11 的发布，go 官方引入了 go module 来解决依赖管理问题，go module 被集成到原生的 go cmd 中，但是如果你的代码库在$GOPATH中，go1.11 的 module 功能是默认不会开启的，想要开启也非常简单, 通过一个环境变量即可开启go module：`export GO111MODULE=on`。
- GO111MODULE 行为变化
	- 在Go 1.12版本中，GO111MODULE默认值为auto，在auto模式下，GOPATH/src下面的repo以及在GOPATH之外的repo依旧使用GOPATH mode，不使用go.mod来管理依赖；
	- 在Go 1.13中，module mode优先级提升，GO111MODULE的默认值依然为auto，但在这个auto下，无论是在GOPATH/src下还是GOPATH之外的repo中，只要目录下有go.mod，go编译器都会使用go module来管理依赖。
- GO111MODULE
	go mod 可以通过GO111MODULE来控制是否启用，GO111MODULE有一下三种类型。
	- on 所有的构建，都使用Module机制
	- off 所有的构建，都不使用Module机制，而是使用GOPATH和Vendor
	- auto 在GOPATH下的工程，不使用Module机制，不在GOPATH下的工程使用
- `go mod` 命令
	- `go mod help`查看帮助
	- `go mod init <项目模块名称> `初始化模块，会在项目根目录下生成 go.mod文件。
	- `go mod tidy`根据go.mod文件来处理依赖关系。
	- `go mod vendor`将依赖包复制到项目下的 vendor目录。建议一些使用了被墙包的话可以这么处理，方便用户快速使用命令go build -mod=vendor编译
	- `go list -m all`显示依赖关系。`go list -m -json all`显示详细依赖关系。
	- `go mod download <path@version>`下载依赖。参数<path@version>是非必写的，path是包的路径，version是包的版本。
- `go.mod` & `go.sum`
	- 在项目目录下执行`go mod tidy`下载完成后项目路径下会生成go.mod和go.sum
	- go.mod文件必须要提交到git仓库，但go.sum文件可以不用提交到git仓库(git忽略文件.gitignore中设置一下)。
- 处理被墙的包
	- replace
	
    		replace golang.org/x/crypto => github.com/golang/crypto v0.0.0-20190320223903-b7391e95e576

            replace golang.org/x/net => github.com/golang/net v0.0.0-20190320064053-1272bf9dcd53

            replace google.golang.org/appengine => github.com/golang/appengine v1.6.0

            replace golang.org/x/sys => github.com/golang/sys v0.0.0-20190215142949-d0b11bdaac8a

            replace golang.org/x/text => github.com/golang/text v0.3.0
	- [goproxy](goproxy.md)
- 引用本地包

        require (
            test v0.0.0
        )

        replace (
         test => ../test
        )

        注意:1.引入的包必须也是gomod的(有.mod文件)
            2.replace时必须使用相对路径比如../ ./
            3.require 的包后必须带版本号,replace中可带可不带

