## QWebEngineView类实现Web浏览器
- 网页的前进后退刷新停止
	- QWebEngineView 有四个槽函数：back() 、forward()、reload()、stop() 实现了页面的导航功能。
	- 用四个按钮来触发相对应的4个槽函数。

- 网页的地址栏
	- QLineEdit 控件显示页面的地址。
	- QLineEdit 的回车事件 对应 QWebEngineView 的 setUrl() 或者 load() 函数。
	- 如果页面URL变更，则更新QLineEdit 的地址文本

- 页面的放大和缩小
	- 用2个按钮来设置QWebEngineView 的缩放因子，然后QWebEngineView 会自动进行缩放。

- 设置网页的图标
	- 利用的QWebEngineView 的icon属性变更事件，将网站的favicon.ico 设置为程序的窗口图标。

- 显示网页加载的进度
	- 利用的QWebEngineView 的progressChanged，显示在窗口标题后面。

- 显示网页标题
	- 利用的QWebEngineView 的titleChanged事件，设置程序的窗口标题

- 链接页面的加载
	- QWebEngineView 的文档介绍的很详细，以上的功能实现起来都很简单。

>  https://blog.csdn.net/hitzsf/article/details/109278967