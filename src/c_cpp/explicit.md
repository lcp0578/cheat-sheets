## C++ explicit
- explicit关键字用来修饰类的构造函数，被修饰的构造函数的类，不能发生相应的隐式类型转换，只能以显示的方式进行类型转换。
- 示例

        #include<cstring>
        #include<string>
        #include<iostream>

        class Explicit
        {
            private:

            public:
                Explicit(int size)
                {
                    std::cout << " the size is " << size << std::endl;
                }
                Explicit(const char* str)
                {
                    std::string _str = str;
                    std::cout << " the str is " << _str << std::endl;
                }

                Explicit(const Explicit& ins)
                {
                    std::cout << " The Explicit is ins" << std::endl;
                }

                Explicit(int a,int b)
                {
                    std::cout << " the a is " << a  << " the b is " << b << std::endl;
                }
        };

        int main()
        {
            Explicit test0(15);
            Explicit test1 = 10;// 隐式调用Explicit(int size)

            Explicit test2("RIGHTRIGHT");
            Explicit test3 = "BUGBUGBUG";// 隐式调用Explicit(const char* str)

            Explicit test4(1, 10);
            Explicit test5 = test1;
        }
- 原因
上面的程序虽然没有错误，但是对于Explicit test1 = 10;和Explicit test2 = "BUGBUGBUG";这样的句子，把一个int类型或者const char*类型的变量赋值给Explicit类型的变量看起来总归不是很好，并且当程序很大的时候出错之后也不容易排查。所以为了禁止上面那种隐式转换可能带来的风险，一般都把类的单参构造函数声明的显示调用的，就是在构造函数加关键字`explicit`。如下：

        #include<cstring>
        #include<string>
        #include<iostream>

        class Explicit
        {
            private:

            public:
                explicit Explicit(int size)
                {
                    std::cout << " the size is " << size << std::endl;
                }
                explicit Explicit(const char* str)
                {
                    std::string _str = str;
                    std::cout << " the str is " << _str << std::endl;
                }

                Explicit(const Explicit& ins)
                {
                    std::cout << " The Explicit is ins" << std::endl;
                }

                Explicit(int a,int b)
                {
                    std::cout << " the a is " << a  << " the b is " << b << std::endl;
                }
        };

        int main()
        {
            Explicit test0(15);
            Explicit test1 = 10;// 无法调用

            Explicit test2("RIGHTRIGHT");
            Explicit test3 = "BUGBUGBUG"; // 无法调用

            Explicit test4(1, 10);
            Explicit test5 = test0;
        }