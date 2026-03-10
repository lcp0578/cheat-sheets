## Qt内存管理
- `setAttribute(QT::WA_DeleteOnClose,true);`
	- 在Qt中点击关闭按钮其实是调用了`setHidden(true)`，如果想及时清除内存即delete掉，此时可以在初始化阶段调用`setAttribute(QT::WA_DeleteOnClose,true);`
	- 但这里存在一个问题，如果该对象采用new 的方式创建的，此时会出现野指针的情况。这时需要加入第二种内存管理机制

- 智能指针`QPointer`， `QSharedDataPointer` ，`QSharedPointer`，`QWeakPointer`，`QScopedPointer`，`QScopedArrayPointer`
	- 说明：例如1中，对象已经被释放了，但是指针并没有手动设置成NULL，而且也无法手动设置为NULL，此时就用到了智能指针，`QPointer`会自动识别到对象是否已被释放掉了。
	- `QPointer` 已经过时，可以被`QWeakPointer`所替代，它不是线程安全的。
	- `QSharedDataPointer`:提供对数据的COPY-ON-WRITE以及浅拷贝，提供对数据（而不是指向数据的指针）的线程安全的保护。（注：提供对数据的线程安全保护要结合QsharedData来完成），它是线程安全的。
	- `QSharedPointer`:实现了引用计数的可共享资源的强类型指针，它是线程安全的。
	- `QWeakPointer`:实现了引用计数的可共享资源的弱类型指针，它是线程安全的。
	- `QScopedPointer`: 实现了非引用计数的独享资源的强类型指针，它是线程安全的。
	- `QScopedArrayPointer`:类似`QScopedPointer`，只不过是数组
	- 解释：
		- 强类型指针：在有它所指向的资源的所有权期间，永远不会放弃这个所有权。
		- 弱类型指针：在有它所指向的资源的所有权期间，允许外界释放其资源从而使其放弃这个所有权。
- QObjectCleanupHandler
	- 说明：类似智能指针，但是有点小区别，自己释放的时候将会带动他监控的对象一起释放
	- 此时cleanupHandler被释放掉了，那么所有的Obj也全部释放掉了

			void MainWindow::Test()
			{
			    QObjectCleanupHandler cleanupHandler;
			    for(int i = 0 ; i < 10; ++i){
			        QObject * obj = new QObject();
			        cleanupHandler.add(obj);
			        //do something..
			    }
			}
	- 清除所有的对象很简单

			cleanupHandler = new QObjectCleanupHandler();
			o1 = new QObject();
			o2 = new QObject();
			o3 = new QObject();
			cleanupHandler->add(o1);
			cleanupHandler->add(o2);
			cleanupHandler->add(o3);
			 
			
			cleanupHandler->clear();
- Qt内存管理机制中的规则
	- 一般将parent设置为this，此时当父窗口关闭时子窗口也会被关闭。
- C++处理方式
	- `new` 和 `delete对`应，数组情况需要挨个删除 `delete []array`
- 指针容器清除操作
	- 先调用qDelete()
	- 在调用clear()