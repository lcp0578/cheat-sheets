## crontab

- crontab 文件格式

		0  18  *  *   *    /bin/echo 'date' > /dev/console
		分 时  日  月 星期  要运行的命令
	- 第1列分钟0～59
	- 第2列小时0～23（0表示子夜）
	- 第3列日1～31
	- 第4列月1～12
	- 第5列星期0～7（0和7表示星期天）
	- 第6列要运行的命令
- 列出crontab文件

		crontab -l
	可以使用这种方法在$HOME目录中对crontab文件做一备份:
		
		crontab -l > $HOME/mycron
- 编辑crontab文件  
	首先要设置环境变量EDITOR。cron进程根据它来确定使用哪个编辑器编辑crontab文件。  
	编辑$HOME目录下的. profile文件，在其中加入这样一行(使用vi):
		
		EDITOR=vi; export EDITOR
	编辑命令：
	
		crontab -e
- 删除crontab文件

		crontab -r
	