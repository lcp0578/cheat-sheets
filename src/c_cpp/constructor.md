## 构造函数后面加:冒号的作用
- 在C++类的构造函数中经常会看到如下格式的写法：

		MyWindow::MyWindow(QWidget* parent , Qt::WindowFlags flag) : QMainWindow(parent,flag)
	上述语句中单冒号(:)的作用是表示后面是初始化列表
- 使用场景
	- 1、对父类进行初始化
	调用格式为“子类构造函数 : 父类构造函数”，如下，其中QMainWindow是MyWindow的父类：

			MyWindow::MyWindow(QWidget* parent , Qt::WindowFlags flag) : QMainWindow(parent,flag)
	- 2、对类成员进行初始化

	调用格式为“构造函数 : A(初始值),B(初始值),C(初始值)……”，如下，其中A、B、C分别是类的成员变量：

            class rectangle //头文件中类定义
            {
            public:
                rectangle( int pointX, int pointY, int Width, int Length );
            private:
                CPoint m_point;
                int m_Width;
                int m_Length;
            };

            rectangle::rectangle(int pointX, int pointY, int Width, int Length) : m_point(pointX,pointY),m_Width(Width),m_Length(Length)//源文件中构造函数实现
            {
                todo......
            }
	当然，上面构造函数的实现与下面的写法等价

            rectangle::rectangle(int pointX, int pointY, int Width, int Length)//源文件中构造函数实现
            {
                m_point.X = pointX;
                m_point.Y = pointY;
                m_Width   = Width;
                m_Length  = Length;
                todo......
            }
	- 3、对类的const成员变量进行初始化

	由于const成员变量的值无法在构造函数内部初始化，因此只能在变量定义时赋值或使用初始化列表赋值。

- 对于2、3中的应用场景，有以下两点说明：
	- 1、构造函数列表初始化执行顺序与成员变量在类中声明顺序相同，与初始化列表中语句书写先后无关。
	- 2、相对于在构造函数中赋值，初始化列表执行效率更高。