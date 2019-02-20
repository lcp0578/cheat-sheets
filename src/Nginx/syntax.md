## 配置语法
- if语句的判断条件
	- 正则表达式匹配：
        ==:等值比较;
        ~：与指定正则表达式模式匹配时返回“真”，判断匹配与否时区分字符大小写；
        ~*：与指定正则表达式模式匹配时返回“真”，判断匹配与否时不区分字符大小写；
        !~：与指定正则表达式模式不匹配时返回“真”，判断匹配与否时区分字符大小写；
        !~*：与指定正则表达式模式不匹配时返回“真”，判断匹配与否时不区分字符大小写；
	- 文件及目录匹配判断：
        -f, !-f：判断指定的路径是否为存在且为文件；
        -d, !-d：判断指定的路径是否为存在且为目录；
        -e, !-e：判断指定的路径是否存在，文件或目录均可；
        -x, !-x：判断指定路径的文件是否存在且可执行；
- try_files
	https://www.hi-linux.com/posts/53878.html
- location
	https://www.cnblogs.com/qinyujie/p/8979464.html
- rewrite
    https://blog.coding.net/blog/tips-in-configuring-Nginx-location
    http://seanlook.com/2015/05/17/nginx-location-rewrite/