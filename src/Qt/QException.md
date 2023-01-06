## QException 异常
- QUnhandledException
	- https://doc.qt.io/qt-5/qunhandledexception.html
- Q: What is benefit of inheriting from this class?
	- This is the corresponding part of the documentation:
		- The QException class provides a base class for exceptions that can transferred across threads.
	- In addition to that, it integrates pretty well with the QtConcurrent feature set, including QFuture.

- Q: What if we throw a class that does not inherit from the QException class?
	- This is the corresponding part of the documentation:
		- If you throw an exception that is not a subclass of QException, the Qt functions will throw a QUnhandledException in the receiver thread.
