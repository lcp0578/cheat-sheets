### Windows下调用cmd.exe，并隐藏窗口
- 创建manifest文件, 命名：call_cmd.manifest

		<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
        <assembly xmlns="urn:schemas-microsoft-com:asm.v1" manifestVersion="1.0">
        <assemblyIdentity
            version="1.0.0.0"
            processorArchitecture="x86"
            name="controls"
            type="win32"
        ></assemblyIdentity>
        <dependency>
            <dependentAssembly>
                <assemblyIdentity
                    type="win32"
                    name="Microsoft.Windows.Common-Controls"
                    version="6.0.0.0"
                    processorArchitecture="*"
                    publicKeyToken="6595b64144ccf1df"
                    language="*"
                ></assemblyIdentity>
            </dependentAssembly>
        </dependency>
        </assembly>
- 生成syso文件 
	- 引入生成类库
	
    		go get github.com/akavel/rsrc
    - 执行生成命令(准备ico文件)
    
    		rsrc -manifest call_cmd.manifest -ico call_cmd.ico -o main.syso
- 将生成的main.syso文件拷贝到main.go同级目录
- main.go

		package main
        import(
            "fmt"
            "os/exec"
            "syscall"
        )

        func main(){   
            datapath := "http://172.18.1.12"
            cmd := exec.Command("cmd.exe", "/c", "start "+datapath)
            cmd.SysProcAttr = &syscall.SysProcAttr{HideWindow:true} //隐藏DOS窗口
            if err := cmd.Run(); err != nil {
                fmt.Println("Error: ", err)
            }  
        }
- 编译命令

		go build -ldflags -H=windowsgui