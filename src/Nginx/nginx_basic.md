## nginx basic
- 错误日志

	error_log 级别分为 debug, info, notice, warn, error, crit  默认为crit, 格式如下：
	
		error_log  /your/path/error.log crit;  
	crit 记录的日志最少，而debug记录的日志最多。建议保持默认，调试时，可以临时修改一下。
- 修改上传文件大小限制

		# nginx/conf/nginx.conf
        location / {
            ...
   			client_max_body_size    1000m;
  		}
- 查看连接情况

 		$ netstat -n | awk '/^tcp/ {++S[$NF]} END {for(a in S) print a,S[a]}'
	结果说明：
    - SYN_RECV        //一个连接请求已经到达，等待确认
	- ESTABLISHED     //正常数据传输状态/当前并发连接数
	- FIN_WAIT2       //另一边已同意释放
	- ITMED_WAIT      //等待所有分组死掉
	- CLOSING         //两边同时尝试关闭
	- TIME_WAIT       //另一边已初始化一个释放
	- LAST_ACK        //等待所有分组死掉

 