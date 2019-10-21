## Go Module Proxy
- 使用 Go modules 时，如果向干净的缓存的计算机上添加新依赖项或构建 Go module，它将基于 go.mod 将下载（go get）所有依赖项，并将其缓存以供进一步操作。
- 你也可以使用 -mod=vendor 参数构建 vendor 文件夹，来绕过缓存，以及后边使用这些下载的依赖。
- 使用 Go module proxy 的好处  
	默认情况下， go 命令会直接从版本管理系统下载代码。GOPROXY 环境变量允许在下载源的进一步控制。配置该环境变量后，go 命令可以使用 Go module proxy。
	- Go module proxy 默认永久缓存所有依赖（不可变存储）。这意味着，不必再使用 vendor 文件夹。
	- 抛弃 vendor 文件夹，它将不会再消耗代码库的空间。
	- 因为依赖项存储在 不可变存储 中，即使依赖项从网上消失，你的代码也会受到保护。
	- 一旦 Go module（依赖） 存储在 Go proxy 中，就无法覆盖或删除它。这可以保护你免受可能使用相同版本注入恶意代码的攻击。
	- 你不再需要任何 VSC 工具来下载依赖项，因为依赖项是通过 HTTP 获取的（ Go proxy 在后台使用 HTTP）。
	- 下载和构建 Go module 的速度要快得多，因为 Go proxy 通过 HTTP 独立提供源代码（.zip 存档）go.mod。与从 VCS 获取相比，由于更少的开销，这使得下载花费更少的时间。相比之前它必须获取整个存储库，解决依赖关系也更快，因为 go.mod 可以独立获取。Go 官方团队对它进行了测试，他们看到快速网络上的速度提高了 3 倍，而慢速网络则提高了 6 倍！
	- 你可以轻松运行自己的 Go proxy ，这可以让你更好地控制构建管道的稳定性，并防止 VCS 关闭时的罕见情况。
- 使用 Go module proxy
	- 如果没有设置 GOPROXY，将其设置为空或设置为 direct ，然后 go get 将直接到 VCS（例如 github.com）拉取代码
    - 可以开始使用公共 GOPROXY 。你也可以选择使用 Go 官方团队的 GOPROXY（由 Google 运营）。更多信息可以在这里找到：https：//proxy.golang.org/，要开始使用它，你只需设置环境变量：
            
            GOPROXY=https://proxy.golang.org
            #其他可用的公共代理：
            GOPROXY=https://goproxy.io
            GOPROXY=https://goproxy.cn # proxy.golang.org 被墙了, 这个没有
	- 你可以传入 file:/// 路由。因为 Go module proxy 是响应 GET 请求（没有查询参数）的 Web 服务器，所以任何文件系统中的文件夹都可以用作 Go module proxy。
- Go 1.13 的变化
	- 在 GOPROXY 环境变量现在可以设置为逗号分隔的列表。它会在回到下一个路径之前尝试第一个代理。
	- GOPROXY 的默认值为 https://proxy.golang.org,direct。设置 direct 后将忽略之后的所有内容。这也意味着 go get 现在将默认使用 GOPROXY 。如果你根本不想使用 GOPROXY，则需要将其设置为 off。
	- 新版本引入了一个新的环境变量 GOPRIVATE ，它包含以逗号分隔的 全局列表。这可用于绕过 GOPROXY 某些路径的代理，尤其是公司中的私有模块（例如: GOPRIVATE=*.internal.company.com）。
