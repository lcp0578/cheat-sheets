## 升级系统版本、禁用SIP、设置屏幕比例、修改显存
- 从10.11.x升级到10.12.6
	- 找到系统下载链接
		- https://itunes.apple.com/us/app/macos-sierra/id1127487414?mt=12
		- 打不开请翻墙
	- 下载完成后提示，“安装 macOS xxxx”应用程序副本已损坏，不能用来安装macOS”
		- 查找系统发布的版本，使用`date`命令修改系统时间
- [ Mac App Store command line interface, 命令行版APP Store](https://github.com/mas-cli/mas)
- 禁用SIP
	- 重启电脑，按 `Command + R`进入恢复分区，在实用工具栏进入终端
	- 相关命令
	
    		$ csrutil status //查看状态. enable为开启保护状态
            $ csrutil disable //关闭
			$ csrutil enable //开启
- 设置屏幕比例
	- 简单办法，使用SwitchResX软件设置。
	- 手动修改配置
		- 查询显示器的VendorID和ProductID（使用SwitchResX查看）
		- 配置文件目录：`/System/Library/Displays/Contents/Resources/Overrides/`
		- 配置文件：`DisplayVendorID-xxxx/DisplayProductID-xxxx`,示例：LG ultrawide，为`DisplayVendorID-1e6d/DisplayProductID-59f1`
		- 使用生成对应分辨率的配置文件
			- https://comsysto.github.io/Display-Override-PropertyList-File-Parser-and-Generator-with-HiDPI-Support-For-Scaled-Resolutions/
			- DisplayProductID-59f1,分辨率：2560*1080
			
            		<?xml version="1.0" encoding="UTF-8"?>
                    <!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
                    <plist version="1.0">
                    <dict>
                        <key>DisplayProductID</key>
                        <integer>23025</integer>
                        <key>DisplayProductName</key>
                        <string>LG ULTRAWIDE 29UM57</string>
                        <key>DisplayVendorID</key>
                        <integer>7789</integer>
                        <key>SwitchResX backuped settings</key>
                        <dict>
                            <key>DisplayProductID</key>
                            <integer>23025</integer>
                            <key>DisplayVendorID</key>
                            <integer>7789</integer>
                        </dict>
                        <key>dspc</key>
                        <array>
                            <data>
                            tzoAoKA4GkAwIDoAAAAAAAAa
                            </data>
                        </array>
                    </dict>
                    </plist>
- 修改显存
	- Intel HD Graphics 3000 512M 改为 2048 MB
	- 配置文件：`/System/Library/Extensions/AppleIntelSNBGraphicsFB.kext/Contents/MacOS`
	- 备份配置文件，`AppleIntelSNBGraphicsFB`
	- 使用perl命令修改`sudo perl -pi -e 's|\xC7\x45\xBC\x00\x00\x00\x20|\xc7\x45\xBC\x00\x00\x00\x80|g' AppleIntelSNBGraphicsFB`（如果一直未能生效，请使用iHex软件进行编辑，替换即可）
	- 更新配置文件的修改时间，`sudo touch /S*/L*/Extensions` 
	- 重启电脑
	- PS:显存的参考值
	
    		C7 45 C4 00 00 00 80  //2048MB
            C7 45 C4 00 00 00 40  //1024MB
            C7 45 C4 00 00 00 30  //768MB
            C7 45 C4 00 00 00 20  //512MB
            C7 45 C4 00 00 00 18  //384MB 
            C7 45 C4 00 00 00 10  //256MB
            C7 45 C4 00 00 00 08  //128MB
            C7 45 C4 00 00 00 04  //64MB
            C7 45 C4 00 00 00 02  //32MB
            C7 45 C4 00 00 00 01  //16MB
	- 更新
		- 在10.11时

                查找C7 45 BC 00 00 00 20
                改为C7 45 BC 00 00 00 80

		- 10.12

                查找C7 45 C4 00 00 00 20
                改为C7 45 C4 00 00 00 80

		- 10.13

                查找C7 45 D0 00 00 00 20
                改为C7 45 D0 00 00 00 80