## 解析IEEE 754的浮点数
- 定义
根据国际标准IEEE 754，任意一个二进制浮点数V可以表示成下面的形式：

		V = (-1)^s * M * 2^e
	- (-1)^s表示符号位，当s=0，V为正数；当s=1，V为负数。
	- M表示有效数字，大于等于1，小于2。
	- 2^E表示指数位。
IEEE 754规定:
	- 对于32位的浮点数，最高的1位是符号位s，接着的8位是指数E，剩下的23位为有效数字M。
	- 对于64位的浮点数，最高的1位是符号位S，接着的11位是指数E，剩下的52位为有效数字M。
- Go实现

		func parse_ieee754(value []byte) (f string, err error) {
            b, err := hex.DecodeString(fmt.Sprintf("%x", value))
            if err != nil {
                fmt.Println(err)
                return
            }
            buf := bytes.NewReader(b)
            var number float32 = 0.0
            err = binary.Read(buf, binary.LittleEndian, &number)
            if err == nil {
                f = fmt.Sprintf("%.2f", number)
            }
            return
        }

