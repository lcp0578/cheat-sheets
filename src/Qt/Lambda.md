## Lambda表达式
- 因为lambda表达式是c++11的特性
	- Qt5.5及以上版本是支持的，Qt5.4及一下需要在.pro文件中加入

			CONFIG += c++11
- 语法形式如下：

		[capture](params) mutable ->return-type{statement}
		[函数对象参数] (操作符重载函数参数) mutable 或 exception 声明 -> 返回值类型 {函数体}
	- `[capture]`：捕捉列表，作用是将外部变量传入到 lambda 表达式的内部；也是 lambda 的引出符，编译器根据该引出符判断下面的代码是 lambda 表达式；
	- `(params)`：参数列表，作用是将参数传入到 lambda 表达式内部；如果没有参数可省略；
	- `mutable` ：可变参数修饰符，默认情况下外部变量传入到 lambda 表达式内部后是只读的，mutable 的作用就是将 lambda 表达式内部的只读变量 变成可读可写的；mutable 也可以省略；
	- `->return-type`：返回类型，如果 lambda 表达式没有返回值，也可以省略；
	- `{}`：函数体，和普通函数一样；
- `[capture]`：捕捉列表
	- `[]` 中可以是某个（些）具体的变量名，表示 lambda 表达式内部只能获取到 `[]` 中指定的变量：

		    int a = 10, b = 20;
		    /*
		     * 点击按钮的时候，执行 lambda 表达式
		     */
		    connect(btn, &QPushButton::clicked, 
		            // 如果 [] 中是某个具体的变量名，那 lambda 表达式
		            // 内部只能获取该变量，不能获取到其他变量;
		            [a] 
		            {
		                qDebug() << "a=" << a;
		                // 因为 [] 里只有一个变量 a，所以 lambda 内部只能获取
		                // 到变量a，不能获取到变量 b；下面输出语句编译会报错；
		//                qDebug() << "b=" << b; 
		            }
		            );
	- `[]` 中也可以同时存在多个变量名，以逗号分隔：

		    int a = 10, b = 20, c = 30;
		    /*
		     * 点击按钮的时候，执行 lambda 表达式
		     */
		    connect(btn, &QPushButton::clicked, 
		            [a, b, c] 
		            {
		                // lambda 表达式可以获取 [] 中的所有变量 
		                qDebug() << "a=" << a;
		                qDebug() << "b=" << b; 
		                qDebug() << "c=" << c; 
		            }
		            );
	- `[]` 中可以是 `=`，表示将外部所有局部变量，以及类中所有成员以值传递方式传入到 lambda 表达式内部：

		    int a = 10;
		    /*
		     * 点击按钮的时候，执行 lambda 表达式
		     */
		    connect(btn, &QPushButton::clicked, 
		            [=]
		            {
		                // [=] 表示 lambda 表达式内部可以获取外部所有局部变量，以及类中所有的成员；
		                qDebug() << "a=" << a;
		                btn->setText("123");
		            }
		            );
	- `[]` 中可以是 `this`，表示将类中所有成员，不包括局部变量，以值传递方式传入到 lambda 表达式内部：

		    int a = 10; // 局部变量
		    b = 20;     // 在头文件中定义的成员变量
		    /*
		     * 点击按钮的时候，执行 lambda 表达式
		     */
		    connect(btn, &QPushButton::clicked, 
		            [this]
		            {
		                // [this] 表示将类中所有成员，不包括局部变量，以值传递方式传入到 lambda 表达式,
		                // 所以在 lambda 表达式内部只能获取到 b，不能获取到 a；
		                qDebug() << "b=" << b;
						// qDebug() << "a=" << a;
		            }
		            );
	- `[]` 中可以是 `&`，表示将外部所有局部变量，不包括类中成员，以引用方式传递到 lambda 表达式内部：但是不建议使用 &，因为可能会出现内存问题
- `(params)`：参数列表
	- 按钮的 clicked 信号有一个参数,把这个参数传递到 lambda 表达式内部:

		    /*
		     * 点击按钮的时候，执行 lambda 表达式
		     */
		    connect(btn, &QPushButton::clicked, 
		            // 将 &QPushButton::clicked 信号的参数（bool isChecked）传入到 lambda 表达式内部
		            [=](bool isChecked)
		            {
		                qDebug() << "isChecked=" << isChecked;
		            }
		            );
- `mutable` ：可变参数修饰符

	    int a = 10; // 局部变量
	    /*
	     * 点击按钮的时候，执行 lambda 表达式
	     */
	    connect(btn, &QPushButton::clicked, 
	            [=]()mutable
	            {
	                qDebug() << "a=" << a;
	                // mutable：可变参数修饰符，如果没有 mutable 关键字，传入 lambda 内部
	                // 的变量是只读的，下面赋值的语句会报错；
	                // 使用 mutable 之后，变量就会变成可读可写的，才可以修改变量的值；
	                a += 10;
	            }
	            );
- `->return-type`：返回类型
	- 前面说到 `[=]` 是将外部变量 以值传递的方式 传入到 lambda 表达式内部，值传递的变量在 lambda 表达式内部修改之后，外部变量的值不会变；
	- 如果想在 lambda 表达式内部修改外部变量的值，需要在修改之后再将变量返回出去；