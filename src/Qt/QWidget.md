## QWidget
- 关于 QWidget 的背景颜色和背景图片的设置
	- 首先设置autoFillBackground 属性为真
	- 然后定义一个QPalette 对象
	- 设置QPalette 对象的背景属性（颜色或图片）
	- 最后设置QWidget 对象的Palette
	- 实例：

            QWidget *widget = new QWidget;
            widget->setAutoFillBackground(true);
            QPalette palette;
            palette.setColor(QPalette::Background, QColor(192,253,123));
            //palette.setBrush(QPalette::Background, QBrush(QPixmap(":/background.png")));
            widget>setPalette(palette);

- 怎样把标题栏去掉

		window.setWindowFlags( Qt::FramelessWindowHint); //即可
		setWindowFlags(Qt::FramelessWindowHint | Qt::WindowStaysOnTopHint); //可前端显示

- 设置 QWidget 不可最大化

		this -> setFixedSize( 480 , 800 );

- 设置窗体透明

		this.setWindowOpacity(0.5);

- 隐藏 qt 程序的任务栏条
		mainwindow.setWindowFlags( Qt::Tool | Qt::StaysOnTopHint ); //保持在最前面可选
 

- 窗体实现
	- 一. 背景刷成黑色, 前景色设为白色。
		- 方法1、paltette 方式，经测试，该方法不会影响到其他控件, 推荐使用 

                QPalette bgpal = palette();
                bgpal.setColor (QPalette::Background, QColor (0, 0 , 0, 255));
                //bgpal.setColor (QPalette::Background, Qt::transparent);
                bgpal.setColor (QPalette::Foreground, QColor (255,255,255,255)); setPalette (bgpal);

		- 方法2、stylesheet 方式 
			- 影响子控件的方法是：

					setStyleSheet ("background-color: rgb(0,0,0);color: rgb(255,255,255);");
			- 不影响子控件的方法是：

					setStyleSheet ("venus--TitleBar {background-color: rgb(0,0,0);color: rgb(255,255,255);}");

	- 二. 圆角控件 用stylesheet 方式

			setStyleSheet ("border:2px groove gray;border-radius:10px;padding:2px 4px;");

	- 三. 圆角窗口 RoundRectWin::RoundRectWin() { QPalette p = palette(); QPixmap img("roundrect.png");

            QBitmap mask("roundrect_mask.png");
            p.setBrush(QPalette::Window, QBrush(img));
            setPalette(p);
            setMask(mask);
            resize(img.size());
            //setWindowFlags(Qt::FramelessWindowHint);// 这句会去掉标题栏 } 注意:mask 的图多余部分设为白色

	- 四. 半透明窗口
		- 1、窗口整体透明，但是窗体上的控件不透明。 通过设置窗体的背景色来实现，将背景色设置为全透。

                QPalette pal = palette();
                pal.setColor(QPalette::Background, QColor(0x00,0xff,0x00,0x00)); setPalette(pal); 
				//另外一种方法
	 			setAttribute(Qt::WA_TranslucentBackground, true) ；
		- 2、窗口及其上面的控件都半透明：

				setWindowOpacity(0.7)

				//注意不能够setWindowFlags(Qt::FramelessWindowHint); 

		- 3、窗口整体不透明，局部透明：

                //在Paint 事件中使用Clear 模式绘图。
                void TestWindow::paintEvent( QPaintEvent* )
                { 
                    QPainter p(this);
                    p.setCompositionMode( QPainter::CompositionMode_Clear ); p.fillRect( 10, 10, 300, 300, Qt::SolidPattern ); 
                }

	- 五. 控制QPixmap 的alpha

            QPixmap temp(pixmapTop.size()); temp.fill(Qt::transparent);
            QPainter p(&temp);
            p.setCompositionMode(QPainter::CompositionMode_Source);
            p.drawPixmap(0, 0, pixmapTop);
            p.setCompositionMode(QPainter::CompositionMode_DestinationIn);
            p.fillRect(temp.rect(), QColor(0, 0, 0, alpha)); //--lable 显示前景图片 ui->label->setScaledContents(true);
            ui->label->setPixmap(temp);

	- 六. layout 的边界 
	
    		layout->setMargin (0);

- 鼠标移入事件

		virtual void    enterEvent ( QEvent * event )