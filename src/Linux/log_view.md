## log view 日志查看
> http://xstarcd.github.io/wiki/shell/logview_tips.html

- 查看并筛选日志，并显示日志的前后10行

		tail -n 100 log_name.log | grep "error" -i -A 10 -B　10
- 从第3000行开始，显示1000行。即显示3000~3999行 

		cat filename | tail -n +3000 | head -n 1000
