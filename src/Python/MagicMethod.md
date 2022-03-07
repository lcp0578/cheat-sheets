## 魔术方法
- 打印魔术方法

        # -*- coding: UTF-8 -*-

        class User(object):
            pass

        if __name__ == '__main__':
            for method in dir(User()):
                print(method)
        
        #输出
        __class__
        __delattr__
        __dict__
        __dir__
        __doc__
        __eq__
        __format__
        __ge__
        __getattribute__
        __gt__
        __hash__
        __init__
        __init_subclass__
        __le__
        __lt__
        __module__
        __ne__
        __new__
        __reduce__
        __reduce_ex__
        __repr__
        __setattr__
        __sizeof__
        __str__
        __subclasshook__
        __weakref__
- 创建一个类的过程是分为两步的，一步是创建类的对象，还有一步就是对类进行初始化。
	- `__new__` 是用来创建类并返回这个类的实例, 而`__init__` 只是将传入的参数来初始化该实例.
    - `__new__` 在创建一个实例的过程中必定会被调用,但 `__init__` 就不一定
- 属性的访问控制
    |方法|说明|
    |-|-|
    |`__getattr__(self, name)`|	该方法定义了你试图访问一个不存在的属性时的行为。因此，重载该方法可以实现捕获错误拼写然后进行重定向, 或者对一些废弃的属性进行警告。|
    |`__setattr__(self, name, value)`|	定义了对属性进行赋值和修改操作时的行为。不管对象的某个属性是否存在,都允许为该属性进行赋值.有一点需要注意，实现 __setattr__ 时要避免"无限递归"的错误|
    |`__delattr__(self, name)`|	`__delattr__` 与 `__setattr__` 很像，只是它定义的是你删除属性时的行为。实现 `__delattr__` 是同时要避免"无限递归"的错误|
    |`__getattribute__(self, name)`|	`__getattribute__ `定义了你的属性被访问时的行为，相比较，`__getattr__` 只有该属性不存在时才会起作用。因此，在支持 `__getattribute__`的 Python 版本,调用`__getattr__` 前必定会调用 `__getattribute__` `__getattribute__` 同样要避免"无限递归"的错误。|

        class User(object):

            def __getattr__(self, item):
                print('call __getattr__')

            def __setattr__(self, key, value):
                print('call __setattr__')
                return super(User, self).__setattr__(key, value)

            def __delattr__(self, item):
                print('call __delattr__')
                return super(User, self).__delattr__(item)

            def __getattribute__(self, item):
                print('call __getattribute__')
                return super(User, self).__getattribute__(item)

        if __name__ == '__main__':
            for method in dir(User()):
                print(method)
            user = User()

            user.attr1 = True
            user.attr1
            try:
                user.attr2
            except AttributeError:
                pass

        del user.attr1