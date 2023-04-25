## List(列表)和tuple(元组)
- List
	- List（列表）运算符
	列表对 + 和 * 的操作符与字符串相似。+ 号用于组合列表，* 号用于重复列表。

    |Python表达式|	结果|	描述|
    |-|-|-|
    |len([1, 2, 3])|	3|	计算元素个数|
    |[1, 2, 3] + [4, 5, 6]|	[1, 2, 3, 4, 5, 6]|组合|
    |['Hi!'] * 4|	['Hi!', 'Hi!', 'Hi!', 'Hi!']|复制|
    |3 in [1, 2, 3]|	True|元素是否存在于列表中|
    |for x in [1, 2, 3]: print(x) |	1 2 3|	迭代|
    - List （列表）函数&方法
    
    |函数&方法|	描述|
    |-|-|
	|len(list)|	列表元素个数|
    |max(list)|	返回列表元素最大值|
    |min(list)|	返回列表元素最小值|
    |list(seq)|	将元组转换为列表|
    |listObj.append(obj)|	在列表末尾添加新的对象|
    |listObj.count(obj)|统计某个元素在列表中出现的次数|
    |listObj.extend(seq)|在列表末尾一次性追加另一个序列中的多个值（用新列表扩展原来的列表）|
    |listObj.index(obj)|从列表中找出某个值第一个匹配项的索引位置|
    |listObj.insert(index, obj)|将对象插入列表|
    |listObj.pop(obj=list[-1])|移除列表中的一个元素（默认最后一个元素），并且返回该元素的值|
    |listObj.remove(obj)|移除列表中的一个元素（参数是列表中元素），并且不返回任何值|
    |listObj.reverse()|反向列表中元素|
    |listObj.sort([func])|	对原列表进行排序|

- tuple
	- 一旦初始化就不能修改
	- 创建
	
    		tuple1=('两点水','twowter','liangdianshui',123,456)
			tuple2='两点水','twowter','liangdianshui',123,456
            tuple3=() #创建空元组
			tuple4=(123,) #元组中只包含一个元素时，需要在元素后面添加逗号