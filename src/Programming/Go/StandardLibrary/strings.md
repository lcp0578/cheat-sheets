## strings
- 分割字符串

		pts := strings.Split(val, ",")
        func Split(s, sep string) []string { return genSplit(s, sep, 0, -1) }
        func SplitAfter(s, sep string) []string { return genSplit(s, sep, len(sep), -1) }
        func SplitN(s, sep string, n int) []string { return genSplit(s, sep, 0, n) }
        func SplitAfterN(s, sep string, n int) []string { return genSplit(s, sep, len(sep), n) }
- 是否包含

		// 子串substr在s中，返回true
        func Contains(s, substr string) bool
        // chars中任何一个Unicode代码点在s中，返回true
        func ContainsAny(s, chars string) bool
        // Unicode代码点r在s中，返回true
        func ContainsRune(s string, r rune) bool
- 连接

		func Join(a []string, sep string) string
- 替换

		// 用 new 替换 s 中的 old，一共替换 n 个。
        // 如果 n < 0，则不限制替换次数，即全部替换
        func Replace(s, old, new string, n int) string
        //满足函数实现的进行替换
        func Map(mapping func(rune) rune, s string) string 
- 字符或子串在字符串中出现的位置

		//返回子串sep在字符串s中第一次出现的索引值，不在的话返回-1.
        func Index(s, sep string) int
        //chars中任何一个Unicode代码点在s中首次出现的位置，不存在返回-1
        func IndexAny(s, chars string) int
        //查找字符 c 在 s 中第一次出现的位置，其中 c 满足 f(c) 返回 true
        func IndexFunc(s string, f func(rune) bool) int   //rune类型是int32别名，UTF-8字符格式编码。
        //返回字符c在s中第一次出现的位置
        func IndexByte(s string, c byte) int   //byte是字节类型
        // Unicode 代码点 r 在 s 中第一次出现的位置
        func IndexRune(s string, r rune) int
        //查找最后一次出现的位置
        func LastIndex(s, sep string) int
        func LastIndexByte(s string, c byte) int
        func LastIndexAny(s, chars string) int
        func LastIndexFunc(s string, f func(rune) bool) int
- 子串出现次数

		func Count(s, sep string) int