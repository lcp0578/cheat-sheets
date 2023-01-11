## Qss: Qt Style Sheets
- Qt通过样式表设置控件样式进行个性化定制、界面美化。
- [Qt Style Sheets Reference](https://doc.qt.io/qt-5/stylesheet-reference.html)
### 使用方式
- Qt Designer
	- 在Qt Designer中，每个控件都有styleSheet属性，通过键入样式表，即可设置该控件的样式。
- QSS文件
	- 使用QFile读入样式表，使用setStyleSheet进行设置。

			QApplication app(argc, argv);
			QFile qss("StyleSheet.qss");
			qss.open(QFile::ReadOnly);
			app.setStyleSheet(qss.readAll());
			qss.close();
- 用程序语句添加
	- 每一个控件都有自己的setStyleSheet(QString &)成员函数，直接把方法一里面的样式语句，作为形参传入该方法即可，例如：

			QString pushButton_SS = "QPushButton{border-radius: 10px; /*圆角半径*/color:green;/*字体颜色*/}";
			ui->pushButton_SerialSend->setStyleSheet(pushButton_SS);
### 语法
- 基础语法
	- QSS同CSS语法规则类似，形式如下：
	
			selector{attribute:value};
	- 其中：
		- selector选择器：通常情况下为控件类名（如QPushButton）；
		- attribute属性：待设置的样式表属性（如background-color）；
		- value值：属性赋值（如rgb(40, 85, 20);）

	- Qt样式表通常不区分大小写(即，color、Color、color和color指的是同一属性)。但是是类名、对象名和Qt属性名，它们区分大小写。

- 共享属性
	- 对于共享属性部分可以使用下面形式：

			QCheckBox,QComboBox,QSpinBox
			{
				color:rgb(255,0,0);
				background-color:rgb(255,255,255);
				font:bold;
			}


- 选择器（selector）
	<table>
		<tr>
		<th>选择器</th> <th>举例	</th><th>解释 </th>
		</tr>
		<tr>
			<td>通用选择器 </td><td>	 *  </td><td>		所有 Qt 的 widget，即不声明选择器时，属性作用于所有组建 </td>
		</tr>
		<tr>
			<td>类型选择器 </td><td>		QPushButton </td><td>		作用于QPushButton及其子类的实例。</td>
		</tr>
		<tr>
			<td>属性选择器 </td><td>		QPushButton[flat=“false”] </td><td>		作用于非平面（flat=“false”）的QPushButton实例。</td>
		</tr>
		<tr>
			<td>类选择器 </td><td>		.QPushButton </td><td>		作用于QPushButton的实例，但不匹配其子类的实例。（加了个’.’)</td>
		</tr>
		<tr>
			<td>ID选择器 </td><td>		QPushButton#okButton </td><td>		作用于对象名称为okButton的所有QPushButton实例。</td>
		</tr>
		<tr>
			<td>后代选择器 </td><td>		QDialog QPushButton	 </td><td>	匹配作为QDialog的子体(子级、孙级等)的所有QPushButton实例。</td>
		</tr>
		<tr>
			<td>子选择器	 </td><td>	QDialog > QPushButton	 </td><td>	匹配作为QDialog的直接子级的所有QPushButton实例。</td>
		</tr>
		<tr>
			<td>子控制 </td><td>		QComboBox::drop-down	 </td><td>	要设置复杂 widget 的样式，需要访问 widget 的子控件，如QComboBox的下拉按钮或QSpinBox的上下箭头。选择器可以包含子控件，从而可以将规则的应用限制到特定的 widget 子控件。</td>
		</tr>
	</table>
