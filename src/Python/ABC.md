## Python ABC（抽象基类）
-  ABC，Abstract Base Class（抽象基类），主要定义了基本类和最基本的抽象方法，可以为子类定义共有的API，不需要具体实现。
- 抽象基类可以不实现具体的方法（当然也可以实现，只不过子类如果想调用抽象基类中定义的方法需要使用super()）而是将其留给派生类实现。
- 抽象基类提供了逻辑和实现解耦的能力，即在不同的模块中通过抽象基类来调用，可以用最精简的方式展示出代码之间的逻辑关系，让模块之间的依赖清晰简单。同时，一个抽象类可以有多个实现，让系统的运转更加灵活。而针对抽象类的编程，让每个人可以关注当前抽象类，只关注其方法和描述，而不需要考虑过多的其他逻辑，这对协同开发有很大意义。极简版的抽象类实现，也让代码可读性更高。
- abc模块有以下两个主要功能：
	- 某种情况下，判定某个对象的类型，如：`isinstance(a, Sized)`
	- 强制子类必须实现某些方法，即`ABC`类的派生类
- 示例

		import abc
		import six
		
		
		@six.add_metaclass(abc.ABCMeta)
		class BaseClass(object):
		    @abc.abstractmethod
		    def func_a(self, data):
		        """
		        an abstract method need to be implemented
		        """
		
		    @abc.abstractmethod
		    def func_b(self, data):
		        """
		        another abstract method need to be implemented
		        """
		
		class SubclassImpl(BaseClass):
		    def func_a(self, data):
		        print("Overriding func_a, " + str(data))
		
		    @staticmethod
		    def func_d(self, data):
		        print(type(self) + str(data))
		
		class RegisteredImpl(object):
		    @staticmethod
		    def func_c(data):
		        print("Method in third-party class, " + str(data))
		BaseClass.register(RegisteredImpl)
		
		
		if __name__ == '__main__':
		    for subclass in BaseClass.__subclasses__():
		        print("subclass of BaseClass: " + subclass.__name__)
		    print("subclass do not contains RegisteredImpl")
		    print("-----------------------------------------------")
		
		    print("RegisteredImpl is subclass: " + str(issubclass(RegisteredImpl, BaseClass)))
		    print("RegisteredImpl object  is instance: " + str(isinstance(RegisteredImpl(), BaseClass)))
		    print("SubclassImpl is subclass: " + str(issubclass(SubclassImpl, BaseClass)))
		
		    print("-----------------------------------------------")
		    obj1 = RegisteredImpl()
		    obj1.func_c("RegisteredImpl new object OK!")
		    print("-----------------------------------------------")
		    obj2 = SubclassImpl()  #由于没有实例化所有的方法，所以这里会报错 Can't instantiate abstract class SubclassImpl with abstract methods func_b
		    obj2.func_a("It's right!")
