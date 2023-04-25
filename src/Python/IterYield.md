## 迭代器和生成器
- 迭代器
	- 迭代器有两个基本的方法：`iter()` 和 `next()`,且字符串，列表或元组对象都可用于创建迭代器，迭代器对象可以使用常规 for 语句进行遍历，也可以使用 `next()` 函数来遍历。

			str = 'lcp0578'

            iterObj = iter(str)

            for x in iterObj:
                print(x, end=' ')

            while True:
                try:
                    print(next(iterObj)) #迭代器只能向后，所以实际在while语句并不会再输出
                except StopIteration:
                    break
- 列表生成式
	- 语法
	
    		[expr for iter_var in iterable] 
			[expr for iter_var in iterable if cond_expr]
	- 示例
	
    		list1 = [x * x for x in range(1, 11)]
            list2 = [x * x for x in range(1, 11) if x % 2 == 0]

            print(list1) #[1, 4, 9, 16, 25, 36, 49, 64, 81, 100]
            print(list2) #[4, 16, 36, 64, 100]
            
            print('\n'.join([' '.join('%dx%d=%2d' % (x, y, x * y) for x in range(1, y + 1)) for y in range(1, 10)]))
            #output
            1x1= 1
            1x2= 2 2x2= 4
            1x3= 3 2x3= 6 3x3= 9
            1x4= 4 2x4= 8 3x4=12 4x4=16
            1x5= 5 2x5=10 3x5=15 4x5=20 5x5=25
            1x6= 6 2x6=12 3x6=18 4x6=24 5x6=30 6x6=36
            1x7= 7 2x7=14 3x7=21 4x7=28 5x7=35 6x7=42 7x7=49
            1x8= 8 2x8=16 3x8=24 4x8=32 5x8=40 6x8=48 7x8=56 8x8=64
            1x9= 9 2x9=18 3x9=27 4x9=36 5x9=45 6x9=54 7x9=63 8x9=72 9x9=81
- 生成器
	
        # -*- coding: UTF-8 -*-
        list1 = [x * x for x in range(10)]
        gen = (x * x for x in range(10))

        print(list1)
        print(gen)

        for num in gen:
            print(num)

        def my_function():
            for i in range(10):
                yield i

        print(my_function())
        #output
        [0, 1, 4, 9, 16, 25, 36, 49, 64, 81]
        <generator object <genexpr> at 0x10babae40>
        0
        1
        4
        9
        16
        25
        36
        49
        64
        81
        <generator object my_function at 0x10babadd0>
        
        # -*- coding: UTF-8 -*-
        def triangles(end):  # 杨辉三角形
            tr = [1]
            start = 1
            while True:
                yield tr
                tr.append(0)
                tr = [tr[i - 1] + tr[i] for i in range(len(tr))]
                start = start + 1
                if end < start:
                    break

        n = 0
        for t in triangles(10):
            print(t)
