## 实现Qss控件动态样式
- 在程序运行中，如果允许控件动态切换自身的样式
#### 伪类选择器
- 这是最常见的动态样式，比如按钮的hover伪类

	    QPushButton *button_color = new QPushButton();
	    button_color->setObjectName("button_color");
- 对应qss样式

		QPushButton{
		    background-color: red;
		}
		QPushButton:hover{
		    background-color: yellow;
		}
- 当鼠标移到控件上面就会触发对应的样式，红色的按钮变成黄色的按钮。
- 当存在多个按钮时候，可以通过qss的id选择器，设置控件的objectName，来选择某个按钮触发变化。

	    QPushButton *button_red = new QPushButton();
	    button_red->setObjectName("button_red");
	
	    QPushButton *button_green = new QPushButton();
	    button_green->setObjectName("button_green");
	
	    QPushButton *button_blue = new QPushButton();
	    button_blue->setObjectName("button_blue");
- 如果指定红色按钮hover效果，其他颜色按钮hover不变。

		QPushButton#button_red{
		    background-color: red;
		}
		QPushButton#button_red:hover{
		    background-color: yellow;
		}
		QPushButton#button_green{
		    background-color: green;
		}
		QPushButton#button_blue{
		    background-color: blue;
		}
- qss提供很多从某个状态切换到另一种状态的伪类，`:hover`高光、`:selected`选中、`:pressed`按下等等效果。

#### 属性选择器

- 有些场景伪类就会不够用，这时候就需要属性选择器来控制。

		void MainWindow::keyPressEvent(QKeyEvent *event)
		{
		    switch (event->key()) {
		    case Qt::Key_R:
		        button_color->setProperty("color", "red");
		        button_color->style()->polish(button_color);
		        break;
		    case Qt::Key_Y:
		        button_color->setProperty("color", "yellow");
		        button_color->style()->polish(button_color);
		        break;
		    case Qt::Key_G:
		        button_color->setProperty("color", "green");
		        button_color->style()->polish(button_color);
		        break;
		    case Qt::Key_B:
		        button_color->setProperty("color", "blue");
		        button_color->style()->polish(button_color);
		        break;
		    default:
		        break;
		    }
		}
- 对应qss样式，按下不同键盘按钮，切换对应首字母颜色的样式。

		QPushButton#button_color[color="red"]{
		    background-color: red;
		}
		QPushButton#button_color[color="yellow"]{
		    background-color: yellow;
		}
		QPushButton#button_color[color="green"]{
		    background-color: green;
		}
		QPushButton#button_color[color="blue"]{
		    background-color: blue;
		}

- 如果控件所有伪类都不满足，就可以通过代码里面手动修改setProperty赋值控件一种新的"伪类"。
- 然后通过`polish`或者`setStyle`刷新下控件样式，使其生效。

		pbtn_view->style()->unpolish(pbtn_view); //抹去旧的样式
		pbtn_view->style()->polish(pbtn_view); //涂上新的样式


#### 类名选择器

- 上面两种用法的原理其实都是相同的，通过控件触发某个伪类状态，添加了某些样式属性。
- 通过切换控件的类名，也可以实现切换不同样式。

		void MainWindow::keyPressEvent(QKeyEvent *event)
		{
		    switch (event->key()) {
		    case Qt::Key_R:
		        button_color->setObjectName("button_color_red");
		        button_color->style()->polish(button_color);
		        break;
		    case Qt::Key_Y:
		        button_color->setObjectName("button_color_yellow");
		        button_color->style()->polish(button_color);
		        break;
		    case Qt::Key_G:
		        button_color->setObjectName("button_color_green");
		        button_color->style()->polish(button_color);
		        break;
		    case Qt::Key_B:
		        button_color->setObjectName("button_color_blue");
		        button_color->style()->polish(button_color);
		        break;
		    default:
		        break;
		    }
		}
- 对应qss样式，按下不同键盘按钮，切换对应首字母颜色的样式。

		QPushButton#button_color_red{
		    background-color: red;
		}
		QPushButton#button_color_yellow{
		    background-color: yellow;
		}
		QPushButton#button_color_green{
		    background-color: green;
		}
		QPushButton#button_color_blue{
		    background-color: blue;
		}
- 这种用法跟setProperty很像，但还是有很大区别的。
- 修改伪类所产生的样式属性，要么是添加新属性，要么是覆盖原来的属性。
- 但是通过setObjectName所产生的样式属性，是放弃原先属性，替换成一种全新的样式。

		QPushButton#button_color{
		    color:red;
		}
