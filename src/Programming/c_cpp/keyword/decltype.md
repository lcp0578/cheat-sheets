## decltype
- `decltype` 是 C++11 新增的一个关键字，它和 `auto` 的功能一样，都用来在编译时期进行自动类型推导。
- `decltype` 是“declare type”的缩写，译为“声明类型”。
- 既然已经有了 `auto` 关键字，为什么还需要 `decltype` 关键字呢？
	- 因为 `auto` 并不适用于所有的自动类型推导场景，在某些特殊情况下 `auto` 用起来非常不方便，甚至压根无法使用，所以 `decltype` 关键字也被引入到 C++11 中。
- `auto` 和 `decltype` 关键字都可以自动推导出变量的类型，但它们的用法是有区别的：

		auto varname = value;
		decltype(exp) varname = value;

	其中，varname 表示变量名，value 表示赋给变量的值，exp 表示一个表达式。
	- `auto` 根据=右边的初始值 value 推导出变量的类型，
	- 而 `decltype` 根据 exp 表达式推导出变量的类型，跟=右边的 value 没有关系。

- 另外，`auto` 要求变量必须初始化，而 `decltype` 不要求。
	- 这很容易理解，`auto` 是根据变量的初始值来推导出变量类型的，如果不初始化，变量的类型也就无法推导了。
	- `decltype` 可以写成下面的形式：

			decltype(exp) varname;
	- exp 注意事项
		- 原则上讲，exp 就是一个普通的表达式，它可以是任意复杂的形式，但是我们必须要保证 exp 的结果是有类型的，不能是 `void`；例如，当 exp 调用一个返回值类型为 `void` 的函数时，exp 的结果也是 `void` 类型，此时就会导致编译错误。
#### decltype 推导规则
- 当使用 `decltype(exp)` 获取类型时，编译器将根据以下三条规则得出结果：
	- 如果 exp 是一个不被括号( )包围的表达式，或者是一个类成员访问表达式，或者是一个单独的变量，那么 `decltype(exp)` 的类型就和 exp 一致，这是最普遍最常见的情况。
	- 如果 exp 是函数调用，那么 `decltype(exp)` 的类型就和函数返回值的类型一致。
	- 如果 exp 是一个左值，或者被括号( )包围，那么 `decltype(exp)` 的类型就是 exp 的引用；假设 exp 的类型为 `T`，那么 `decltype(exp)` 的类型就是 `T&`。
- `decltype` 的推导规则的例子。
	- exp 是一个普通表达式：

			#include <string>
			using namespace std;
			 
			class Student
			{
			public:
			    static int total;
			    string name;
			    int age;
			    float scores;
			};
			 
			int Student::total = 0;
			 
			int main()
			{
			    int n = 0;
			    const int &r = n;
			    Student stu;
			 
			    decltype(n) a = n; //n 为 int 类型，a 被推导为 int 类型
			    decltype(r) b = n; //r 为 const int& 类型, b 被推导为 const int& 类型
			    decltype(Student::total) c = 0; //total 为类 Student 的一个 int 类型的成员变量，c 被推导为 int 类型
			    decltype(stu.name) url = "http://c.biancheng.net/cplus/"; //total 为类 Student 的一个string 类型的成员变量， url 被推导为 string 类型
			    
			    return 0;
			}
	这段代码很简单，按照推导规则 1，对于一般的表达式，decltype 的推导结果就和这个表达式的类型一致。

	- exp 为函数调用：

			//函数声明
			int& func_int_r(int, char); //返回值为 int&
			int&& func_int_rr(void); //返回值为 int&&
			int func_int(double); //返回值为 int
			 
			const int& fun_cint_r(int, int, int); //返回值为 const int&
			const int&& func_cint_rr(void); //返回值为 const int&&
			 
			//decltype类型推导
			int n = 100;
			decltype(func_int_r(100, 'A')) a = n; //a 的类型为 int&
			decltype(func_int_rr()) b = 0; //b 的类型为 int&&
			decltype(func_int(10.5)) c = 0; //c 的类型为 int
			 
			decltype(fun_cint_r(1,2,3)) x = n; //x 的类型为 const int &
			decltype(func_cint_rr()) y = 0; // y 的类型为 const int&&
			注意：exp 中调用函数时需要带上括号和参数，并不会真的去执行函数代码。
 

	- exp 是左值，或者被( )包围：

			using namespace std;
			 
			class Base
			{
			    public:
			    int x;
			};
			 
			int main()
			{
			    const Base obj;
			 
			    //带有括号的表达式
			    decltype(obj.x) a = 0; //obj.x 为类的成员访问表达式，符合推导规则一，a 的类型为 int
			    decltype((obj.x)) b = a; //obj.x 带有括号，符合推导规则三，b 的类型为 int&。
			 
			    //加法表达式
			    int n = 0, m = 0;
			    decltype(n + m) c = 0; //n+m 得到一个右值，符合推导规则一，所以推导结果为 int
			    decltype(n = n + m) d = c; //n=n+m 得到一个左值，符号推导规则三，所以推导结果为 int&
			 
			    return 0;
			}
	- 这里我们需要重点说一下左值和右值：
		- 左值是指那些在表达式执行结束后依然存在的数据，也就是持久性的数据；
		- 右值是指那些在表达式执行结束后不再存在的数据，也就是临时性的数据。有一种很简单的方法来区分左值和右值，对表达式取地址，如果编译器不报错就为左值，否则为右值。
