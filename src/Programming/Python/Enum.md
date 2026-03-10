## 枚举类
- 枚举类的使用

        #!/usr/bin/env python3
        # -*- coding: UTF-8 -*-

        from enum import Enum

        MonthEnum = Enum('Month', ('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'))

        for name, member in MonthEnum.__members__.items():
            print(name, '-----', member, '------', member.value)
- 自定义类型的枚举

        #!/usr/bin/env python3
        # -*- coding: UTF-8 -*-

        from enum import Enum, unique

        # @unique 装饰器可以帮助我们检查保证没有重复值
        @unique
        class MonthClass(Enum):
            Jan = 'January'
            Feb = 'February'
            Mar = 'March'
            Apr = 'April'
            May = 'May'
            Jun = 'June'
            Jul = 'July'
            Aug = 'August'
            Sep = 'September '
            Oct = 'October'
            Nov = 'November'
            Dec = 'December'

        if __name__ == '__main__':
            print(MonthClass.Jan, '----------',
                  MonthClass.Jan.name, '----------', MonthClass.Jan.value)
            for name, member in MonthClass.__members__.items():
                print(name, '----------', member, '----------', member.value)