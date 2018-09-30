## install fonts 安装字体
- 1.查看/usr/share目录下是否有fonts和fontconfig目录 
如果没有，执行下面指令：

		#yum -y install fontconfig1

执行完该指令后就可以看到fonts和fontconfig目录了

- 2.进入字体目录

		#cd /usr/share/fonts/1

- 3.创建需要安装的字体目录

		#mkdir invoice_needed_font1

- 4.修改invoice_needed_font目录的权限使root用户以外的用户也可以使用

		#chmod -R 755 /usr/share/fonts/invoice_needed_font1

- 5.复制Courier New.ttf和msyhl.ttc字体到invoice_needed_font目录下
- 6.建立字体缓存

        #mkfontscale    // 如果提示 mkfontscale: command not found，需自行安装 #yum install mkfontscale
        #mkfontdir
        #fc-cache –fv   // 刷新内存中的字体缓存
        #source /etc/profile    // 执行以下命令让字体生效1234

- 7.查看是否安装成功

	#fc-list
