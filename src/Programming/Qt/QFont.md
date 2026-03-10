## QFont设置字体大小/颜色
- 设置字体的大小：

	    QFont ft;
	    ft.setPointSize(25);//字体大小
		ft.setPiexlSize(25);
	    m_titleLabel->setFont(ft);//其他控件里的字体大小设置也一样
	- PointSize的单位不是像素，它是以字体在屏幕实际显示的大小为单位的，它和屏幕的分辨率以及屏幕的真实尺寸相关，即它的单位即为屏幕上显示的字体大小。
	- PixelSize实际上是以像素为单位，即PixelSize的大小即为实际的像素大小。
- 设置字体颜色：
	- a. 样式:

		    m_titleLabel = new QLabel(tr("客户端"),this);
		    m_titleLabel->setStyleSheet("color:yellow;");
	- b. 调色板：

		    QLabel *lable = new QLabel("系统已就绪  ", this);
		    QPalette pe;
		    pe.setColor(QPalette::WindowText, Qt::white);//设置颜色
		    lable ->setPalette(pe);
