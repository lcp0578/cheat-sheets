## QProcess启动外部程序
- QProcess类提供了三个接口函数用于启动外部程序

		QProcess::Start(***)
		void	start(const QString &program, const QStringList &arguments, QIODevice::OpenMode mode = ReadWrite)
		void	start(const QString &command, QIODevice::OpenMode mode = ReadWrite)
		void	start(QIODevice::OpenMode mode = ReadWrite)
		
		Qprocess::StartDetached(***);
		bool	startDetached(const QString &program, const QStringList &arguments, const QString &workingDirectory = QString(), qint64 *pid = nullptr)
		bool	startDetached(const QString &command)
		
		Qprocess::Execute(***);
		int	execute(const QString &program, const QStringList &arguments)
		int	execute(const QString &command)
	- 利用Process::Start()调用外部程序时，若使用bool waitForFinished(int msecs = 30000)等待该进程结束，则需要注意时间参数的设置，若程序执行时间较长，需要设置为-1，否则会出现程序启动失败的现象。
	- 各启动接口的比较：
		- start()函数方便进行多个程序的并行，但是外部程序的输出需要自己读写并输出的主窗口，输出法方法见后面，具有灵活性，自己可控的特点。
		- execute()函数智能串行运行外部程序，优势在于自动打印外部程序控制台输出到主程序窗口。
- 并行启动多个外部程序
	- 或者是多次启动同一个程序,可以采用start()或者startDetaached()函数启动。不能使用execute()并行启动多个程序，execute()采用串行的方式执行，只有执行完被启动的程序以后才会执行后续代码。
	- 方法：首先利用start()接口依次启动多个外部程序的进程，启动完成之后再调用等待结束函数,伪代码如下：

			QProcess1.start(test1.exe);
			QProcess2.start(test1.exe);
			
			process1.WaitForFinished();
			process2.WaitForFinished();
- 怎样获取外部程序输出并输出到主窗口或者写到日志
	- 若使用execute()启动外部程序，则会自动打印信息到主程序控制台窗口；
	- 若使用start()启动外部程序，则需要人为读写外部程序控制台输出。

			//注意：下面是伪代码，并不保证索引英语名词都正确
			a_main()
			{
			    std::cout<<"extern output test"<<std::endl;
			}
			
			class A : public QObject
			{
			    public:
			    
			    Qprocess *Pro_;
			    
			    void StartExternApp()
			    {
			        Pro_=new Process(this);
			        pro_->start(command,params);
			        //建立与外部子模块标准输出的连接
					connect(process_, SIGNAL(readyRead()), this, SLOT(output()));
			
			        Pro_->WaitForFinished(-1);
			        
			        delete Pro_;
			    }
			    
			    private slots://add slots
			    output()
			    {
			        QByteArray byteArray = process_->readAllStandardOutput();
				    QString str = QString::fromLocal8Bit(byteArray);
				    QStringList strList=str.split(QRegExp("[\r\n]"), QString::SkipEmptyParts);
			
			    	for (int i = 0; i < strList.size(); ++i)
			    	{
			    		qDebug() << strList[i];
			    	}
			    }
			    
			}
- 工作目录的设置
	- 这个主要影响到程序里面的相对路径，若程序使用相对路径读取程序下层文件夹里面的文件时，需要更改。
	- 使用start()可以设置外部程序的工作目录；
	- 使用execute()设置无效，只能继承主程序的工作目录，这就会导致一个问题，如果外部程序使用了相对路径访问自己程序所在文件夹的下层文件，将无法找到文件！
