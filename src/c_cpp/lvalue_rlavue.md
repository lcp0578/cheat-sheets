## C++中左值和右值
> https://nettee.github.io/posts/2018/Understanding-lvalues-and-rvalues-in-C-and-C/
#### 定义
- 左值 (lvalue, locator value) 表示了一个占据内存中某个可识别的位置（也就是一个地址）的对象。
- 右值 (rvalue) 则使用排除法来定义。一个表达式不是 **左值** 就是 **右值** 。 那么，右值是一个 不 表示内存中某个可识别位置的对象的表达式。

#### 可修改的左值
- 左值一开始在 C 中定义为“可以出现在赋值操作左边的值”。然而，当 ISO C 加入 const 关键字后，这个定义便不再成立。毕竟：

		const int a = 10; // 'a' 是左值
		a = 10;           // 但不可以赋值给它！
于是定义需要继续精化。不是所有的左值都可以被赋值。可赋值的左值被称为 可修改左值 (modifiable lvalues) 。
- C99标准定义可修改左值为：
	> […] 可修改左值是特殊的左值，不含有数组类型、不完整类型、const 修饰的类型。如果它是 struct 或 union，它的成员都（递归地）不应含有 const 修饰的类型。

#### 左值与右值间的转换
- 通常来说，计算对象的值的语言成分，都使用右值作为参数。例如，两元加法操作符 '+' 就需要两个右值参数，并返回一个右值：

		int a = 1;     // a 是左值
		int b = 2;     // b 是左值
		int c = a + b; // + 需要右值，所以 a 和 b 被转换成右值
		               // + 返回右值
	在例子中，a 和 b 都是左值。因此，在第三行中，它们经历了隐式的 左值到右值转换 。除了数组、函数、不完整类型的所有左值都可以转换为右值。
- 那右值能否转换为左值呢？当然不能！根据左值的定义，这违反了左值的本质。【注1：右值可以显式地赋值给左值。之所以没有隐式的转换，是因为右值不能使用在左值应当出现的位置。】
- 不过，右值可以通过一些更显式的方法产生左值。例如，一元解引用操作符 '*' 需要一个右值参数，但返回一个左值结果。考虑这样的代码：

		int arr[] = {1, 2};
		int* p = &arr[0];
		*(p + 1) = 10;   // 正确: p + 1 是右值，但 *(p + 1) 是左值
- 相反地，一元取地址操作符 '&' 需要一个左值参数，返回一个右值：

		int var = 10;
		int* bad_addr = &(var + 1); // 错误: 一元 '&' 操作符需要左值参数
		int* addr = &var;           // 正确: var 是左值
		&var = 40;                  // 错误: 赋值操作的左操作数需要是左值
- 在 C++ 中 '&' 符号还有另一个功能——定义引用类型。引用类型又叫做“左值引用”。因此，不能将一个右值赋值给（非常量的）左值引用：

		std::string& sref = std::string();  // 错误: 非常量的引用 'std::string&' 错误地使用右值 'std::string` 初始化
- 常量的 左值引用可以使用右值赋值。因为你无法通过常量的引用修改变量的值，也就不会出现修改了右值的情况。这也使得 C++ 中一个常见的习惯成为可能：函数的参数使用常量引用接收参数，避免创建不必要的临时对象。

#### CV 限定的右值
- 如果我们仔细阅读 C++ 标准中关于左值到右值的转换的部分【注2：在新的 C++11 标准草稿的第 4.1 节】，我们会发现：
	> 一个非函数、非数组的类型 T 的左值可以转换为右值。 […] 如果 T 不是类类型【译注：类类型即 C++ 中使用类定义的类型，区别与内置类型】，转换后的右值的类型是 T 的 未限定 CV 的版本 (cv-unqualified version of T)。其他情况下，转换后的右值类型就是 T 本身。

- 什么叫做 “未限定 CV” (cv-unqualified) 呢？ CV 限定符 这个术语指的是 const 和 volatile 两个类型限定符。C++ 标准的 3.9.3 节写到：
	> 每个类型都有三个对应的 CV-限定类型版本： const 限定 、 volatile 限定 和 const-volatile 限定 版本。有或无 CV 限定的不同版本的类型是不同的类型，但写法和赋值需求都是相同的。

- 那么，这些又和右值有什么关系呢？在 C 中，只有左值有 CV 限定的类型，而右值从来没有。而在 C++ 中，类右值可以有 CV 限定的类型，但内置类型 (如 int) 则没有。考虑下面的例子：

		#include <iostream>
		
		class A {
		public:
		    void foo() const { std::cout << "A::foo() const\n"; }
		    void foo() { std::cout << "A::foo()\n"; }
		};
		
		A bar() { return A(); }
		const A cbar() { return A(); }
		
		
		int main()
		{
		    bar().foo();  // calls foo
		    cbar().foo(); // calls foo const
		}
	main 中的第二个函数调用实际上调用的是 A 中的 foo() const 函数，因为 cbar 返回的类型是 const A，这和 A 是两个不同的类型。这就是上面的引用中最后一句话所表达的意思。另外注意到，cbar 的返回值是一个右值，所以这是一个实际的 CV 限定的右值的例子。
