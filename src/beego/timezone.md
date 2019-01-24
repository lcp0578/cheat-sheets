## timezone时区问题
- 修改连接时配置

		dataSource := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?charset=%s&loc=%s", config["username"], config["password"], config["ip"], config["port"], config["db_name"], config["charset"], "Asia%2FShanghai")
        //orm.DefaultTimeLoc = time.UTC
        err = orm.RegisterDataBase(name, "mysql", dataSource, 30)