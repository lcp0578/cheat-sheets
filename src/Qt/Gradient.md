## Qt Qss 渐变颜色设置
- 渐变颜色设置有：
	- qlineargradient（线性渐变颜色设置）
	- qradialgradient（辐射渐变）
	- qconicalgradient（圆锥形渐变）。

			QLinearGradient：显示从起点到终点的渐变。
			QRadialGradient：以圆心为中心显示渐变。
			QConicalGradient：围绕一个中心点显示渐变。 
			QGradient::PadSpread ：填充区域内最接近的停止颜色。这是默认的。
			QGradient::RepeatSpread : 在区域外继续重复填充。
			QGradient::ReflectSpread : 在区域外反射填充。
- https://www.cnblogs.com/ybqjymy/p/13571546.html