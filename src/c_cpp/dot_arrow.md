## 点(.)操作符和箭头(->)操作符
- 结论
	- 箭头（->）：左边必须为指针；
	- 点号（.）：左边必须为实体。
- 点操作符用于获取类类型对象的成员：

		item1.same_isbn(item2); // run the same_isbn member of item1
- 如果有一个指向Sales_item对象的指针（或迭代器），则在使用点操作符前，需对该指针（或迭代器）进行解引用：

        Sales_item *sp = &item1;
        (*sp).same_isbn(item2); // run same_isbn on object to which sp points
- 在上述用法中，注意必须用圆括号把解引用括起来，因为解引用的优先级低于点操作符。
- 如果漏掉圆括号，则这段代码的含义就完全不同了：

        // run the same_isbn member of sp then dereference the result!
        *sp.same_isbn(item2); // error: sp has no member named same_isbn
- 这个表达式企图获得sp对象的same_isbn成员。等价于：

		*(sp.same_isbn(item2));  // equivalent to *sp.same_isbn(item2);
- 然而，sp是一个没有成员的指针；这段代码无法通过编译。
- 因为编程时很容易忘记圆括号，而且这类代码又经常使用，所以C++为在点操作符后使用的解引用操作定义了一个同义词：箭头操作符（->）。假设有一个指向类类型对象的指针（或迭代器），下面的表达式相互等价：

        (*p).foo;  // dereference p to get an object and fetch its member named foo
        p->foo;    // equivalent way to fetch the foo from the object to which p points

- 具体地，可将same_isbn的调用重写为：

		sp->same_isbn(item2);     // equivalent to (*sp).same_isbn(item2)
