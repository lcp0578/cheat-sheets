## 多页面切换布局QStackedLayout
- QStackedLayout类提供了多页面切换的布局
- 构造函数为：

		QStackedLayout([QWidget parent])

	- 与QFormLayout一样，不是QWidget类的继承者，因此没有自己的窗口，不能单独使用。 因此，容器作为子控件使用。要在构造函数中指定父组件。如果没有，可将容器作参数，调用父组件的setLayout()方法。
- setStackingMode
	- enum QStackedLayout::StackingMode. This enum specifies how the layout handles its child widgets regarding their visibility. Constant Value Description
	- `QStackedLayout::StackOne` `0` Only the current widget is visible. This is the default.
	- `QStackedLayout::StackAll` `1` All widgets are visible. The current widget is merely raised.