- 伪状态（Pseudo-States）
	- 用户在操作时，可以根据不同的交互状态展示不同的用户样式，界面能够识别用户操作，不需要代码控制即可响应不同状态下的样式。

			QPushButton {
			    border: 1px solid #555;
			    padding: 4px;
			    min-width: 65px;
			    min-height: 12px;
			}
			
			QPushButton:hover {
			    background-color: #999;
			}
			
			QPushButton:pressed {
			    background-color: #333;
			    border-color: #555;
			    color: #AAA;
			}
			
			QPushButton:disabled {
			    color: #333333;
			}
	- 所有伪状态
		<table>
			<tr>
				<th>Pseudo-State</th> <th>	Description</th>
			</tr>
			<tr>
				<td>:active</td><td>	此状态在widget驻留在活动窗口中时设置。</td>
			</tr>
			<tr>
				<td>:adjoins-item</td><td>	此状态在QTreeView的::branch与项相邻时设置。</td>
			</tr>
			<tr>
				<td>:alternate</td><td>	当QAbstractItemView::ternatingRowColors()设置为true时，将为绘制QAbstractItemView的行时的每隔一行设置此状态。</td>
			</tr>
			<tr>
				<td>:bottom</td><td>	该项目位于底部。例如，标签位于底部的QTabBar。</td>
			</tr>
			<tr>
				<td>:checked</td><td>	该项目已选中。例如，QAbstractButton的选中状态。</td>
			</tr>
			<tr>
				<td>:closable</td><td>	这些项目可以关闭。例如，QDockWidget打开了
	QDockWidget::DockWidgetClosable功能。</td>
			</tr>
			<tr>
				<td>:default</td><td>	该项目为默认值。例如，QMenu中的默认QPushButton或默认操作。</td>
			</tr>
			<tr>
				<td>:disabled</td><td>	该项目已禁用。</td>
			</tr>
			<tr>
				<td>:editable</td><td>	QComboBox是可编辑的。</td>
			</tr>
			<tr>
				<td>:edit-focus</td><td>	该项具有编辑焦点(请参见QStyle::State_HasEditFocus)。此状态仅适用于Qt扩展应用程序。</td>
			</tr>
			<tr>
				<td>:enabled </td><td>	该项目已启用。</td>
			</tr>
			<tr>
				<td>:exclusive</td><td>	该项目是独占项目组的一部分。例如，独占QActionGroup中的菜单项。</td>
			</tr>
			<tr>
				<td>:first</td><td>	该项目是(列表中的)第一个项目。例如，QTabBar中的第一个选项卡。</td>
			</tr>
			<tr>
				<td>:flat</td><td>	这件物品是平的。例如，平面QPushButton。</td>
			</tr>
			<tr>
				<td>:floatable</td><td>	这些项目可以浮动。例如，QDockWidget打开了QDockWidget：：DockWidgetFloatable功能。</td>
			</tr>
			<tr>
				<td>:focus</td><td>	该项具有输入焦点。</td>
			</tr>
			<tr>
				<td>:has-children</td><td>	该项目具有子项。例如，QTreeView中具有子项的项。</td>
			</tr>
			<tr>
				<td>:has-siblings</td><td>	该项目有同级。例如，QTreeView中的同级项。</td>
			</tr>
			<tr>
				<td>:horizontal</td><td>	该项目具有水平方向</td>
			</tr>
			<tr>
				<td>:hover</td><td>	鼠标悬停在该项目上。</td>
			</tr>
			<tr>
				<td>:indeterminate</td><td>	该项具有不确定状态。例如，部分选中QCheckBox或QRadioButton。</td>
			</tr>
			<tr>
				<td>:last</td><td>	该项是(列表中的)最后一项。例如，QTabBar中的最后一个选项卡。</td>
			</tr>
			<tr>
				<td>:left</td><td>	该项目位于左侧。例如，选项卡位于左侧的QTabBar。</td>
			</tr>
			<tr>
				<td>:maximized</td><td>	该项目将最大化。例如，最大化的QMdiSubWindow。</td>
			</tr>
			<tr>
				<td>:middle</td><td>	项目在中间(在列表中)。例如，QTabBar中不在开头或结尾的制表符。</td>
			</tr>
			<tr>
				<td>:minimized</td><td>	该项目被最小化。例如，最小化的QMdiSubWindow。</td>
			</tr>
			<tr>
				<td>:movable</td><td>	物品可以四处移动。例如，QDockWidget打开了QDockWidget::DockWidgetMoovable功能。</td>
			</tr>
			<tr>
				<td>:no-frame</td><td>	该项目没有框架。例如，无框架的QSpinBox或QLineEdit。</td>
			</tr>
			<tr>
				<td>:non-exclusive</td><td>	该项是非独占项组的一部分。例如，非独占QActionGroup中的菜单项。</td>
			</tr>
			<tr>
				<td>:off</td><td>	对于可以切换的项目，这适用于处于“关闭”状态的项目。</td>
			</tr>
			<tr>
				<td>:on	</td><td>对于可以切换的项目，这适用于处于“打开”状态的widget。</td>
			</tr>
			<tr>
				<td>:only-one</td><td>	该项目是(列表中的)唯一项目。例如，QTabBar中的一个单独的选项卡。</td>
			</tr>
			<tr>
				<td>:open</td><td>	该项目处于打开状态。例如，QTreeView中的展开项，或具有打开菜单的QComboBox或QPushButton。</td>
			</tr>
			<tr>
				<td>:next-selected</td><td>	选择下一项(在列表中)。例如，QTabBar的选定选项卡紧挨着该项。</td>
			</tr>
			<tr>
				<td>:pressed</td><td>	正在使用鼠标按下该项。</td>
			</tr>
			<tr>
				<td>:previous-selected</td><td>	选择上一项(在列表中)。例如，QTabBar中选定选项卡旁边的选项卡。</td>
			</tr>
			<tr>
				<td>:read-only</td><td>	该项目标记为只读或不可编辑。例如，只读QLineEdit或不可编辑的QComboBox。</td>
			</tr>
			<tr>
				<td>:right</td><td>	该项目位于右侧。例如，选项卡位于右侧的QTabBar。</td>
			</tr>
			<tr>
				<td>:selected</td><td>	该项目即被选中。例如，QTabBar中的选定选项卡或QMenu中的选定项目。</td>
			</tr>
			<tr>
				<td>:top</td><td>	该项目位于顶部。例如，选项卡位于顶部的QTabBar。</td>
			</tr>
			<tr>
				<td>:unchecked	</td><td>该项目处于取消选中状态。</td>
			</tr>
			<tr>
				<td>:vertical</td><td>	该项目具有垂直方向。</td>
			</tr>
			<tr>
				<td>:window</td><td>	widget是窗口(即顶层小部件)</td>
			</tr>
		</table>
