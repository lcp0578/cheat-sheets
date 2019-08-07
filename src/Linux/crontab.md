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
- 重启crontab服务（需要等几分才会正真执行）

		/etc/init.d/crond restart
- 按时间记录执行的log

		* * * * * php /home/wwwroot/oa/bin/console admin:sms:send >> /home/wwwlogs/sms/`date +\%Y\%m\%d\%H`_sms.log 2>&1
		* * * * * php /home/wwwroot/oa/bin/console admin:sms:send >> "/home/wwwlogs/sms/$(date +"\%Y\%m\%d\%H")_sms.log" 2>&1

	PS: 2>&1 表示把标准错误输出重定向到与标准输出一致
    PS: 注意`+` 前面有空格，之后不能有空格
		
	