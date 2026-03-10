## 模块与包
- 在Python中，一个`.py`文件就称之为一个模块（Module）
- import

		# 基本语法
		import module1[, module2[,... moduleN]
        
        # 打印搜索路径
        #!/usr/bin/env python
        # -*- coding: UTF-8 -*-

        import sys

        print(sys.path)
        
        # from package_name import property,method
        from sys import path,version
        
        print(path)
        print(version)
        
        #from package_name import *, 把某个模块中的所有方法属性都导入
        from sys import *
        
        print(path)
        print(version)
        
        # 相对导入 . 与 ..
        from .database import Database   # 点号表示使用当前路径的database模块
        
        from ..contact.email import sendEmai # 使用两个点号表示访问上层的父类
- 主模块与非主模块
	- 如果一个模块的 `__name__` 属性的值时 `__main__` ，那么久说明这个模块是主模块，反之为副模块。
	- 某个模块自己运行时，`__name__ == '__main__'` 才成立
	
    		from sys import version

            print(version)
            print(__name__) # __main__ 或者 module_name
            if __name__ == '__main__':
                print('module main call')
            else:
                print('module not main call')
- 包
	- 包将有联系的模块组织在一起，即放到同一个文件夹下，并且在这个文件夹创建一个名字为`__init__.py`文件，那么这个文件夹就称之为包
	- `__init__.py`控制着包的导入行为
	- 在`__init__.py`文件中，定义一个`__all__`变量，它控制着`from package_name import *`时导入的模块

