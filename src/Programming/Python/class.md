## 面向对象
- 定义

        class Student:
            username = 'lcp0578'

            @classmethod
            def get_username(cls):
                print('student username:' + cls.username)

        Student.get_username()

        class Teacher(object):
            username = 'lcp0578'

            # 构造函数
            def __init__(self, nickname):
                print('init')
                print('nickname:' + nickname)

            def get_username(self):
                print('student username:' + self.username)

            # 析构函数
            def __del__(self):
                print('del')

        th = Teacher('da peng')
        th.get_username()
- 类的继承
	- 在定义类的时候，可以在括号里写继承的类，如果不用继承类的时候，也要写继承 object 类，因为在 Python 中 object 类是一切类的父类。
	- Python 也是支持多继承的
	
    		class ClassName(Base1,Base2,Base3):
            <statement-1>
            .
            .
            .
            <statement-N>
- 类的多态

		class User(object):
            def __init__(self, name):
                self.name = name

            def print_user(self):
                print('Hello !' + self.name)

        class UserVip(User):
            def print_user(self):
                print('Hello ! 尊敬的Vip用户：' + self.name)

        class UserGeneral(User):
            def print_user(self):
                print('Hello ! 尊敬的用户：' + self.name)

        def print_user_info(user):
            user.print_user()

        if __name__ == '__main__':
            userVip = UserVip('user_vip')
            print_user_info(userVip)
            userGeneral = UserGeneral('user ')
            print_user_info(userGeneral)
- 访问控制
	- 在技术层面上，一个类里的所有方法和属性都是公共可访问的，以下有三种形式建议不同的访问形式：
		- 1、使用注释进行提示建议。如可以在docstring里面放一个提示来表明这个方法只是内部使用的
		- 2、给某个属性或者方法加一个下划线的前缀，大部分python程序员会把这个解释为“这是个内部变量，使用之前要三思”
		- 3、给某个属性或者方法添加一个双下划线的前缀，强烈建议为内部变量。访问时需要名称改编（name mangling），即在该方法或者属性前面自动加一个`_<classname>`的前缀(单下划线)。
- 获取类的相关信息
	- `type(obj)`：获取对象的相应类型；
	- `isinstance(obj, type)`：判断对象是否为指定的 `type` 类型的实例；
	- `hasattr(obj, attr)`：判断对象是否具有指定属性/方法；
	- `getattr(obj, attr[, default])` 获取属性/方法的值, 若没有对应的属性则返回 default 值（前提是设置了 default），否则会抛出 AttributeError 异常；
	- `setattr(obj, attr, value)`：设定该属性/方法的值，类似于 obj.attr=value；
	- `dir(obj)`：可以获取相应对象的所有属性和方法名的列表：
- 类的专有方法
    |方法|说明|
    |-|-|
    |`__init__`|	构造函数，在生成对象时调用|
    |`__del__`|	析构函数，释放对象时使用|
    |`__repr__`|	打印，转换|
    |`__setitem__`|	按照索引赋值|
    |`__getitem__`|	按照索引获取值|
    |`__len__`|	获得长度|
    |`__cmp__`|	比较运算|
    |`__call__`|	函数调用|
    |`__add__`|	加运算|
    |`__sub__`|	减运算|
    |`__mul__`|	乘运算|
    |`__div__`|	除运算|
    |`__mod__`|	求余运算|
    |`__pow__`|	乘方|