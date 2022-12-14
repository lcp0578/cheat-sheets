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