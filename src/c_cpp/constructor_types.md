## 构造函数说明
> https://docs.microsoft.com/en-us/cpp/cpp/constructors-cpp?view=msvc-170

- 在声明类的实例时，编译器会根据重载决策的规则选择要调用的构造函数
	- 构造函数可以声明为 `inline` 、 `explicit` 、 `friend` 或 `constexpr` 。
	- 构造函数可以初始化已声明为 `const volatile` 或 `const` volatile 的对象。 构造函数完成后，对象变为 `const` 。
	- 若要在实现文件中定义构造函数，请为其指定一个限定名称，如任何其他成员函数： `Box::Box(){...}` 。
### 默认构造函数
- 默认构造函数 通常没有参数，但它们可以包含具有默认值的参数。

		class Box {
		public:
		    Box() { /*perform any required default initialization steps*/}
		
		    // All params have default values
		    Box (int w = 1, int l = 1, int h = 1): m_width(w), m_height(h), m_length(l){}
		...
		}
- 默认构造函数是一种 特殊的成员函数。 如果未在类中声明任何构造函数，则编译器将提供隐式 `inline` 的默认构造函数。
- 可以通过将其定义为 已删除，阻止编译器生成隐式默认构造函数

		// Default constructor
		Box() = delete;
### 复制构造函数
- 复制构造函数通过从同一类型的对象复制成员值来初始化对象。 
- 如果类成员都是所有简单类型（如标量值），则编译器生成的复制构造函数是足够的，无需自行定义。 如果你的类需要更复杂的初始化，则需要实现自定义复制构造函数。

		Box(Box& other); // Avoid if possible--allows modification of other.
	    Box(const Box& other);
	    Box(volatile Box& other);
	    Box(volatile const Box& other);
	
	    // Additional parameters OK if they have default values
	    Box(Box& other, int i = 42, string label = "Box");
- 定义复制构造函数时，还应将复制赋值运算符定义 (=) 。
- 可以通过将复制构造函数定义为已删除，阻止复制对象：

		Box (const Box& other) = delete;
### 移动构造函数
- 移动构造函数是一种特殊的成员函数，它将现有对象的数据的所有权转移到新的变量，而不复制原始数据。 
- 它采用右值引用作为其第一个参数，且后面的所有参数都必须具有默认值。 
- 移动构造函数可在传递大型对象时显著提高程序的效率。

		Box(Box&& other);
- 当对象由同一类型的另一个对象进行初始化时，编译器将选择一个移动构造函数（如果另一个对象将被销毁并且不再需要其资源）。
### 显示的设置构造函数

	class Box2
	{
	public:
	    Box2() = delete;
	    Box2(const Box2& other) = default;
	    Box2& operator=(const Box2& other) = default;
	    Box2(Box2&& other) = default;
	    Box2& operator=(Box2&& other) = default;
	    //...
	};
### constexpr 构造函数
- 如果满足以下条件，构造函数可以声明为 constexpr
	- 它既可以声明为默认值，也可以满足所有的 `constexpr` 函数 条件;
	- 类没有虚拟基类;
	- 每个参数都是 文本类型;
	- 主体不是函数 try 块;
	- 所有非静态数据成员和基类子类都将初始化;
	- 如果类 `(a)` 具有 `variant` 成员的联合，或 `(b)` 具有匿名联合，则只初始化其中一个联合成员;
	- 类类型的所有非静态数据成员和所有基类子数据表都具有 `constexpr` 构造函数
### initializer_list构造函数
- 如果构造函数采用 `std::initializer_list<T>` 作为参数，并且任何其他参数都具有默认参数，则当通过直接初始化对类进行实例化时，将在重载解析中选择该构造函数。 您可以使用 `initializer_list` 来初始化任何可接受它的成员。

		Box(initializer_list<string> list, int w = 0, int h = 0, int l = 0)
		        : m_contents(list), m_width(w), m_height(h), m_length(l)
		{}
		
		Box b{ "apples", "oranges", "pears" }; // or ...
    	Box b2(initializer_list<string> { "bread", "cheese", "wine" }, 2, 4, 6);
### Explicit构造函数

	explicit Box(int size): m_width(size), m_length(size), m_height(size){}
	
	class ShippingOrder
	{
	public:
	    ShippingOrder(Box b, double postage) : m_box(b), m_postage(postage){}
	
	private:
	    Box m_box;
	    double m_postage;
	}
	//elsewhere...
	    ShippingOrder so(42, 10.8);
- 这类转换可能在某些情况下很有用，但更常见的是，它们可能会导致代码中发生细微但严重的错误。 作为一般规则，应在构造函数 (和用户定义的运算符) 上使用 explicit 关键字，以防止这种隐式类型转换
### 构造顺序
- 1.按声明顺序调用基类和成员构造函数。
- 2.如果类派生自虚拟基类，则会将对象的虚拟基指针初始化。
- 3.如果类具有或继承了虚函数，则会将对象的虚函数指针初始化。 虚函数指针指向类中的虚函数表，确保虚函数正确地调用绑定代码。
- 4.它执行自己函数体中的所有代码。

		#include <iostream>
		
		using namespace std;
		
		class Contained1 {
		public:
		    Contained1() { cout << "Contained1 ctor\n"; }
		};
		
		class Contained2 {
		public:
		    Contained2() { cout << "Contained2 ctor\n"; }
		};
		
		class Contained3 {
		public:
		    Contained3() { cout << "Contained3 ctor\n"; }
		};
		
		class BaseContainer {
		public:
		    BaseContainer() { cout << "BaseContainer ctor\n"; }
		private:
		    Contained1 c1;
		    Contained2 c2;
		};
		
		class DerivedContainer : public BaseContainer {
		public:
		    DerivedContainer() : BaseContainer() { cout << "DerivedContainer ctor\n"; }
		private:
		    Contained3 c3;
		};
		
		int main() {
		    DerivedContainer dc;
		}

		Contained1 ctor
		Contained2 ctor
		BaseContainer ctor
		Contained3 ctor
		DerivedContainer ctor
- 如果基类没有默认构造函数，则必须提供派生类构造函数中的基类构造函数参数

		class Box {
		public:
		    Box(int width, int length, int height){
		       m_width = width;
		       m_length = length;
		       m_height = height;
		    }
		
		private:
		    int m_width;
		    int m_length;
		    int m_height;
		};
		
		class StorageBox : public Box {
		public:
		    StorageBox(int width, int length, int height, const string label&) : Box(width, length, height){
		        m_label = label;
		    }
		private:
		    string m_label;
		};
		
		int main(){
		
		    const string aLabel = "aLabel";
		    StorageBox sb(1, 2, 3, aLabel);
		}