## enum Qt::ApplicationAttribute 枚举
- ig9icd64.dll 0xC0000005
		
		QApplication::setAttribute(Qt::AA_DisableShaderDiskCache);
		// 禁用磁盘上着色器程序二进制文件的缓存。默认情况下，Qt Quick、QPainter的OpenGL后端以及使用QOpenGLShaderProgram及其addCacheableShaderFromSource重载之一的任何应用程序都将在支持glProgramBinary（）的系统上的共享或每进程缓存存储位置使用基于磁盘的程序二进制缓存。
- 相关枚举定义
	- https://doc.qt.io/qt-5/qt.html#ApplicationAttribute-enum