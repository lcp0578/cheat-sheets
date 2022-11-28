## setWindowFlags 设置窗口属性
- WindowType枚举类型
	<table>
		<tr>
		<th>类型</th><th>说明</th>
		</tr>
		<tr>
			<td>Qt::Widget:</td><td> QWidget构造函数的默认值，如果新的窗口部件没有父窗口部件，则它是一个独立的窗口，否则就是一个子窗口部件。
		</tr>
		<tr>
			<td>Qt::Window: </td><td>无论是否有父窗口部件，新窗口部件都是一个窗口，通常有一个窗口边框和一个标题栏。</td>
		</tr>
		<tr>
			<td>Qt::Dialog: </td><td>新窗口部件是一个对话框，它是QDialog构造函数的默认值。</td>
		</tr>
		<tr>
			<td>Qt::Sheet： </td><td>新窗口部件是一个Macintosh表单(sheet)。</td>
		</tr>
		<tr>
			<td>Qt::Drawer: </td><td>新窗口部件是一个Macintosh抽屉(drawer)。</td>
		</tr>
		<tr>
			<td>Qt::Popup: </td><td>新窗口部件是一个弹出式顶层窗口。</td>
		</tr>
		<tr>
			<td>Qt::Tool:</td><td> 新窗口部件是一个工具(tool)窗口，它通常是一个用于显示工具按钮的小窗口。</td>
		</tr>
		<tr>

			<td>Qt::WindowStaysOnTopHint：</td><td>提示。</td>
		</tr>
		<tr>
			<td>Qt::ToolTip: </td><td>新窗口部件是一个提示窗口，没有标题栏和窗口边框。</td>
		</tr>
		<tr>
			<td>Qt::Desktop: </td><td>新窗口部件是桌面，它是QDesktopWidget构造函数的默认值。</td>
		</tr>
		<tr>
			<td>Qt::SplashScreen: </td><td>新窗口部件是一个欢迎窗口，它是SplashScreen构造函数的默认值。</td>
		</tr>
		<tr>
			<td>Qt::SubWindow: </td><td>新窗口部件是一个子窗口，而无论窗口部件是否有父窗口部件。此外，Qt还定义了一些控制窗口外观的窗口提示（这些窗口提示仅对顶层窗口有效）。</td>
		</tr>
		<tr>
			<td>Qt::MSWindowFiredSizeDialogHint: </td><td>为Windows系统上的窗口装饰一个窄的对话框边框，通常这个提示用于固定大小的对话框。</td>
		</tr>
		<tr>
			<td>Qt::MSWindowOwnDC: </td><td>为Windows系统上的窗口添加自身的显示上下文菜单。</td>
		</tr>
		<tr>
			<td>Qt::X11BypassWindowManagerHint: </td><td>完全忽视窗口管理器，它的作用是产生一个根本不被管理的无窗口边框的窗口(此时，用户无法使用键盘进行输入，除非手动调用。</td>
		</tr>
		<tr>

			<td>QWidget::activateWindow()：</td><td>激活窗口。</td>
		</tr>
		<tr>
			<td>Qt::FramelessWindowHint: </td><td>产生一个无窗口边框的窗口，此时用户无法移动该窗口和改变它的大小。</td>
		</tr>
		<tr>
			<td>Qt::CustomizeWindowHint: </td><td>关闭默认的窗口标题提示。</td>
		</tr>
		<tr>
			<td>Qt::WindowTitleHint： </td><td>为窗口装饰一个标题栏。</td>
		</tr>
		<tr>
			<td>Qt::WindowSystemMenuHint: </td><td>为窗口添加一个窗口系统系统菜单，并尽可能地添加一个关闭按钮。</td>
		</tr>
		<tr>
			<td>Qt::WindowMinimizeButtonHint: </td><td>为窗口添加一个“最小化”按钮。</td>
		</tr>
		<tr>
			<td>Qt::WindowMaximizeButtonHint: </td><td>为窗口添加一个“最大化”按钮。</td>
		</tr>
		<tr>
			<td>Qt::WindowMinMaxButtonHint: </td><td>为窗口添加一个“最小化”按钮 和一个“最大化”按钮</td>
		</tr>
		<tr>
			<td>Qt::WindowContextHelpButtonHint:</td><td> 为窗口添加一个“上下文帮助”按钮。</td>
		</tr>
		<tr>
			<td>Qt::WindowStaysOnTopHint: </td><td>告知窗口系统，该窗口应该停留在所有其他窗口的上面。</td>
		</tr>
		<tr>
			<td>Qt::WindowType_Mask:</td><td> 一个用于提示窗口标识的窗口类型部分的掩码。</td>
		</tr>
	</table>

- 使用说明
	- 函数：setWindowFlags(Qt::WindowFlags type)，多个属性使用：
	- `|` 运算符：设置多个属性；
	- `&~` 运算符：设置属性的相反操作；