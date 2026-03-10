## rem
> 相对长度单位。相对于根元素(即html元素)font-size计算值的倍数

- 淘宝的可伸缩解决方案[amfe/lib-flexible](https://github.com/amfe/lib-flexible)

	注：这里的因子是10，即font-size = W/10  
	开发时，假如视觉稿宽度是640，则最好使用第二种方案，选择16作为因子，则比例为640/16=40。那么，页面所有的rem数值的换算公式为：在视觉稿中的px数值/40。