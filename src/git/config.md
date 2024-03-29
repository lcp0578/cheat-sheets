## git config 配置
- git配置级别主要有以下3类：
	- 仓库级别 local 【优先级最高】，对应的配置文件是当前仓库下的`.git/config`
	- 用户级别 global【优先级次之】，用户宿主目录下的`~/.gitconfig`
	- 系统级别 system【优先级最低】，git安装目录下的 `/etc/gitconfig`
- 查看配置
	- `git config --local -l` 查看仓库配置
	- `git config --global -l` 查看用户配置
	- `git config --system -l` 查看系统配置
	- `git config -l`查看所有的配置信息，依次是系统级别、用户级别、仓库级别
- git config 常用配置选项
	- git config -e 编辑配置文件 
		- `git config --local -e` 编辑仓库级别配置文件
		- `git config --global -e` 编辑用户级别配置文件
		- `git config --system -e` 编辑系统级别配置文件
	- git config 添加配置项目 
		- `git config --global user.email you@example.com`
		- `git config --global user.name Your Name`
	- 删除一个配置项
		- 命令参数 –unset
		- 格式：`git config [--local|--global|--system] --unset section.key`
- 关闭ssl验证
	- 永久关闭

			git config --global http.sslVerify false
	- 单次不验证

			git -c http.sslVerify=false clone https://localhost/xxx/xxx.git