## goproxy
- 关于 $GOPROXY
	- 当我们使用go的时候，go默认会直接从代码库中去下载所需的相关依赖，GOPROXY 这个环境变量可以让我们控制自己从哪里去下载源代码，如果 GOPROXY 没有设置，go 会直接从代码库下载相关依赖代码。如果你像下面这样设置了这个环境变量，那么你就会通过 goproxy.io 下载所有的源代码。

			export GOPROXY=https://goproxy.io

    - 你可以通过置空这个环境变量来关闭，`export GOPROXY=` 。
- goproxy.io 
	- 开源地址：`https://github.com/goproxyio/goproxy`
	- goproxy.io 是一个开源项目，当用户请求一个依赖库时，如果它发现本地没有这份代码就会自动请求源，然后cache到本地，用户就可以从 goproxy.io 请求到数据。当然，这些都是在一个请求中完成的。goproxy.io 只支持 go module 模式。当用户执行 go get 命令时，会去检查$GOPROXY//@v/list这个文件中是否有用户想要获取的版本，如果有，就依次获取 $GOPROXY//@v/.info、$GOPROXY//@v/.mod、$GOPROXY//@v/.zip 等文件，如果没有就直接从源码库中去下载。

	- 得益于 go module 在设计的时候非常重视安全这个领域，所以在启用了 go module 后，你会发现除了 go.mod 这个文件之外，还有一个 go.sum 文件，这个文件保存了每个依赖库的对应的hash值，来保证下载回来的代码库是正确的，不被人篡改的。同时， goproxy.io 也是个开源的项目。可以自行部署到自己的IDC中，因为公司内部自己的代码库 goproxy.io 是无法访问到的。