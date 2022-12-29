## Qt互斥锁QMutex、QMutexLocker的使用
- 互斥锁（`QMutex`）在使用时需要在进入和结束的时候使用对应的函数锁定和解锁。
- `QMutexLocker`通常创建为局部变量，`QMutexLocker`在创建时传入一个并未锁定（若是锁定可用`relock`重新锁定或`unlock`解锁）的`QMutex`指针变量，并且会将`QMutex`变量锁定，在释放时会将`QMutex`变量解锁。（`QMutexLocker`创建时将传入的`QMutex`锁定，释放时将传入的`QMutex`解锁）
- QMutex的使用

		void CThread::run()
		{
	        //互斥锁锁定
	        m_mutex->lock();
	        //输出当前线程的线程ID
	        qDebug() << QThread::currentThreadId();
	        //互斥锁解锁
	        m_mutex->unlock();
		}

- QMutexLocker的使用

		void CThread::run()
		{
		    //创建QMutexLocker的局部变量，并将类中互斥锁指针传入（此处互斥锁被locker锁定）
		    QMutexLocker locker(m_mutex);
		    qDebug() << QThread::currentThreadId();
		    //当locker作用域结束locker将互斥锁解锁
		}