## processEvents
- 定义

		void QCoreApplication::processEvents(QEventLoop::ProcessEventsFlags flags = QEventLoop::AllEvents)
- 文档
	- Processes some pending events for the calling thread according to the specified flags.
	- 根据指定的标志处理调用线程的一些挂起事件。
	- You can call this function occasionally when your program is busy performing a long operation (e.g. copying a file).
	- 当程序忙于执行长时间操作（例如复制文件）时，您可以偶尔调用此函数。
	- In the event that you are running a local loop which calls this function continuously, without an event loop, the DeferredDelete events will not be processed. This can affect the behaviour of widgets, e.g. QToolTip, that rely on DeferredDelete events to function properly. An alternative would be to call sendPostedEvents() from within that local loop.
	- Calling this function processes events only for the calling thread, and returns after all available events have been processed. Available events are events queued before the function call. This means that events that are posted while the function runs will be queued until a later round of event processing.