## QWidget update刷新
- Qt手册中关于QWidget::update()解释如下：：
	- Updates the widget unless updates are disabled or the widget is hidden.
	- This function does not cause an immediate repaint; instead it schedules a paint event for processing when Qt returns to the main event loop. This permits Qt to optimize for more speed and less flicker than a call to repaint() does.
	- Calling update() several times normally results in just one paintEvent() call.
	- Qt normally erases the widget's area before the paintEvent() call. If the Qt::WA_OpaquePaintEvent widget attribute is set, the widget is responsible for painting all its pixels with an opaque color

- 对于如上英文，解释如下：：
	- 刷新控件，除非刷新被禁用或者控件是隐藏的。
	- 此函数不会导致立即重绘; 相反，它调度一个paint事件，在Qt返回主事件循环时处理。这允许Qt进行优化，以获得比调用repaint()更快的速度和更少的闪烁。
	- 多次调用update()通常只会导致一次paintEvent()调用。
	- Qt通常在调用paintEvent()之前擦除控件区域。如果设置了Qt::WA_OpaquePaintEvent属性，控件用不透明的颜色绘制其所有像素。

- void QWidget::update()源码如下

		void QWidget::update()
		{
			update(rect());
		}

	- 即调用update没有传递参数，则默认刷新控件的整个区域