- 含子控制/子控件，用双冒号(`::`)

		/**************************************CheckBox*********************************************/
		QCheckBox::indicator:unchecked{
		image: url(:/resource/chebox_off.png)
		}
		 
		QCheckBox::indicator:checked{
		image: url(:/resourcechebox_on.png)
		}
		/**************************************CheckBox*********************************************/
		 
		 
		/**************************************QTabBar*********************************************/
		QTabBar::tab {
		    color: #666666; 
		    height:40px; 
		    width:100px;
		} 
		QTabBar::tab:selected {
		    color: #333333; 
		    font-weight:bold
		}
		 QTabBar::tab:hover {
		    color: #666666;
		}
		/**************************************QTabBar*********************************************/
		 
		 
		/**************************************滑动条*********************************************/
		QSlider {
		    background: rgb(170, 170, 170);
		    padding: 2px;
		    height: 40px;
		}
		QSlider::groove:horizontal {
		    subcontrol-origin: content;
		    background: rgb(76, 76, 76);
		    
		    /* the groove expands to the size of the slider by default. 
		    by giving it a height, it has a fixed size */
		    height: 20px;
		}
		QSlider::handle:horizontal {
		    background-color: rgb(50, 50, 50);
		    width: 40px;
		    border-radius: 20px;
		    
		    /* handle is placed by default on the contents rect of the groove. 
		    Expand outside the groove */
		    margin: -10px 0;
		}
		QSlider::sub-page:horizontal {
		    background: #999;
		    margin: 5px;
		    border-radius: 5px;
		}
		QSlider::add-page:horizontal {
		    background: #666;
		    margin: 5px;
		    border-radius: 5px;
		}
		/**************************************滑动条*********************************************/
		 
		 
		/**************************************下拉框*********************************************/
		QComboBox{
		border:0px; 
		background-color:transparent;
		color:#333333; 
		}
		QComboBox::down-arrow{
		image:none;
		}
		QComboBox::drop-down{
		width:0px; 
		border:0px;
		}
		QComboBox QAbstractItemView {
		color:#333333;
		border: 1px solid #DDDDDD;
		background-color:white;
		selection-color:white;
		selection-background-color: rgb(0, 102, 96);
		}
		/**************************************下拉框*********************************************/
		 
		 
		/**************************************滚动条*********************************************/
		QScrollBar:horizontal {
		    height: 16px;
		    border-width: 0px 10px 0px 10px;
		    border-image: url(:/img/horizontal-track.png) 0 10 0 10 repeat stretch;
		    margin-left: 6px;
		    margin-right: 16px;
		    padding-right: 4px;
		}
		QScrollBar::handle:horizontal {
		    min-width: 40px;
		    border-width: 0 17px 0 17px;
		    border-image: url(:/img/horizontal-handle.png) 0 17 0 17 repeat repeat;
		}
		QScrollBar::sub-line:horizontal {
		    width: 20px;
		    height: 17px;
		    subcontrol-position: left;
		    subcontrol-origin: margin;
		    background-image: url(:/img/horizontal-sub-line.png)
		}
		QScrollBar::add-line:horizontal {
		    width: 20px;
		    height: 17px;
		    subcontrol-position: right;
		    subcontrol-origin: border;
		    background-image: url(:/img/horizontal-add-line.png)
		}
		QScrollBar:vertical {
		    width: 16px;
		    border-width: 10px 0px 10px 0px;
		    border-image: url(:/img/vertical-track.png) 10 0 10 0 repeat repeat;
		    margin-top: 6px;
		    margin-bottom: 16px;
		    padding-bottom: 6px;
		}
		QScrollBar::handle:vertical {
		    min-height: 40px;
		    border-width: 17px 0px 17px 0px;
		    border-image: url(:/img/vertical-handle.png) 17 0 17 0 repeat repeat;
		}
		QScrollBar::sub-line:vertical {
		    width: 17px;
		    height: 22px;
		    subcontrol-position: top left;
		    subcontrol-origin: margin;
		    background-image: url(:/img/vertical-sub-line.png)
		}
		QScrollBar::add-line:vertical {
		    width: 17px;
		    height: 22px;
		    subcontrol-position: bottom;
		    subcontrol-origin: border;
		    background-image: url(:/img/vertical-add-line.png)
		}
		/**************************************滚动条*********************************************/
		 
		/**************************************滑块*********************************************/
		QSlider {
		    height: 20px;
		}
		 
		QSlider::groove:horizontal {
		    subcontrol-origin: content;
		    background: transparent;
		    height: 20px;
		}
		 
		QSlider::handle:horizontal {
		    background-color: rgb(50, 50, 50);
		    width: 20px;
		    border-radius: 10px;
		}
		 
		QSlider::sub-page:horizontal {
		    background: #0078FF;
		    margin: 7px;
		    border-radius: 3px;
		}
		 
		QSlider::add-page:horizontal {
		    background: #999999;
		    margin: 7px;
		    border-radius: 3px;
		}
		/**************************************滑块*********************************************/
 