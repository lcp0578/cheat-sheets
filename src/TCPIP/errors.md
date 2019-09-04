## TCP异常关闭总结
- 服务器端:
	- 情形一
		- Case：客户端程序正常运行的情况下，拔掉网线，杀掉客户端程序
		- 目的：模拟客户端死机、系统突然重启、网线松动或网络不通等情况
		- 结论：这种情况下服务器程序没有检测到任何异常，并最后等待“超时”才断开TCP连接

	- 情形二
		- Case：客户端程序发送很多数据包后正常关闭Socket并exit进程(或不退出进程)
		- 目的：模拟客户端发送完消息后正常退出的情况
		- 结论：这种情况下服务器程序能够成功接收完所有消息，并最后收到“对端关闭”（Recv返回零）消息

	- 情形三
		- Case：客户端程序发送很多数据包后不关闭Socket直接exit进程
		- 目的：模拟客户端程序退出而忘记关闭Socket的情况（比如通过Windows窗口的关闭图标退出进程，而没有捕获相应关闭事件做正常退出处理等）
		- 结论：这种情况下服务器程序能够收到部分TCP消息，然后收到“104: Connection reset by peer”（Linux下）或“10054: An existing connection was forcibly closed by the remote host”（Windows下）错误

	- 情形四
		- Case：客户端程序发送很多数据包的过程中直接Kill进程
		- 目的：模拟客户端程序崩溃或非正常方式结束进程（比如Linux下”kill -9″或Windows的任务管理器杀死进程）的情况
		- 结论：这种情况下服务器程序很快收到“104: Connection reset by peer”（Linux下）或“10054: An existing connection was forcibly closed by the remote host”（Windows下）错误

	- 情形五
		- Case：客户端程序发送很多数据包后正常关闭Socket并exit进程（或不退出进程）
		- 目的：模拟客户端正常关闭Socket后，服务器端在检查到TCP对端关闭前向客户端发送消息的情况
		- 结论：这种情况下服务器程序接收和发送部分TCP消息后，在Send消息时产生“32: Broken pipe”（Linux下）或“10053: An established connection was aborted by the software in your host machine”（Windows下）错误

	- 总结:
		- 当TCP连接的进程在忘记关闭Socket而退出、程序崩溃、或非正常方式结束进程的情况下（Windows客户端），会导致TCP连接的对端进程产生“104: Connection reset by peer”（Linux下）或“10054: An existing connection was forcibly closed by the remote host”（Windows下）错误
		- 当TCP连接的进程机器发生死机、系统突然重启、网线松动或网络不通等情况下，连接的对端进程可能检测不到任何异常，并最后等待“超时”才断开TCP连接
		- 当TCP连接的进程正常关闭Socket时，对端进程在检查到TCP关闭事件之前仍然向TCP发送消息，则在Send消息时会产生“32: Broken pipe”（Linux下）或“10053: An established connection was aborted by the software in your host machine”（Windows下）错误

- 客户端
	- 情形一
		- Case: 服务器端已经close了Socket，客户端再发送数据
		- 目的：测试在TCP对端进程已经关闭Socket时，本端进程还未检测到连接关闭的情况下继续向对端发送消息
		- 结论：第一包可以发送成功，但第二包发送失败，错误码为“10053: An established connection was aborted by the software in your host machine”（Windows下）或“32: Broken pipe，同时收到SIGPIPE信号”（Linux下）错误
	- 情形二
		- Case: 服务器端发送数据到TCP后close了Socket，客户端再发送一包数据，然后接收消息
		- 目的：测试在TCP对端进程发送数据后关闭Socket，本端进程还未检测到连接关闭的情况下发送一包消息，并接着接收消息
		- 结论：客户端能够成功发送第一包数据（这会导致服务器端发送一个RST包 <已抓包验证>），客户端再去Recv时，对于Windows和Linux程序有如下不同的表现：
			- Windows客户端程序：Recv失败，错误码为“10053: An established connection was aborted by the software in your host machine”
			- Linux客户端程序：能正常接收完所有消息包，最后收到正常的对端关闭消息（这一点与Window下不一样）
	- 情形三
		- Case： 服务器端在TCP的接收缓冲区中还有未接收数据的情况下close了Socket，客户端再收包
		- 目的：测试在TCP的接收缓冲区中还有未接收数据的情况下关闭Socket时，对端进程是否正常
		- 结论：这种情况服务器端就会向对端发送RST包，而不是正常的FIN包（已经抓包证明），这就会导致客户端提前（RST包比正常数据包先被收到）收到“10054: An existing connection was forcibly closed by the remote host”（Windows下）或“104: Connection reset by peer”（Linux下）错误

	- 总结:
		- 当TCP连接的对端进程已经关闭了Socket的情况下，本端进程再发送数据时，第一包可以发送成功（但会导致对端发送一个RST包过来）：
之后如果再继续发送数据会失败，错误码为“10053: An established connection was aborted by the software in your host machine”（Windows下）或“32: Broken pipe，同时收到SIGPIPE信号”（Linux下）错误；
之后如果接收数据，则Windows下会报10053的错误，而Linux下则收到正常关闭消息
		- TCP连接的本端接收缓冲区中还有未接收数据的情况下close了Socket，则本端TCP会向对端发送RST包，而不是正常的FIN包，这就会导致对端进程提前（RST包比正常数据包先被收到）收到“10054: An existing connection was forcibly closed by the remote host”（Windows下）或“104: Connection reset by peer”（Linux下）错误