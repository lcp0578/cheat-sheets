## 渐变原理(QGradient类及其子类)
- QGradient类与QBrush类一起用于指定渐变填充。
- Qt目前支持3种类型的渐变填充
	- 线性渐变：使用QLinearGradient类描述，在起点(xs, ys)和终点(xe, ye)之间插入颜色，在起点和终点之间的区域为线性渐变区域。
	- 辐射(径向)渐变：由QRadialGradient类描述。由中心点(xc, yc)和半径r定义一个圆(该圆即为辐射渐变区域)，然后颜色从焦点(xf, yf)向外扩散。
	- 圆锥渐变：由QConicalGradient类描述。由一个中心点(xc, yc)和一个角度a定义，然后颜色在中心点周围像钟表那样扩散。