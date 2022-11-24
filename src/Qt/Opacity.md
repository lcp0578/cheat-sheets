## Qt中设置透明度
- `QWidget::setWindowOpacity`
	- `windowOpacity`是`QWidget`的属性，我们可以通过此接口对`QWidge`t一族设置不透明度，不过若`Widget`有父指针，则利用此接口设置会失败。此时可用以下两种方式替换。

- `QPainter::setOpacity`
	- 利用QPainter设置是最原始有效的方式，当我们在`paintEvent`中绘制时，可以利用QPainter设置透明度。

			void Widget::paintEvent(QPaintEvent *event)
			{
			    QPainter painter(this);
			    painter.setOpacity(0.6);
			    painter.drawPixmap(pos(),  pix.scaled(size(), Qt::IgnoreAspectRatio, Qt::SmoothTransformation));
			}
- `QGraphicsOpacityEffect`

		QGraphicsOpacityEffect *effect = newQGraphicsOpacityEffect(this);
		effect->setOpacity(0.5);
		widget->setGraphicsEffect(effect);