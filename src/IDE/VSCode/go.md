## go 环境配置
- 安装插件报错

		package golang.org/x/tools/imports: directory "src/golang.org/x/tools/imports" is not using a known version control system
解决办法：src/golang.org/x 下的tools/lint从github获取的最新版本(注意一定要是git clone)，
       