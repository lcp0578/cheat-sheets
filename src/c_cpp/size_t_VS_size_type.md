## size_t 和 size_type的区别
> 为了使自己的程序有很好的移植性，应该尽量使用size_t和size_type而不是int, unsigned

- size_t是全局定义的类型；size_type是STL类中定义的类型属性，用以保存任意string和vector类对象的长度
- string::size_type 制类型一般就是unsigned int, 但是不同机器环境长度可能不同 win32 和win64上长度差别;size_t一般也是unsigned int
- 使用的时候可以参考：

        string::size_type a =123;
        vector<int>size_type b=234;
        size_t b=456;
- size_t 使用的时候头文件需要 `<cstddef>` ；size_type 使用的时候需要`<string>`或者`<vector>`

        sizeof(string::size_type)
        sizeof(vector<bool>::size_type)
        sizeof(vector<char>::size_type)
        sizeof(size_t)
	上述长度均相等，长度为win32:4 win64:8
- 二者联系：在用下标访问元素时，vector使用vector::size_type作为下标类型，而数组下标的正确类型则是size_t