#### C++11 的右值引用
- C++11 标准中引入的最强有力的特性就是右值引用，以及相关的 移动语义 (move semantics) 概念。
- 这篇文章的大部分内容都在解释：左值和右值的主要区别是，左值可以被修改，而右值不能。不过，C++11 改变了这一区别。在一些特殊的情况下，我们可以使用右值的引用，并对右值进行修改。
- 假设我们要实现一个“整数的 vector”，一些相关的函数可能是这样定义的：

		class Intvec
		{
		public:
		    explicit Intvec(size_t num = 0)
		        : m_size(num), m_data(new int[m_size])
		    {
		        log("constructor");
		    }
		
		    ~Intvec()
		    {
		        log("destructor");
		        if (m_data) {
		            delete[] m_data;
		            m_data = 0;
		        }
		    }
		
		    Intvec(const Intvec& other)
		        : m_size(other.m_size), m_data(new int[m_size])
		    {
		        log("copy constructor");
		        for (size_t i = 0; i < m_size; ++i)
		            m_data[i] = other.m_data[i];
		    }
		
		    Intvec& operator=(const Intvec& other)
		    {
		        log("copy assignment operator");
		        Intvec tmp(other);
		        std::swap(m_size, tmp.m_size);
		        std::swap(m_data, tmp.m_data);
		        return *this;
		    }
		private:
		    void log(const char* msg)
		    {
		        cout << "[" << this << "] " << msg << "\n";
		    }
		
		    size_t m_size;
		    int* m_data;
		};
- 这样，我们定义了基本的构造器、析构器、拷贝构造器 (copy constructor) 和拷贝赋值操作符 (copy assignment operator) 【注4：拷贝赋值操作符的实现是在考虑异常安全角度的规范写法。结合使用拷贝构造器和不会抛出异常的`std::swap`，可以保证在异常发生时不会出现未初始化的内存】。它们都有一个 logging 函数，让我们能知道是否调用了它们。

- 运行一个将 v1 的内容拷贝到 v2 的代码：

		Intvec v1(20);
		Intvec v2;
		
		cout << "assigning lvalue...\n";
		v2 = v1;
		cout << "ended assigning lvalue...\n";
- 运行输出的结果是：

		assigning lvalue...
		[0x28fef8] copy assignment operator
		[0x28fec8] copy constructor
		[0x28fec8] destructor
		ended assigning lvalue...
- 这是正常的结果，准确展示了 operator= 的内部过程。但假设我们要将一个右值赋值给 v2：

		cout << "assigning rvalue...\n";
		v2 = Intvec(33);
		cout << "ended assigning rvalue...\n";
- 虽然这里的例子中是赋值一个新创建的 `vector`，但它可以代表更一般的情况——创建了一个临时的右值，然后赋值给 v2 （例如当一个函数返回 vector 的情况）。我们会得到这样的输入：

		assigning rvalue...
		[0x28ff08] constructor
		[0x28fef8] copy assignment operator
		[0x28fec8] copy constructor
		[0x28fec8] destructor
		[0x28ff08] destructor
		ended assigning rvalue...
- 这看起来就要很多步骤了。特别是这里调用了额外的一对构造器/析构器，用来创建和销毁一个临时的对象。然而，在拷贝赋值操作符中，也创建和销毁了 另一个 临时的对象。这完全是多余的没有意义的工作。

- 不过现在你不需要多一个临时对象了。C++11 引入了右值引用，让我们可以实现“移动语义” (move semantics)，特别是可以实现“移动赋值操作符” (move assignment operator) 【注5：文章中一直将 operator= 叫做 “拷贝赋值操作符” (copy assignment operator)。在 C++11 中，区分这两个概念是很重要的】。我们可以为 Intvec 加上另一个 `operator=`：

		Intvec& operator=(Intvec&& other)
		{
		    log("move assignment operator");
		    std::swap(m_size, other.m_size);
		    std::swap(m_data, other.m_data);
		    return *this;
		}
- 符号 `&&` 代表了新的 右值引用 (rvalue reference) 。顾名思义，右值引用可以让我们创建对右值的引用。而且在调用结束后，右值引用就会被销毁。我们可以利用这个特性将右值的内部内容“偷”过来——因为我们不再需要使用这个右值对象了！这样得到的输出是：

		assigning rvalue...
		[0x28ff08] constructor
		[0x28fef8] move assignment operator
		[0x28ff08] destructor
		ended assigning rvalue...
- 由于将一个右值赋值给了 v2，移动赋值操作符被调用。虽然 Intvec(33) 仍然会创建一个临时对象，调用其构造器和析构器，但赋值操作符中的另一个临时对象不会再创建了。这个赋值操作符直接将右值的内部内容和自己的相交换，自己获得右值的内容，然后右值的析构器会销毁自己原先的内容，而这一内容已经不需要了。优雅。

- 再提醒一遍，这个例子只展示了移动语义和右值引用的冰山一角。你可以猜到，这实际上是一个复杂的话题，要考虑很多特殊情况和陷阱。我是想展示一个 C++ 中左值右值区别的一个很有趣的应用。编译器显然知道哪里是个右值，会在编译时选择调用合适的构造器。

#### 总结
- 即使不考虑左值和右值的问题，你也可以写很多 C++ 代码，然后把这些问题看作编译器某些错误警告中奇怪的行话。然而，这篇文章想表明，对这个问题有一些领悟的话，会使你能更深入地理解一些 C++ 代码，也更能弄懂一些 C++ 规范和语言专家的讨论。

- 另外，在新的 C++ 规范中，因为 C++11 引入了右值引用和移动语义，这个话题变得更重要了。要想真正理解这个语言的一些新特性，透彻地理解左值和右值就变得重要了。