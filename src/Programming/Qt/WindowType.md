## Qt窗口模型介绍
> https://doc.qt.io/qt-5/qt.html#WindowType-enum

#### 窗口组织方式
- 一个完整的QT GUI界面是由一个一个的基本矩形窗口拼接起来的，这些基本窗口通过树形结构组织起来，子窗口只能显示在父窗口内，不能移动到父窗口外。可以通过下列方法设置窗口父子关系：

		//方法一，直接设置父子窗口关系
		void QWidget::setParent(QWidget *parent)；
		//方法二，间接设置父子窗口关系
		QWidget *parent = new QWidget;
		QHBoxLayout *parentLayout = new QHBoxLayout;
		QWidget *child = new QWidget;
		parent->setLayout(parentLayout);
		parentLayout->addWidget(child);//把child的父窗口设置为parent
#### 窗口类型
- 官方文档
	- https://doc.qt.io/qt-5/qt.html#WindowType-enum
- 可以看到Qt有很多类型的窗口，其中最常见的类型就是`Qt::Widget`和`Qt::Window`。为了方便记忆，我个人习惯上把Qt窗口分为两大类型：`Qt::Widget`和`Qt::Window`，其余类型都可以看做`Qt::Window`类型的子类型
- 两者区别
	- 区别一：`Qt::Window`类型的窗口默认有系统边框（frame），而`Qt::Widget`类型的窗口没有系统边框
		- 对于`Qt::Window`类型，可以通过`setWindowFlags(Qt::FramelessWindowHint)`设置是否显示边框。
	- 区别二：某个窗口不是应用程序根窗口，如果它是`Qt::Widget`类型，则默认显示；如果它是`Qt::Window`类型，则默认不显示，需要手动调用下列函数之一才会显示：
	
			QWidget::setVisible(bool);
			QWidget::show();
			QWidget::exec();
	- 区别三：`Qt::Widget`类型的窗口默认只能显示在父窗口区域内，而`Qt::Window`类型的窗口默认可以移动到父窗口区域外部。
- 设置窗口类型
	- 设置窗口类型的方式有两种，显式设置窗口类型和隐式设置窗口类型。
		- 通过下列函数显式定义窗口类型：

				QWidget::setWindowFlag(Qt::WindowType flag, bool on = true)
		- 有些方法可以隐式设置窗口类型，举几个例子：

				QHBoxLayout::addWidget(QWidget *widget);//把widget的类型设置为Qt::Widget
				QWidget::setParent(QWidget *parent);//把widget的类型设置为Qt::Widget
				QDialog;//默认类型为Qt::Dialog
				//如果一个窗口没有parent，那么这个窗口会被自动设置为Qt::Window类型，且不可更改
- 其它常见类型
	<table>
		<tr>
		<th>类型</th><th>	特点</th>
		</tr>
		<tr>
			<td>Qt::Widget</td><td>无系统边框，非top level窗口</td>
		</tr>
		<tr>
			<td>Qt::Window</td><td>	有系统边框，top level窗口</td>
		</tr>
		<tr>
			<td>Qt::Dialog</td><td>	有系统边框，一般是top level窗口，也可以有父窗口，如果有父窗口，则位于父窗口中心位置</td>
		</tr>
		<tr>
			<td>Qt::Sheet</td><td>	有系统边框</td>
		</tr>
		<tr>
			<td>Qt::Tool</td><td>	有系统边框，但边框右上角无最小化按钮，只有关闭按钮</td>
		</tr>
		<tr>
			<td>Qt::ToolTip</td><td>	无系统边框，且始终悬浮于所有窗口上方</td>
		</tr>
		<tr>
			<td>Qt::Popup</td><td>	无系统边框，具有一个特性：点击应用会引起该窗口消失</td>
		</tr>
		<tr>
			<td>Qt::SplashScreen</td><td>	有系统边框，又称为launch screen</td>
		</tr>
		<tr>
			<td>Qt::SubWindow</td><td>	有系统边框，和Qt::Window差别在于它不是顶层控件</td>
		</tr>
	</table>

#### 窗口盒模型
- 简单学过网页开发的应该知道CSS盒模型，QT窗口同样有盒模型，QT的窗口盒模型结构和CSS一模一样：每个窗口被划分为四个部分：margin，border，padding，content。

#### 窗口模态
- 窗口模态是指的当某个窗口显示的时候，它的父窗口以及祖先窗口是否响应用户的交互。窗口模态分为三个等级：
	- `Qt::NonModal` 非模态：不关闭父窗口以及祖先窗口与用户的交互；
	- `Qt::WindowModal` 半模态：关闭父窗口、父窗口的父窗口及兄弟窗口与用户的交互。
	- `Qt::ApplicationModal` 模态：关闭整个应用程序其它所有窗口与用户的交互。
可以通过下列函数设置窗口模态：

			QWidget::setWindowModality(Qt::WindowModality);
			//true=>Qt::ApplicationModal；false=>Qt::NonModal
			QWidget::setModal(bool);
			//隐式设置为Qt::ApplicationModal
			QWidget::exec();