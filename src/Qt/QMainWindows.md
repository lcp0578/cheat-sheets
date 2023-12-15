## 在QMainWindows中动态增加控件
- Note: Creating a main window without a central widget is not supported. You must
have a central widget even if it is just a placeholder.
	
		QWidget * centerWindow = new QWidget ;
	    this->setCentralWidget(centerWindow);
	    QVBoxLayout *mainLayout = new QVBoxLayout;
	    mainLayout->addWidget(splitter);
	    centerWindow->setLayout(mainLayout);
- 添加控件

		MainWindow::MainWindow(QWidget *parent)
		    : QMainWindow(parent)
		    , ui(new Ui::MainWindow)
		{
		    ui->setupUi(this);
		
		    QWidget * centerWindow = new QWidget ;
		    this->setCentralWidget(centerWindow);
		    QVBoxLayout *mainLayout = new QVBoxLayout;
		
		    m_videoWidget = new QVideoWidget;
		    mainLayout->addWidget(m_videoWidget);
		    centerWindow->setLayout(mainLayout);
		
		
		    m_mediaPlayer = new QMediaPlayer;
		    m_mediaPlayer->setSource(QUrl("D:/Qt515/rxft.mp4"));
		
		
		
		    m_mediaPlayer->setVideoOutput(m_videoWidget);
		
		    //m_videoWidget->show();
		    m_mediaPlayer->play();
		
		
		}