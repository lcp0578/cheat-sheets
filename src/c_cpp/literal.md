## 字面值类型、字面值常量
#### 字面值类型
-  **字面值类型**是指编译时就能得到结果的类型，具体包括算术类型、引用和指针。自定义类、IO类不属于该类型。
-  字面值类型的对象有严格的要求，字面值类型是那些具有常量表达式属性的对象的类型。例如：字面值常量是算术类型。
-  对于引用和指针，其限定比较严格。不是所有的指针都是常量表达式。只有那些在编译时就确定地址指向的指针才是常量表达式，引用同理。
-  因此`nullptr`、`NULL`、指向固定地址的指针是字面值类型。

#### 字面值常量
- **字面值常量**（literal constant），“字面值”是指只能用它的值称呼它，“常量”是指其值不能修改。每个字面值都有相应的类型，3.14是`double`型，2是`int`型。
- 只有内置类型存在字面值。