## 字符串与数值间的转换
- int to string

		s := strconv.Itoa(i)
		//等价于
		s := strconv.FormatInt(int64(i), 10)

- int64 to string

		i := int64(123)
		s := strconv.FormatInt(i, 10)
		//对于无符号整形，可以使用
		FormatUint(i uint64, base int)

- string to int 

		i, err := strconv.Atoi(s)
- string to int64
	
		i, err := strconv.ParseInt(s, 10, 64)
		// 第二个参数可以为16，即s为16进制字符串
- hex to int64
	
		strconv.ParseInt("C40C5253", 16, 64)
- float转string

		s := "3.1415926535"
		v1, err := strconv.ParseFloat(v, 32)
		v2, err := strconv.ParseFloat(v, 64)

		v := 3.1415926535
		s1 := strconv.FormatFloat(v, 'E', -1, 32)//float32
		s2 := strconv.FormatFloat(v, 'E', -1, 64)//float64
		// 第二个参数,fmt解释
		// 'b' (-ddddp±ddd，二进制指数)
		// 'e' (-d.dddde±dd，十进制指数)
		// 'E' (-d.ddddE±dd，十进制指数)
		// 'f' (-ddd.dddd，没有指数)
		// 'g' ('e':大指数，'f':其它情况)
		// 'G' ('E':大指数，'f':其它情况)
		// The format fmt is one of
		// 'b' (-ddddp±ddd, a binary exponent),
		// 'e' (-d.dddde±dd, a decimal exponent),
		// 'E' (-d.ddddE±dd, a decimal exponent),
		// 'f' (-ddd.dddd, no exponent),
		// 'g' ('e' for large exponents, 'f' otherwise), or
		// 'G' ('E' for large exponents, 'f' otherwise).
		//
		// The precision prec controls the number of digits
		// (excluding the exponent) printed by the 'e', 'E', 'f', 'g', and 'G' formats.
		// For 'e', 'E', and 'f' it is the number of digits after the decimal point.
		// For 'g' and 'G' it is the total number of digits.
		// The special precision -1 uses the smallest number of digits
		// necessary such that ParseFloat will return f exactly.

