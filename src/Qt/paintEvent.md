## Qt paintEvent事件
#### 基础概念：
- `paintEvent(QPaintEvent*)`函数是`QWidget`类中的虚函数，用于ui的绘制，会在多种情况下被其他函数自动调用，比如`update()`时。
#### 运行时机：
- 一个重绘事件用来重绘一个部件的全部或者部分区域，下面几个原因的任意一个都会发生重绘事件：
	- `repaint()`函数或者`update()`函数被调用；
	- 被隐藏的部件现在被重新显示；
	- 其他一些原因。

#### 优化绘制事件方法：
- 大部分部件可以简单地重绘它们的全部界面，但是一些绘制比较慢的部件需要进行优化而只绘制需要的区域（可以使用`QPaintEvent::region()`来获取该区域），这种速度上的优化不会影响结果。
- Qt也会通过合并多个重绘事件为一个事件来加快绘制，当`update()`函数被调用多次，或者窗口系统发送了多个重绘事件，那么Qt就会合并这些事件成为一个事件，而这个事件拥有最大的需要重绘的区域。`update()`函数不会立即进行重绘，要等到Qt返回主事件循环后才会进行，所以多次调用`update()`函数一般只会引起一次`paintEvent()`函数调用。
- 而调用`repaint()`函数会立即调用`paintEvent()`函数来重绘部件，只有在必须立即进行重绘操作的情况下（比如在动画中），才使用`repaint()`函数。
- `update()`函数允许Qt优化速度和减少闪烁，但是`repaint()`函数不支持这样的优化，所以建议一般情况下尽可能使用`update()`函数。
- 还要说明一下，在程序开始运行时就会自动发送重绘事件而调用`paintEvent()`函数，另外，不要在`paintEvent()`函数中调用`update()`或者`repaint()`函数。
- 当重绘事件发生时，要更新的区域一般会被擦除，然后在部件的背景上进行绘制。
#### 其他相关函数
- `QWidget * QScrollView::viewport () const`
	- 返回滚动视图中的视口窗口部件，这个窗口部件包含内容窗口部件或者要画的区域。
- `void QWidget::paintEvent ( QPaintEvent * )` [虚 保护]
	- 只要窗口部件需要被重绘就被调用。每个要显示输出的窗口部件必须实现它。
	- 这个事件处理器可以在子类中被重新实现来接收绘制事件。
	- 它可以是`repaint()`或`update()`的结果。 很多窗口部件在当它们被请求时，它们很简单地重新绘制整个界面，但是一些窗口部件通过仅仅绘制被请求的区域`QPaintEvent::region()`进 行优化，例如，`QListView`和`QCanvas`就是这样做的。
	- Qt也可通过把多个绘制事件合并为一个来加快绘制速度。当`update()`被调用几次或者窗口系统发送几次绘制事件，Qt把它们合并为 一个比较大区域（请参考`QRegion::unite()`）的一个事件中。repaint()不允许这样优化，所以只要可能我们尽量使用`update ()`。
	- 当绘制事件发生，更新区域通常被擦除。这里有一些例外，通过QPaintEvent::erased()可以得知这个窗口部件是否被擦除。
- `void QWidget::repaint ( int x, int y, int w, int h, bool erase = TRUE )` [槽]
	- 通过立即调用`paintEvent()`来直接重新绘制窗口部件，如果erase为真，Qt在`paintEvent()`调用之前擦除区域 `(x,y,w,h)`。 如果`w`是负数，它被`width()-x`替换，并且如果`h`是负数，它被`height()-y`替换。 
	- 如果你需要立即重新绘制，建议使用`repaint()`，比如在动画期间。在绝大多数情况下，`update()`更好，因为它允许Qt来优化速度并且防止闪烁。 
	- 警告：如果你在一个函数中调用`repaint()`，而它自己又被`paintEvent()`调用，你也许会看到无限循环。`
	- update()`函数从来不会产生循环。
- `void QWidget::update ()` [槽]
	- 更新窗口部件，当Qt回到主事件中时，它规划了所要处理的绘制事件。这样允许Qt进行优化从而得到比调用`repaint()`更快的速度和更 少的闪烁。 几次调用`update()`的结果通常仅仅是一次`paintEvent()`调用。 Qt通常在`paintEvent()`调用之前擦除这个窗口部件的区域，仅仅只有在`WRepaintNoErase`窗口部件标记被设置的时候才不会。
- `void QWidget::erase ( int x, int y, int w, int h )`
	- 在窗口部件中擦除指定区域`(x, y, w, h)`，并不产生绘制事件。
	- 如果w为负数，它被`width()-x`替换。如果`h`为负数，它被`height()-y`替换。
	- 子窗口部件不被影响。
- `bool updatesEnabled`
	- 这个属性保存的是更新是否生效。
	- 如果更新失效，调用`update()`和`repaint()`是没有效果的。如果更新失效，来自窗口系统的绘制事件会被正常处理。 `setUpdatesEnabled()`通常被用于在一小段事件内使更新失效，例如为了避免在大的变化期间发生屏幕闪烁。
	- 实例：

			    setUpdatesEnabled( FALSE );
			    bigVisualChanges();
			    setUpdatesEnabled( TRUE );
			    repaint();
	- 通过`setUpdatesEnabled()`设置属性值并且通过`isUpdatesEnabled()`来获得属性值。