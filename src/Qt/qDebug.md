## qDebug常用特性
#### `qDebug()`的最常用法
- 可以使用`qDebug`像使用`std::cou`t一样，直接在重定向操作符(`<<`)后面加上我们的字符串即可。

		qDebug() << "Hello" << 123;
- `qDebug()`还可以打印Qt中的基本类型，例如`QString`，`QByteArray`，`QDate`，`QRectF`，`QVariantHash`，`QFont`等等

		qDebug() << QString("Hello") << QPoint(10, 10);
- 以上的用法都必须包含头文件QDebug

		#include <QDebug>
#### 类C语言中的格式化输出
- 实际`qDebug`是包含在`qlongging.h`中的，因为我们的Qt程序，一般都会包含`QObject`，所以这里的头文件包含了`QObject`，从而我们就不必要额外的再添加`QDebug`头文件

		#include <QObject>

		int num = 20;
	    char str[20]="hello world";
	    qDebug("如果只写在括号里，是不需要QDebug头文件的 %d %s", num, str);
#### 为自定义类添加qDebug()打印
- 想要使用qDebug打印自定义类中的信息

		#include <QDebug>
		class Student
		{
		public:
		    Student(const QString& nm){name = nm;}
		    QString getName() const{return name;}
		private:
		    QString name;
		};
		QDebug operator<<(QDebug debug, const Student &c)
		{
		    debug << c.getName();
		    return debug;
		}
		int main(int argc, char *argv[])
		{
		    Student student("John");
		    qDebug() << student;
		}
#### 消除`qDebug()`打印
- 需要在你的pro文件里加上一行预定义宏即可。

		DEFINES += QT_NO_DEBUG_OUTPUT

#### 与qDebug()类似的函数
- `qWarning()`
- `qCritical()`
- `qFatal()`


	