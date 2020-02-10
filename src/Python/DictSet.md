## dict(字典)和set
- dict(字典)
    - 字典是另一种可变容器模型，且可存储任意类型对象。

            dictDemo = {key1: value1, key2: value2}
    - dict（字典） 的函数和方法
    |方法和函数|	描述|
    |-|-|
    |len(dict)|	计算字典元素个数|
    |str(dict)|	输出字典可打印的字符串表示|
    |type(variable)|	返回输入的变量类型，如果变量是字典就返回字典类型`<class 'dict'>`|
    |dict.clear()|	删除字典内所有元素|
    |dict.copy()|	返回一个字典的浅复制|
    |dict.values()|	以列表返回字典中的所有值|
    |dict.popitem()|	随机返回并删除字典中的一对键和值|
    |dict.items()|	以列表返回可遍历的(键, 值) 元组数组|
- dict VS list
	- dict 优缺点
		- 查找和插入的速度极快，不会随着key的增加而变慢
		- 需要占用大量的内存，内存浪费多
	- list 优缺点
		- 查找和插入的时间随着元素的增加而增加
		- 占用空间小，浪费内存很少
- set
	- set的创建

			setDemo = set([123, 456, 789])
    - 操作
    
    		setDemo.add(12) //添加元素
            setDemo.remove(789) //删除元素
    - 因为 set 是一个无序不重复元素集，因此，两个 set 可以做数学意义上的 union(并集), intersection(交集), difference(差集) 等操作。
    
    		set3 = set1 & set2 #交集
            set4 = set1 | set2 #并集
            set5 = set1 - set2 # 差集
            set6 = set2 - set1 # 差集