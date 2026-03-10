## go string 字符串操作
- 改变字符串中的某些字符

		str := "hello go"
		bytes := []byte(str)
		bytes[1] = 'a'
		str = string(bytes) //str == "hallo go"
- 截取子串
	
		substr := str[n:m] //截取从索引n到m-1的子串
		substr := str[:m] //开头截取到m-1的子串
- 遍历字符串

		//for遍历，此方式只能遍历存放ASCII
		//编码的字符串，比如中文就不行
		for i := 0; i < len(str); i++ {
			//... = str[i]
		}
		//for-range遍历，此方式可以遍历Unicode
		//编码的字符串，不担心乱码
		for index, char := range str {
			fmt.Printf("%d %c\n",index,char)
		}
- 计算字符串长度

		//字符串中字符全为ASCII中的字符
		len(str)
		//字符串中含非ASCII的Unicode字符
		utf8.RuneCountInString(str)
- 连接字符串

	    //速度最快的写法：
		var buf bytes.Buffer
		buf.WriteString("hello ")
		buf.WriteString("roc")
		fmt.Println(buf.String()) //hello roc
		//还有如下两种方式：
		str := strings.Join([]string{"hello"," world"},"")
		fmt.Println(str)
		str := "hello"
		str += "roc"