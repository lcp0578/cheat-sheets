## QDateTime与QTime获取系统当前时间
- 使用QDateTime类

		QDateTime current_date_time =QDateTime::currentDateTime();
		QString current_date =current_date_time.toString("yyyy.MM.dd hh:mm:ss.zzz ddd");

		//current_date字符串结果为"2016.05.20 12:17:01.445 周五"
	其中时间的显示格式可灵活配置：
	yyyy表示年；MM表示月；dd表示日； hh表示小时；mm表示分；ss表示秒；zzz表示毫秒；ddd表示周几
- 使用QTime类

		QTime current_time =QTime::currentTime();
		int hour = current_time.hour();     //当前的小时
		int minute = current_time.minute(); //当前的分
		int second = current_time.second(); //当前的秒
		int msec = current_time.msec();     //当前的毫秒
	当然QTime也可以像QDateTime::toString那样直接输出固定格式的字符串，使用方法与QDateTime::toString类似，