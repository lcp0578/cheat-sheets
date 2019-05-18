## Package Management 包管理
- go get
	> 直接访问的master分支的代码，没有指定的version、branch或者revision的能力，依赖代码容易受不兼容代码影响。
- godep

	> 将项目当前依赖包的版本信息记录在Godeps/Godeps.json中，并将依赖包的相关版本存放在Godeps/_workspace中。
    在编译时(godep go build)godep通过临时修改GOPATH环境变量的方法让go编译器使用缓存在Godeps/_workspace下的项目依赖的特定版本的第三方包，这样保证了项目不再受制于依赖的第三方包的master branch上的latest代码的变动。
- gd
- glide
- dep
	- 安装
	
    		# go get -u github.com/golang/dep/cmd/dep
    - 查看帮助
    
    		# dep help
                Dep is a tool for managing dependencies for Go projects

                Usage: "dep [command]"

                Commands:

                  init     Set up a new Go project, or migrate an existing one
                  status   Report the status of the project's dependencies
                  ensure   Ensure a dependency is safely vendored in the project
                  version  Show the dep version information
                  check    Check if imports, Gopkg.toml, and Gopkg.lock are in sync

                Examples:
                  dep init                               set up a new project
                  dep ensure                             install the project's dependencies
                  dep ensure -update                     update the locked versions of all dependencies
                  dep ensure -add github.com/pkg/errors  add a dependency to the project

                Use "dep help [command]" for more information about a command.
	- 常用命令
		- `dep init -v` 初始化
		- `dep ensure` 构建vendor和同步包
		- `dep status` 查看状态
		- ·dep ensure -update· 修改Gopkg.toml版本约束后，更新包
- go module(Go > 1.11)
	- https://blog.csdn.net/cnwyt/article/details/85695947
	- https://blog.csdn.net/guoguolifang/article/details/88974747
	- https://www.jianshu.com/p/bbed916d16ea
	- https://www.cnblogs.com/apocelipes/archive/2018/08/25/9534885.html