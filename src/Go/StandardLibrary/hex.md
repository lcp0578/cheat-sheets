## go hex 字符串操作
- 16进制字符串转[]byte

		s := "46447381" //位数必须是偶数
        data, err := hex.DecodeString(s)
        if err != nil {
            panic(err)
        }
        fmt.Printf("%x", data)