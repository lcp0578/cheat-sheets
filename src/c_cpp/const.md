## const 关键字
> C++ const 允许指定一个语义约束，编译器会强制实施这个约束，允许程序员告诉编译器某值是保持不变的。如果在编程中确实有某个值保持不变，就应该明确使用const，这样可以获得编译器的帮助。

- const修饰普通类型的变量

		const int  a = 7; //a 被编译器认为是一个常量，其值不允许修改。
        
        #include<iostream>
        using namespace std;
        int main(void)
        {
            const int  a = 7;
            int  *p = (int*)&a; //取变量的地址并转换赋值给 指向 int 的指针
            *p = 8;
            cout<<a; //结果：7
            system("pause");
            return 0;
        }
        //volatile 关键字跟 const 对应相反，是易变的，容易改变的意思。所以不会被编译器优化，编译器也就不会改变对 a 变量的操作。
        #include<iostream>
        using namespace std;
        int main(void)
        {
            volatile const int  a = 7;
            int  *p = (int*)&a;
            *p = 8;
            cout<<a; //结果：8
            system("pause");
            return 0;
        }
- const 修饰指针变量
	- const 修饰指针指向的内容，则内容为不可变量。
	
    		const int *p = 8; //指针指向的内容 8 不可改变。简称左定值，因为 const 位于 * 号的左边。
	- const 修饰指针，则指针为不可变量。
	
			int a = 8;
            int* const p = &a;
            *p = 9; // 正确
            int  b = 7;
            p = &b; // 错误
            //对于 const 指针 p 其指向的内存地址不能够被改变，但其内容可以改变。简称，右定向。因为 const 位于 * 号的右边。
	-  const 修饰指针和指针指向的内容，则指针和指针指向的内容都为不可变量。

			int a = 8;
			const int * const  p = &a; //const p 的指向的内容和指向的内存地址都已固定，不可改变。

- const参数传递和函数返回值
	- 值传递的 const 修饰传递，一般这种情况不需要 const 修饰，因为函数会自动产生临时变量复制实参值。

            #include<iostream>
            using namespace std;
            void Cpf(const int a)
            {
                cout<<a;
                // ++a;  是错误的，a 不能被改变
            }

            int main(void)

            {
                Cpf(8);
                system("pause");
                return 0;
            }
	- 当 const 参数为指针时，可以防止指针被意外篡改。

            #include<iostream>
            using namespace std;
            void Cpf(int *const a)
            {
                cout<<*a<<" ";
                *a = 9;
                int b = 10;
                a = &b; //错误，不能修改
            }

            int main(void)
            {
                int a = 8;
                Cpf(&a);
                cout<<a; // a 为 9
                system("pause");
                return 0;
            }
	- 自定义类型的参数传递，需要临时对象复制参数，对于临时对象的构造，需要调用构造函数，比较浪费时间，因此我们采取 const 外加引用传递的方法。并且对于一般的 int、double 等内置类型，我们不采用引用的传递方式。

            #include<iostream>
            using namespace std;
            class Test
            {
            public:
                Test(){}
                Test(int _m):_cm(_m){}
                int get_cm()const
                {
                   return _cm;
                }

            private:
                int _cm;
            };

            void Cmf(const Test& _tt)
            {
                cout<<_tt.get_cm();
            }

            int main(void)
            {
                Test t(8);
                Cmf(t);
                system("pause");
                return 0;
            }
- 对于 const 修饰函数的返回值。
	- const 修饰内置类型的返回值，修饰与不修饰返回值作用一样。
	- const 修饰自定义类型的作为返回值，此时返回的值不能作为左值使用，既不能被赋值，也不能被修改。
	- const 修饰返回的指针或者引用，是否返回一个指向 const 的指针
- const修饰类成员函数
	- const 修饰类成员函数，其目的是防止成员函数修改被调用对象的值，如果我们不想修改一个调用对象的值，所有的成员函数都应当声明为 const 成员函数。
	- 注意：const 关键字不能与 static 关键字同时使用，因为 static 关键字修饰静态成员函数，静态成员函数不含有 this 指针，即不能实例化，const 成员函数必须具体到某一实例。

            #include<iostream>
            using namespace std;

            class Test
            {
            public:
                Test(){}
                Test(int _m):_cm(_m){}
                int get_cm()const
                {
                   return _cm;
                }

            private:
                int _cm;
            };

            void Cmf(const Test& _tt)
            {
                cout<<_tt.get_cm();
            }

            int main(void)
            {
                Test t(8);
                Cmf(t);
                system("pause");
                return 0;
            }
            //如果有个成员函数想修改对象中的某一个成员怎么办？这时我们可以使用 mutable 关键字修饰这个成员，mutable 的意思也是易变的，容易改变的意思，被 mutable 关键字修饰的成员可以处于不断变化中
            #include<iostream>
            using namespace std;
            class Test
            {
            public:
                Test(int _m,int _t):_cm(_m),_ct(_t){}
                void Kf()const
                {
                    ++_cm; // 错误
                    ++_ct; // 正确
                }
            private:
                int _cm;
                mutable int _ct;
            };

            int main(void)
            {
                Test t(8,7);
                return 0;
            }