## 格式化输入输出
> https://www.cnblogs.com/golove/p/3284304.html

#### 格式化输出

        // 格式化输出：将 arg 列表中的 arg 转换为字符串输出

        // 使用动词 v 格式化 arg 列表，非字符串元素之间添加空格
        Print(arg列表)
        // 使用动词 v 格式化 arg 列表，所有元素之间添加空格，结尾添加换行符
        Println(arg列表)
        // 使用格式字符串格式化 arg 列表
        Printf(格式字符串, arg列表)

        // Print 类函数会返回已处理的 arg 数量和遇到的错误信息。
- 格式字符串

格式字符串由普通字符和占位符组成，例如：

	"abc%+ #8.3[3]vdef"

　　其中 abc 和 def 是普通字符，其它部分是占位符，占位符以 % 开头（注：%% 将被转义为一个普通的 % 符号，这个不算开头），以动词结尾，格式如下：
	`%[旗标][宽度][.精度][arg索引]动词`

　　方括号中的内容可以省略。
  - 旗标
	旗标有以下几种：
	- `+`：对于数值类型总是输出正负号（其它用法在动词部分说明）。
	- `-`：在右边进行宽度填充，而不是默认的左边。
	- `空格`：对于数值类型的正数，保留一个空白的符号位（其它用法在动词部分说明）。
	- `0`：用 0 进行宽度填充而不用空格，对于数值类型，符号将被移到所有 0 的前面。
	- `#`：相关用法在动词部分说明。
	其中 "0" 和 "-" 不能同时使用，优先使用 "-" 而忽略 "0"。
  - 动词
	“动词”不能省略，不同的数据类型支持的动词不一样。