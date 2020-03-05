## byte和rune
- Go语言中byte和rune实质上就是uint8和int32类型。byte用来强调数据是raw data，而不是数字；而rune用来表示Unicode的code point。

		uint8       the set of all unsigned  8-bit integers (0 to 255)
		int32       the set of all signed 32-bit integers (-2147483648 to 2147483647)

		byte        alias for uint8
		rune        alias for int32