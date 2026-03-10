## qss样式的作用范围及其替换、覆盖
#### 1. qss的作用范围
- 设置全局样式
	- 可以在main函数中，直接给QApplication设置样式，此样式为全局样式，对整个应用都生效

			QString qstrStyle = "QPushButton{color:blue;}"
			a.setStyleSheet(qstrStyle);
- 设置窗口样式
	- 可以给某个窗口对象设置样式

			w.setStyleSheet(qstrStyle);
	- 此样式只对该窗口及它的子窗口生效，对其他窗口不生效。

#### 2.qss样式的替换
- 对同一个对象调用多次`setStyleSheet`，后设置的生效，先前的设置全部丢弃。

		w.setStyleSheet(qstrStyle1);
		 
		w.setStyleSheet(qstrStyle2);
- 则qstrStyle1中的所有设置完全失效，使用qstrStyle2的定义

#### 3. qss样式的覆盖
- 全局样式（上层）>>>窗口样式>>>子窗口样式（下层）
- 结果：相同的属性发生覆盖。其他部分保留。

#### 4. 总结
- 在开发中注意设置qss样式的作用范围及替换、覆盖问题。
- 通用样式设置在最上层中
- 个性化的样式注意该样式的作用范围（限制样式的作用范围可以把样式写的十分具体，注意具体控件样式设置时控件变量的命名的特殊性）。
