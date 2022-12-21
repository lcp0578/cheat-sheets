## QtWebEngine
- https://www.cnblogs.com/yaoyu126/p/7525603.html
- https://wiki.qt.io/QtWebEngine/ChromiumVersions
- 设置透明

		m_pWebEngineView->load(QUrl("http://www.baidu.com"));
			m_pWebEngineView->page()->setBackgroundColor(Qt::transparent);
- 加载Web View时的一些信号
	- `loadStarted()`信号：View开始加载时发送；
	- `loadProgress()`信号：任意Web元素完成加载时发送；
	- `loadFinished()`信号：整个View都加载完成时发送。
- 相关方法
	- `page()`方法返回一个指向`QWebEnginePage`的指针。一个`QWebEngineView`包含一个`QWebEnginePage`，它允许我们访问`QWebEngineHistory`，即网页的历史信息。
	- `title()`获取网页标题
	- `icon()` 获取网页icon。这个icon的URL通过`iconUrl()`访问。
	- 当title、icon改变时，相应的会发送`titleChanged()`、`iconChanged()`、`iconUrlChanged()`信号。
	- `zoomFactor()`返回一个zoomFactor属性，标志页面内容的缩放等级。
	- Widget中包含了一个文本菜单，提供了一些浏览器常用的action。如果要定制一个菜单，或者向原菜单、工具栏中添加一些额外的action，可以通过`pageAction()`构造。此外，这些action也可以通过`triggerPageAction()`直接触发。
- 监听加载进度

		//加载进度监听
		connect(pWebEngineView, SIGNAL(loadProgress(int)), this, SLOT(webEngineViewLoadProgress(int)));

		void CWebLayoutWidget::webEngineViewLoadProgress(int process)
		{
			QDateTime current_date_time = QDateTime::currentDateTime();
			QString current_date = current_date_time.toString("yyyy-MM-dd hh:mm:ss");
			qDebug() << "webEngineViewLoadProgress:[" << current_date << "]" << process;
		}