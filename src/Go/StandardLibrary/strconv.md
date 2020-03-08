## strconv
> Package strconv implements conversions to and from string representations of basic data types.

- 数字间转换

        i, err := strconv.Atoi("-42")
        b, err := strconv.ParseBool("true")
        f, err := strconv.ParseFloat("3.1415", 64)
        i, err := strconv.ParseInt("-42", 10, 64)
        u, err := strconv.ParseUint("42", 10, 64)
        
        s := strconv.Itoa(-42)
        s := strconv.FormatBool(true)
        s := strconv.FormatFloat(3.1415, 'E', -1, 64)
        s := strconv.FormatInt(-42, 16)
        s := strconv.FormatUint(42, 16)
- 字符串间转换

		q := strconv.Quote("Hello, 世界") //"Hello, 世界"
		q := strconv.QuoteToASCII("Hello, 世界") //"Hello, \u4e16\u754c"
- AppendTP类函数用于将TP转换成字符串后append到一个slice中
	- func AppendBool(dst []byte, b bool) []byte
	- func AppendFloat(dst []byte, f float64, fmt byte, prec, bitSize int) []byte
	- func AppendInt(dst []byte, i int64, base int) []byte
	- func AppendQuote(dst []byte, s string) []byte
	- func AppendQuoteRune(dst []byte, r rune) []byte
	- func AppendQuoteRuneToASCII(dst []byte, r rune) []byte
	- func AppendQuoteRuneToGraphic(dst []byte, r rune) []byte
	- func AppendQuoteToASCII(dst []byte, s string) []byte
	- func AppendQuoteToGraphic(dst []byte, s string) []byte
	- func AppendUint(dst []byte, i uint64, base int) []byte
