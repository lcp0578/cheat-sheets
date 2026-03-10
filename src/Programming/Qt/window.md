## Qt窗口操作函数
- 示例

		w.setWindowFlags(w.windowFlags()& ~Qt::WindowMaximizeButtonHint& ~Qt::WindowMinimizeButtonHint); 
- 同时禁止最大化最小化按钮

		Qt::WindowMinMaxButtonsHint

- 也禁止关闭

		w.setWindowFlags(w.windowFlags() &~ (Qt::WindowMinMaxButtonsHint | Qt::WindowCloseButtonHint));
- Qt全屏显示函数        
	
		window.showFullScreen()//此方法只对顶级窗口有效，对子窗口无效

		w->setWindowFlags(Qt::window | Qt::FramelessWindowHint); //第一个Qt::window表示此widget是窗口类型，第二个参数使用无框架就是没有标题，状态栏和边框

 

         window.showMaximized(); //Qt最大化显示函数

         window.showMinimized(); //Qt最小化显示函数

         window.resize(x,y); //Qt固定尺寸显示函数
- 获取屏幕宽度和高度

		QApplication::desktop()->width();
		
		QApplication::desktop()->height();