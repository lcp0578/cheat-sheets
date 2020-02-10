## 条件语句 & 循环语句
- if

		if condtion1:
            statements1(s)
        elif condtion2:
            statements2(s)
        elif condtion3:
            statements3(s)
        else:
            statements4(s)
- for

		for iterating_var in sequence:
   			statements(s)
- range()
	- range(x) 可以生成一个从 0 到 x-1 的整数序列
	- range(a,b) 函数，你可以生成了一个左闭右开的整数序列, range(0, 3) == range(3)
	- 默认步长为1，第三个参数修改步长，range(0,10,2)
- while

		while condtion:
        	statements(s)
- 循环控制语句
    |循环控制语句|	描述|
    |-|-|
    |break|	在语句块执行过程中终止循环，并且跳出整个循环|
    |continue|	在语句块执行过程中终止当前循环，跳出该次循环，执行下一次循环|
    |pass|	pass 是空语句，是为了保持程序结构的完整性|