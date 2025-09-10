## file2pdf（使用unoconv）
#### 新办法（Ubuntu）
- 安装unoconv和LibreOffice

		sudo apt install unoconv libreoffice
- 安装Times New Roman字体

		sudo apt install ttf-mscorefonts-installer
- 安装宋体字体
	- 在windows电脑上，`C:\Windows\Fonts`里面找到“宋体 常规”复制到一个目录，文件名为：`simsun.ttc`
	- 配置

			# 创建字体目录 (可根据习惯选择其他目录，如 /usr/share/fonts/truetype/)
			sudo mkdir -p /usr/share/fonts/opentype/simsun/
			# 复制宋体文件到该目录，假设文件名为 simsun.ttc
			sudo cp ~/Downloads/simsun.ttc /usr/share/fonts/opentype/simsun/
			# 更改权限
			sudo chmod 644 /usr/share/fonts/opentype/simsun/simsun.ttc
- 刷新字体缓存并验证
	- 安装完字体后，必须更新系统的字体缓存才能使新字体生效

			sudo fc-cache -fv
	- 验证

			# 检查Times New Roman
			fc-list | grep -i "times"
			# 检查宋体 (查找SimSun或宋体)
			fc-list | grep -i "simsun"
			fc-list | grep -i "宋体"
			# 或者列出所有已安装的中文字体
			fc-list :lang=zh
#### 旧办法
- jdk
	- 下载地址：https://www.oracle.com/technetwork/java/javase/downloads/index.html
	- 安装:
	
    		rpm -ivh jdk-11_linux-x64_bin.rpm
- openoffice(依赖jdk)
- unoconv
	- 下载rpm包：http://www.rpmfind.net/linux/rpm2html/search.php?query=unoconv
	- 安装rpm
- gotenberg服务[暂时不用]
	- 项目地址：https://github.com/thecodingmachine/gotenberg
	- [配置文件示例](gotenberg.yml)