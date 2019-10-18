## portability 可移植性
> https://tonybai.com/2017/06/27/an-intro-about-go-portability/
> https://www.jisec.com/application-development/753.html 交叉编译
> CGO_ENABLED=0 GOOS=linux GOARCH=amd64 go build main.go
> https://tonybai.com/2014/10/20/cross-compilation-with-golang/

- 交叉编译
	- Mac 下编译 Linux 和 Windows 64位可执行程序

            CGO_ENABLED=0 GOOS=linux GOARCH=amd64 go build main.go
            CGO_ENABLED=0 GOOS=windows GOARCH=amd64 go build main.go

	- Linux 下编译 Mac 和 Windows 64位可执行程序

            CGO_ENABLED=0 GOOS=darwin GOARCH=amd64 go build main.go
            CGO_ENABLED=0 GOOS=windows GOARCH=amd64 go build main.go

	- Windows 下编译 Mac 和 Linux 64位可执行程序

            SET CGO_ENABLED=0
            SET GOOS=darwin
            SET GOARCH=amd64
            go build main.go