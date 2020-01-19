## awk使用示例
> https://www.cnblogs.com/emanlee/p/3327576.html

- nginx access.log 分析

		awk '{print $1}' /var/log/nginx/access.log | sort | uniq -c | sort -nr -k1 | head -n 20 //top 20 ip
        awk '{print $7}' /var/log/nginx/access.log | sort | uniq -c | sort -nr -k1 | head -n 20 //top 20 uri