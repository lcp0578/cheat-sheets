## awk 分析access.log
- 查看访问uri的top 20

		awk '{print $7}' /home/wwwlogs/fawang.log | sort | uniq -c | sort -n -k 1 -r | head -n 20
- 查看访问IP

		awk '{print $1}' /home/wwwlogs/fawang.log | sort | uniq -c | sort -n -k 1 -r | head -n 20