### 实例代码


	// 详解decltype含义，decltype主要用途
	
	#include <iostream>
	#include <functional>
	#include <vector>
	#include <map>
	
	using namespace std;
	
	class CT{
	public:
		int i;
		int j;
	
	};
	
	int testf(){
		return 10;
	}
	
	const int &&myfunctest(void) {
		return 0;
	}
	
	
	template<typename T>
	class CT1{
	public:
		typename T::iterator iter; //迭代器类型
		void getbegin(T& tmpc){
			// ...
			iter = tmpc.begin();
		}
	};
	
	
	template<typename T>
	class CT2{
	public:
		//typename T::iterator iter; //迭代器类型
		decltype(T().begin) iter;  // const std::vector<int>() 表示 生成该类型的临时对象。调用了这个临时对象的begin（）
		void getbegin(T& tmpc){
			// ...
			iter = tmpc.begin();
		}
	};
	
	class A{
	public:
		A(){
			cout << "执行A构造函数" << endl;
		}
		~A(){
			cout << "执行A析构函数" << endl;
		}
	
		int func() const{
			cout << "执行A的func函数" << endl;
			return 0;
		}
	
		int m_i;
	};
	
	
	auto add(int a, int b)->decltype(a + b) {
		return a + b;
	};
	
	int tf(int &i){
		return i;
	}
	
	double tf(double &d){
		return d;
	}
	
	template<typename T>
	auto FuncTmp(T &tv)->decltype(tf(tv)){ // auto 在这里没有自动类型推断的含义，这里它只是返回类型后置语法的组成部分。
		return tf(tv);
	}
	
	
	template<typename T>
	T& mydouble(T &v1){
		v1 *= 2;
		return v1;
	}
	
	
	template<typename T>
	decltype(auto) mydouble1(T &v1){ // 把auto理解成要推导的类型。推导过程我们采用decltype
		v1 *= 2;
		return v1;
	}
	
	
	decltype(auto) tf1(){
		int i = 1;
		return i;
	}
	
	decltype(auto) tf2(){
		int i = 1;
		return (i);  // 加了括号导致返回 int& ， 但是要用这个返回的东西，则就会导致不可预料的后果
	}
	
	int main(int argc, const char * argv[]) {
		//一： decltype 含义和举例
		// decltype：用于推导类型，对于一个给定的变量名或者表达式，decltype能够告诉你该名字或者表达式的类型。
		// auto a = 10; //我们并不想用表达式的值初始化这个变量
		// C++ 11, decltype(说明符) ：主要作用：返回操作数的数据类型。
		// decltype 特点：
		//(a): decltype 的自动类型推断会发生在编译器（和auto一样）
		//(b): decltype 不会真正计算表达式的值
	
		//(1.1) decltype 后的圆括号中是个变量
		const int i = 0;
		const int &iy = i;
		auto j1 = i;  // j1 = int  //传值方式推断：引用属性、const属性都会被抛弃的， j1 = int
		decltype(i) j2 = 15;  // j2 = const int。如果decltype中是个变量，则变量的const属性会返回。
		decltype(iy) j3 = j2; // j3 = const int & 。如果decltype中是个变量，变量的const属性，以及引用属性&都会被返回。
		// decltype 很循规蹈矩，有啥返回啥。
	
		decltype(CT::i) a;      // a = int; 类访问表达式
		CT tmpct;
		decltype(tmpct) tmpct2; // tmpct2 = CT
		decltype(tmpct2.i) mv = 5;// int  类访问表达式
	
		int x = 1, y = 2;
		auto &&z = x; // x左值，auto = int& , z = int & 。万能引用
		decltype(z) && h = y; // int &h = y; 这里用到了引用折叠规则（折叠成了左值）。
	
		//(1.2) decltype 后的圆括号中非变量（是表达式）
		// decltype 会返回表达式的结果对应的类型。
		decltype(8) kkk = 5; // kkk int
		int ii = 0;
		int *pii = &ii;
		int &iiy = ii;
		decltype(iiy + 1) jj;  // j = int ，因为iiy + 1得到一个整形表达式
		decltype(pii) k;  // k = int* ; pii是个变量。
		*pii = 4;
		decltype(*pii) k2 = ii; // k2 = int&;
		// *pii是指针pii所指向的对象，而且能够给这个对象赋值，所以*pii是个左值
		// *pii是个表达式， 不是变量，因为它有*号
		// 如果表达式结果能够作为赋值语句左边的值，那decltype 后返回的就是个引用。
		// 所以这种情况要专门记：
		// decltype 后边是个非变量的表达式，并且表示能够作为等号左边内容，返回的就是一个类似int &
	
		decltype(ii) k3; // k3 = int ,ii 只是个变量
	
		decltype((i)) iy3 = ii; // 如果在变量名外w额外增加了一层或者多层括号（），那么编译器就会把这个变量当成一个表达式
		// 又因为变量可以作为等号左边的内容；最终iy3 = int &
	
		(ii) = 6;
	
		//结论 decltype((变量)) 的结果永远都是引用
	
		//(1.3) decltype 后的圆括号中是函数
		decltype(testf()) tmpv = 14; // tmpv的类型就是函数testf()的返回类型int。
		// 这里编译器没有去调用过函数testf().只是使用函数testf()的返回值类型作为tmpv的类型
	
		decltype(testf) tmpv2; // tmpv2 = int(void), 这个有返回类型，有参数类型，代表一种可调用对象。
	
		// 标准库function用法，类模板：
		function<decltype(testf)> ftmp = testf; //声明了一个function（函数）类型，用来代表一个可调用对象。
		// 它所代表的可调用对象是一个int(void);
		cout << ftmp() << endl; //10
	
		decltype(myfunctest()) myy = 0;  // myy = const int &&
	
		//二： decltype 主要用途
		//(2.1) 应付可变类型，一般decltype主要用途还是应用于模板编程中。
		using conttype = std::vector<int>; //定义类型别名
		conttype myarr = { 10, 30, 40 };  //定义该类型变量，现在myarr是个容器
		CT1<conttype> ct1;
		ct1.getbegin(myarr);
	
	
		//如果对于const 常量容器，上面的处理就会报错，
		//using conttype1 = const std::vector<int>; //定义类型别名
		//conttype1 myarr = {10,30,40};  //定义该类型变量，现在myarr是个容器
		//CT1<conttype1> ct1;
		//ct1.getbegin(myarr);
	
		//在C++98时代，这里要用模板偏特化来解决， 但c++ 11之后我们可以用 decltype 很容易解决这种问题
		//如上：class CT2 模板类的编写
	
		A().func(); // 生成了一个临时对象，调用临时对象的func()函数
		// 执行了A构造，A的func() ,A的析构函数
		//(const A()).func(); //本执行结果和上面一样
	
		decltype(A().func()) aaa; // aaa = int ,根本没构造过A类对象； 也没有调用过func()
	
		//(2.2) 通过变量表达式抽取变量类型
		vector<int> ac;
		ac.push_back(1);
		ac.push_back(2);
		vector<int>::size_type mysize = ac.size();
	
		cout << mysize << endl; // 2
	
		decltype(ac)::size_type mysize2 = mysize; //抽取ac的类型 vector<int> ,所以这行相当于 vector<int>::size_type mysize2 = mysize;
	
		cout << mysize2 << endl; // 2
	
		typedef decltype(sizeof(0)) size_t; // sizeof(0) 等价于 sizeof(int)
		size_t abc;
		abc = 1;
	
		//(2.3) auto 结合decltype构成返回类型后置语法
		//如上面的 add 函数
		int i11 = 19;
		cout << FuncTmp(i11) << endl; // 19
		double d = 28.1f;
		cout << FuncTmp(d) << endl; // 28.1
	
		//(2.4) decltype(auto) 用法  c++14才支持的语法
	
		//a). 用于函数返回类型
		int a11 = 100;
		mydouble(a11) = 20; // int &
		cout << a11 << endl; // a11 = 20;
		decltype(mydouble1(a11)) b11 = a; // b = int&
	
		//b). 用于变量声明中
	
		int xx = 1;
		const int &yy = 1;
		auto zz = yy; // z = int , const 和引用 都没了
		decltype(auto) zz2 = yy; // zz2 = const inyyt &;
		// auto 丢掉的东西（const,引用），能够通过decltype(auto) 捡回来。
		//c). 再说(x)
		int iii = 10;
		decltype((iii)) iiiy3 = iii; // iiiy = int &；
	
	
		decltype(tf1()) testa = 4; // int
	
		int aaaa = 1;
		decltype(tf2()) testb = aaaa; // testb = int &
	
		tf2() = 12;// 语法上没问题， 但是真这么做，会发生未预料行为。
	
		//三：总结
	
		system("pause");
	
		return 0;
	}

