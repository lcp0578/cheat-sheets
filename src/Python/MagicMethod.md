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