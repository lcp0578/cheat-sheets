## cgo
> https://studygolang.com/articles/10163

- 常见错误
	- `cc1.exe: sorry, unimplemented: 64-bit mode not compiled in`
		go环境：go.1.2.windows-amd64
		mingw安装是32位。
		在用go调C相关的时候，编译报cc1.exe: sorry, unimplemented: 64-bit mode not compiled in.网上查了大部分资料说，需要将mingw32换成mingw64.
		You are using 64-bit version of Go. You must use 64-bit gcc compiler.