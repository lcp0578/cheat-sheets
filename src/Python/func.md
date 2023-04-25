## 函数
- 定义

		def functionname( parameters ):
   			function_suite
   			return [expression]#不带表达式的 return 相当于返回 None。
- 类型检查 `isinstance (num1,(int ,float)`
- 返回多个值

		def  division ( num1, num2 ):
        	a = num1 % num2
        	b = (num1-a) / num2
        	return b , a

		num1 , num2 = division(9,4)
		tuple1 = division(9,4) #Python 一次接受多个返回值的数据类型就是元组。
		print (num1,num2)
		print (tuple1)
- 参数
	- 默认参数
		- 只有在形参表末尾的那些参数可以有默认参数值
		- 默认参数的值是不可变的对象，比如None、True、False、数字或字符串
		
        		def print_info(a, b=None):
                    if b is None:
                        b = []
                    print(b)
                    return b

                result = print_info(1)
                result.append('error')
                print(result)
                print_info(2)
	- 关键字参数（位置参数）
		- 可以通过参数名来给函数传递参数，而不用关心参数列表定义时的顺序，这被称之为关键字参数。
				def print_user_info(name, age=29, sex='男'):
                    print('昵称：{}'.format(name), end=' ')
                    print('年龄：{}'.format(age), end=' ')
                    print('性别：{}'.format(sex))
                    return

                print_user_info(name='两点水', age=18, sex='女')
                print_user_info(name='两点水', age=18)
	- 不定长参数
		- 元组的方式来接受没有直接定义的参数。这种方式在参数前边加星号 `*`
		- dict(字典)的方式来接受没有直接定义的参数。这种方式在参数前边加星号 `**`
		
        		def print_user_info(name, age, sex='男', *hobby):
                    # 打印用户信息
                    print('昵称：{}'.format(name), end=' ')
                    print('年龄：{}'.format(age), end=' ')
                    print('性别：{}'.format(sex), end=' ')
                    print('爱好：{}'.format(hobby))
                    print(type(hobby))
                    return

                print_user_info('lcp0578', 18, '女', '打篮球', '打羽毛球', '跑步')

                def print_user_info(name, age, sex='男', **hobby):
                    # 打印用户信息
                    print('昵称：{}'.format(name), end=' ')
                    print('年龄：{}'.format(age), end=' ')
                    print('性别：{}'.format(sex), end=' ')
                    print('爱好：{}'.format(hobby))
                    print(type(hobby))
                    return

                print_user_info(name='lcp0578', age=18, sex='女', hobby=('打篮球', '打羽毛球', '跑步'))
	- 只接受关键字的参数(放到`*`后面的参数，必须使用关键字参数)
	
    		def print_user_info(name, *, age, sex='男'):
                print('昵称：{}'.format(name), end=' ')
                print('年龄：{}'.format(age), end=' ')
                print('性别：{}'.format(sex))
                return;

            print_user_info(name='两点水', age=18, sex='女')

            print_user_info('两点水', 18, '女') # 这种写法会报错，因为 age ，sex 这两个参数强制使用关键字参数
            print_user_info('两点水', age='22', sex='男')
- 函数传值问题
	- **不可更改的类型**：类似 c++ 的值传递，如 整数、字符串、元组。如fun（a），传递的只是 a 的值，没有影响 a 对象本身。比如在 fun（a）内部修改 a 的值，只是修改另一个复制的对象，不会影响 a 本身。
	- **可更改的类型**：类似 c++ 的引用传递，如 列表，字典。如 fun（a），则是将 a 真正的传过去，修改后 fun 外部的 a 也会受影响
- python 使用 `lambda` 来创建匿名函数
	- 匿名函数主要有以下特点：
		- `lambda` 只是一个表达式，函数体比 `def `简单很多。
		- `lambda` 的主体是一个表达式，而不是一个代码块。仅仅能在 `lambda` 表达式中封装有限的逻辑进去。
		- `lambda` 函数拥有自己的命名空间，且不能访问自有参数列表之外或全局命名空间里的参数。
	- 尽管 `lambda` 表达式允许你定义简单函数，但是它的使用是有限制的。 你只能指定单个表达式，它的值就是最后的返回值。也就是说不能包含其他的语言特性了， 包括多个语句、条件表达式、迭代以及异常处理等等。