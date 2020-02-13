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