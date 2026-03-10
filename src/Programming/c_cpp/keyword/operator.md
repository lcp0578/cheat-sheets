## operator关键字（重载操作符）
> operator是C++的关键字，它和运算符一起使用，表示一个运算符函数

### 操作符重载实现为类成员函数
- 重载的操作符在类体中被声明，声明方式如同普通成员函数一样，只不过他的名字包含关键字operator，以及紧跟其后的一个C++预定义的操作符。
- 声明

		class person{
		private:
		    int age;
		    public:
		    person(int a)
		    {
		       this->age=a;
		    }
		   inline bool operator == (const person &ps) const;
		};
- 实现

		inline bool person::operator==(const person &ps) const
		{
		 
		     if (this->age==ps.age)
		        return true;
		     return false;
		}
- 调用

		#include<iostream>
		using namespace std;
		int main()
		{
		  person p1(10);
		  person p2(20);
		  if(p1==p2)
		 	cout<<”the age is equal!”<<endl;
		  else
			cout<<”the age is not equal!”<<endl;
		 return 0;
		}
### 操作符重载实现为非类成员函数(全局函数)
- 对于全局重载操作符，代表左操作数的参数必须被显式指定
- 实现

		#include<iostream>
		using namespace std;
		class person
		{
		public:
			int age;
		public:
			person(int _age = 0)
				:age(_age)
			{
				cout << "person(int _age )"<< endl;
			}
		 
			person(person& ps)
			{
				*this = ps;
			}
		};
		bool operator==(person& p1, person const & p2)   //全局重载操作符==
		{
			if (p1.age == p2.age)
			{
				return true; 	 //满足要求
			}
			return false;
		}
		int main()
		{
			person rose;
			person jack;
			rose.age = 18;
			jack.age = 23;
			if (rose == jack)
			{
				cout << " is equal " << endl;
			}
			cout << "not equal " << endl;
			return 0;
		}
### 重载运算符的限制：
1. 只有C++预定义的操作符才可以被重载；
2. 对于内置类型的操作符，它的预定义不能改变，即不能改变操作符原来的功能；
3. 重载操作符不能改变他们的操作符优先级；
4. 重载操作符不能改变操作数的个数；
5. 除了对（）操作符外，对其他重载操作符提供缺省实参都是非法的；
### `operator double () const {}`的理解
- 隐式类型转换运算符只是一个样子奇怪的成员函数：operator 关键字，其后跟一个类型符号。你不用定义函数的返回类型，因为返回类型就是这个函数的名字。
- 例如为了允许Rational(有理数)类隐式地转换为double类型（在用有理数进行混合类型运算时，可能有用），你可以如此声明Rational类：

		class Rational {
		public:
		  ...
		  operator double() const;    // 转换Rational类成double类型
		};                                  
- 在下面这种情况下，这个函数会被自动调用：

		Rational r(1, 2);       // r 的值是1/2
		 
		double d = 0.5 * r;    // 转换 r 到double, 然后做乘法
