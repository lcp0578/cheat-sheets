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
	- auto Go 1.11中在GOPATH下的工程，不使用Module机制，不在GOPATH下的工程使用
- `go mod` 命令
	- `go mod help` 查看帮助
	- `go mod init <项目模块名称> `初始化模块，会在项目根目录下生成 go.mod文件。
	- `go mod tidy` 根据go.mod文件来处理依赖关系。
	- `go mod edit` 命令行中编辑go.mod
	- `go mod vendor` 将依赖包复制到项目下的 vendor目录。建议一些使用了被墙包的话可以这么处理，方便用户快速使用命令`go build -mod=vendor`编译(因为在 go modules 模式下 `go build` 是屏蔽 vendor 机制的，所以需要特定参数重新开启 vendor 机制)
	- `go mod verify` 校验下载到本地缓存中的依赖库自下载后未被修改
	- `go mod why` 解释为什么需要一个依赖库(肯定是有代码使用它了,
	- `go mod download <path@version>`下载依赖。参数<path@version>是非必写的，path是包的路径，version是包的版本。
	- `go clean -modcache` 清除缓存
	- `go list -m all` 显示依赖关系。`go list -m -json all`显示详细依赖关系。
- 使用go mod后，包文件下载到`$GOPATH/pkg/mod`目录中
- 如果想缓存到项目的vendor目录，执行

		go mod vendor //vendor加到.gitignore
- `go.mod` & `go.sum`
	- 在项目目录下执行`go mod tidy`下载完成后项目路径下会生成go.mod和go.sum
	- go.mod文件必须要提交到git仓库，但go.sum文件可以不用提交到git仓库(git忽略文件.gitignore中设置一下)。
- go.mod文件可以通过require，replace和exclude语句使用的精确软件包集。
	- require语句指定的依赖项模块
	- replace语句可以替换依赖项模块
	- exclude语句可以忽略依赖项模块
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
            github.com/lcp0578/api_go/bootstrap v0.0.0-00010101000000-000000000000
        )

        replace (
         github.com/lcp0578/api_go/bootstrap => ./bootstrap
        )

        注意:1.引入的包必须也是gomod的(有.mod文件)
            2.replace时必须使用相对路径比如../ ./
            3.require 的包后必须带版本号,replace中可带可不带
            4.目录不能为v1、v2之类，否则会报invalid path
- go.sum
	- go.sum是一个构建状态跟踪文件。它会记录当前module所有的顶层和间接依赖，以及这些依赖的校验和，从而提供一个可以100%复现的构建过程并对构建对象提供安全性的保证。
	- go.sum同时还会保留过去使用的包的版本信息，以便日后可能的版本回退，这一点也与普通的锁文件不同。所以go.sum并不是包管理器的锁文件。
	- go.sum 的每一行都是一个条目，大致是这样的格式：

            <module> <version> <hash>
            <module> <version>/go.mod <hash>
- GOSUMDB
	- GOSUMDB可以用来校验你下载的库的哈希是否和官方的哈希值是否一样，避免被proxy给修改了，万一proxy给你的下载库加上挖矿代码就惨了，毫无疑问也被墙了，即使专为中国区设置的域名/服务器也被墙。你可以使用goproxy.cn作为GOSUMDB服务器，或者心大使用GOSUMDB=off进行禁用。
	- GOPRIVATE用来设置不使用代理的仓库，比如一些公司内部的仓库等等，如
	
    		GOPRIVATE=*.corp.example.com,rsc.io/private。
- 查看帮助
	- `go help module-auth`了解GOSUMDB和GONOSUMDB变量。
	- `go help goproxy`了解proxy的通讯协议。
	- `go help modules`了解module的功能。
	- `go help module-get`了解go get命令的变化。
    - `go help gopath-get`显示先前的基于GOPATH的go get功能。
	- `go help module-private`了解私有库的设置。
- 延伸阅读
	- https://xuanwo.io/2019/05/27/go-modules/
	- https://research.swtch.com/vgo
