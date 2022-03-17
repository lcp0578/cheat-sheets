## Qt自定义信号槽

	//!!! Qt5
	#include <QObject>
	////////// newspaper.h
	class Newspaper : public QObject
	{
	Q_OBJECT
	public:
	Newspaper(const QString & name) :
	m_name(name)
	{
	}
	void send()
	{
	emit newPaper(m_name);
	}
	signals:
	void newPaper(const QString &name);
	private:
	QString m_name;
	};
	////////// reader.h
	#include <QObject>
	#include <QDebug>
	class Reader : public QObject
	{
	Q_OBJECT
	public:
	Reader() {}
	void receiveNewspaper(const QString & name)
	{
	qDebug() << "Receives Newspaper: " << name;
	}
	};
	////////// main.cpp
	#include <QCoreApplication>
	#include "newspaper.h"
	#include "reader.h"
	int main(int argc, char *argv[])
	{
	    QCoreApplication app(argc, argv);
	    Newspaper newspaper("Newspaper A");
	    Reader reader;
	    QObject::connect(&newspaper, &Newspaper::newPaper,
	        &reader, &Reader::receiveNewspaper);
	    newspaper.send();
	    return app.exec();
	}
### 关于Q_OBJECT宏
- 只有继承了QObject类的类，才具有信号槽的能力。所以，为了使用信号槽，必须继承QObject。
- 凡是QObject类（不管是直接子类还是间接子类），都应该在第一行代码写上Q_OBJECT。不管是不是使用信号槽，都应该添加这个宏。这个宏的展开将为我们的类提供信号槽机制、国际化机制以及 Qt 提供的不基于 C++ RTTI 的反射能力。因此，如果你觉得你的类不需要使用信号槽，就不添加这个宏，就是错误的。其它很多操作都会依赖于这个宏。
- 注意，这个宏将由 moc（我们会在后面章节中介绍 moc。这里你可以将其理解为一种预处理器，是比 C++ 预处理器更早执行的预处理器。） 做特殊处理，不仅仅是宏展开这么简单。moc 会读取标记了 Q_OBJECT 的头文件，生成以 moc_ 为前缀的文件，比如 newspaper.h 将生成 moc_newspaper.cpp。你可以到构建目录查看这个文件，看看到底增加了什么内容。
- 注意，由于 moc 只处理头文件中的标记了Q_OBJECT的类声明，不会处理 cpp 文件中的类似声明。因此，如果我们的Newspaper和Reader类位于 main.cpp 中，是无法得到 moc 的处理的。解决方法是，我们手动调用 moc 工具处理 main.cpp，并且将 main.cpp 中的#include "newspaper.h"改为#include "moc_newspaper.h"就可以了。不过，这是相当繁琐的步骤，为了避免这样修改，我们还是将其放在头文件中。许多初学者会遇到莫名其妙的错误，一加上Q_OBJECT就出错，很大一部分是因为没有注意到这个宏应该放在头文件中。

### 自定义信号槽需要注意的事项：
- 发送者和接收者都需要是`QObject`的子类（当然，槽函数是全局函数、Lambda 表达式等无需接收者的时候除外）
- 使用 signals 标记信号函数，信号是一个函数声明，返回 `void`，不需要实现函数代码
- 槽函数是普通的成员函数，作为成员函数，会受到 `public`、`private`、`protected` 的影响
- 使用 `emit` 在恰当的位置发送信号
- 使用`QObject::connect(`)函数连接信号和槽