## QFont设置字体大小/颜色
- 设置字体的大小：

	    QFont ft;
	    ft.setPointSize(25);//字体大小
	    m_titleLabel->setFont(ft);//其他控件里的字体大小设置也一样

- 设置字体颜色：
	- a. 样式:

		    m_titleLabel = new QLabel(tr("客户端"),this);
		    m_titleLabel->setStyleSheet("color:yellow;");
	- b. 调色板：

		    QLabel *lable = new QLabel("系统已就绪  ", this);
		    QPalette pe;
		    pe.setColor(QPalette::WindowText, Qt::white);//设置颜色
		    lable ->setPalette(pe);
