## log view 日志查看
> http://xstarcd.github.io/wiki/shell/logview_tips.html

- 查看并筛选日志，并显示日志的前后10行

		tail -n 100 log_name.log | grep "error" -i -A 10 -B　10