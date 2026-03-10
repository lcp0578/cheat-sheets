## go hex 字符串操作
- 16进制字符串转[]byte

		s := "46447381" //位数必须是偶数
        data, err := hex.DecodeString(s)
        if err != nil {
            panic(err)
        }
        fmt.Printf("%x", data)
- []byte 相互转换

		/**
            []bytes asc to hex
         */
        func BytesAcsToHex(data []byte)[]byte {
            command, err := hex.DecodeString(string(data))
            if err != nil {
                beego.Error(err)
                return nil
            }
            return command
        }

        func BytesHexToAsc(data []byte)[]byte{
            return []byte(hex.EncodeToString(data))
        }