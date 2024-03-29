## Qt 资源系统（Qt Resource System）
#### 1. Qt Resource System是什么？
- Qt 资源系统（Qt Resource System）是一种将图片、数据存储在二进制文件中的一套系统。
- 一般我们在程序中调用一张图片作为某个按钮的图标，如果替换成另一张同名的图片，那么程序运行时会加载新的图标。有这么一种情况，开发者不希望这些图标被修改或者图标文件丢了程序界面也就不能正常显示。
- 怎么办呢？我们可以把这些图片存储在可执行文件（如 QQ.exe 文件）中，即使删除了文件夹中的图标也不会影响界面图标的加载，因为图标数据已经以静态数据的方式保存在可执行文件中了。当然，代价就是编译出的可执行文件容量会增加。克服这个缺点的办法就是动态加载资源。
- Qt 资源系统是独立于平台的，因为无论是图片还是翻译文件等，都会被打包成二进制数据。你可以将这些二进制数据保存到可执行文件中，即“静态加载资源”；你也可以将这些二进制数据单独保存在一个文件中，即“动态加载资源”。

#### 2. qrc 文件 – 配置文件
- `qrc` 文件是基于 XML 格式的资源系统配置文件，该文件中指定了各种资源的信息。完整的将资源文件打包成二进制数据的流程是：写 `qrc` 文件 -> 用 `rcc` 编译 -> 二进制数据。
- 2.1 如何写 qrc 文件
	- 有两种方式：
		- 用 Qt Creator 写。
		- 纯手工写。
- 2.2 前缀、别名、语言环境
	- `qrc` 文件可以设置资源的前缀、别名和适用的语言环境，本质上就是分组而已。
- 2.3 两种资源路径
	- 假设已经加载好资源，访问这些资源的两种方式是：
		- 文件路径 `:/images/about.png`
		- URL `qrc:///images/about.png`
#### 3. 如何加载资源
- 加载资源有两种，一种是直接将资源数据存储在可执行文件中（静态方式），另一种是将资源数据存储在单独的二进制文件中并由可执行文件调用（动态方式）。
- 3.1 静态方式
	- 除了用 Qt Creator 在工程中添加 qrc 文件以外，需要在 pro 文件中加入 qrc 文件以便 qmake 能识别资源文件，一般这步会被自动添加。例如：

			RESOURCES = resource.qrc  
	- qmake 编译后会生成一个名为 qrc_resource.cpp 的文件，打开它我们会看到刚才我们的资源已经以静态数组的形式保存在了该文件中。最终该文件的数据会存入可执行文件中。
- 3.2 动态方式
	- 动态方式不需要写 pro 文件，需要手动用 rcc 工具编译 qrc 文件，然后用 QResource 类加载。
		-（1）手动用 rcc 工具编译 qrc 文件。

				rcc -binary resource.qrc -o resource.rcc 
		-（2）在程序中使用 QResource 类加载。

			QResource::registerResource("/path/resource.rcc");
		备注：rcc 工具的使用请参考官方文档“Resource Compiler (rcc)”。
#### 4. 在lib库中使用资源
- 一般我们写完 lib 库后提供给外界的就是一个库文件和头文件，所以无论你是在库中使用资源还是给外界提供资源，最好是采用静态方式。不然的话你还得额外提供 rcc 文件，即独立的二进制资源文件。
- 将资源存储于 lib 库中，需要调用 `Q_INIT_RESOURCE()` 宏来强制资源初始化。反之如果卸载资源则调用 `Q_CLEANUP_RESOURCE()`，例如：

		MyClass::MyClass():BaseClass()
		{
		   Q_INIT_RESOURCE(resources);
		   QFile file(":/myfile.dat");
		   ...
		}
	注意：在程序而不是库中，如果采用静态方式，不需要使用Q_INIT_RESOURCE() 和 Q_CLEANUP_RESOURCE()。