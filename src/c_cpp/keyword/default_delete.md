## c++11 类默认函数的控制："=default" 和 "=delete"函数

	#define _CRT_SECURE_NO_WARNINGS
	
	#include <iostream>
	#include <string>
	#include <vector>
	#include <map>
	
	//c++11 类默认函数的控制："=default" 和 "=delete"函数
	
	/*
	C++ 的类有四类特殊成员函数，它们分别是：默认构造函数、析构函数、拷贝构造函数以及拷贝赋值运算符。
	这些类的特殊成员函数负责创建、初始化、销毁，或者拷贝类的对象。
	如果没有显式地为一个类定义某个特殊成员函数，而又需要用到该特殊成员函数时，则编译器会隐式的为这个类生成一个默认的特殊成员函数。
	*/
	
	// C++11 标准引入了一个新特性："=default"函数。只需在函数声明后加上“=default;”，就可将该函数声明为 "=default"函数，编译器将为显式声明的 "=default"函数自动生成函数体。
	class X
	{ 
	public: 
	    X() = default; //该函数比用户自己定义的默认构造函数获得更高的代码效率
	    X(int i)
	    { 
	        a = i; 
	    }
	
	private: 
	    int a; 
	}; 
	
	X obj;
	
	// "=default"函数特性仅适用于类的特殊成员函数，且该特殊成员函数没有默认参数。
	class X1
	{
	public:
	    int f() = default;      // err , 函数 f() 非类 X 的特殊成员函数
	    X1(int, int) = default;  // err , 构造函数 X1(int, int) 非 X 的特殊成员函数
	    X1(int = 1) = default;   // err , 默认构造函数 X1(int=1) 含有默认参数
	};
	
	// "=default"函数既可以在类体里（inline）定义，也可以在类体外（out-of-line）定义。
	class X2
	{
	public:
	    X2() = default; //Inline defaulted 默认构造函数
	    X2(const X&);
	    X2& operator = (const X&);
	    ~X2() = default;  //Inline defaulted 析构函数
	};
	
	X2::X2(const X&) = default;  //Out-of-line defaulted 拷贝构造函数
	X2& X2::operator= (const X2&) = default;   //Out-of-line defaulted  拷贝赋值操作符
	
	
	// 为了能够显式的禁用某个函数，C++11 标准引入了一个新特性："=delete"函数。程序员只需在函数声明后上“=delete;”，就可将该函数禁用。
	class X3
	{
	public:
	    X3();
	    X3(const X3&) = delete;  // 声明拷贝构造函数为 deleted 函数
	    X3& operator = (const X3 &) = delete; // 声明拷贝赋值操作符为 deleted 函数
	};
	
	// "=delete"函数特性还可用于禁用类的某些转换构造函数，从而避免不期望的类型转换
	class X4
	{
	public:
	    X4(double)
	    {
	
	    }
	
	    X4(int) = delete;
	};
	
	// "=delete"函数特性还可以用来禁用某些用户自定义的类的 new 操作符，从而避免在自由存储区创建类的对象
	class X5
	{
	public:
	    void *operator new(size_t) = delete;
	    void *operator new[](size_t) = delete;
	};
	
	
	void mytest()
	{
	    X4 obj1;
	    X4 obj2=obj1;   // 错误，拷贝构造函数被禁用
	
	    X4 obj3;
	    obj3=obj1;     // 错误，拷贝赋值操作符被禁用
	
	    X5 *pa = new X5;      // 错误，new 操作符被禁用
	    X5 *pb = new X5[10];  // 错误，new[] 操作符被禁用
	
	    return;
	}
	
	
	int main()
	{
	    mytest();
	
	    system("pause");
	    return 0;
	}