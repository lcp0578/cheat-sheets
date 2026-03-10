## time包
- 获取到当前时间戳

		timestamp := time.Now().Unix()
- 获取当前时间字符串

		format := "2006-01-02 15:04:05"
        timestamp := time.Now().Unix()
		currentTime := time.Unix(timestamp, 0).Format(format)
        formatDate := "2006-01-03"
        currentDate := time.Unix(timestamp, 0).Format(formatDate)
- 字符转字符串

		dateStr := "2020-03-08 09:54:55"
        timestamp, err := time.ParseInLocation("2006-01-02 15:04:05", dateStr, time.Local）
        //直接使用time.Pares会存在时区差问题