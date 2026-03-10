## JavaScript、TypeScript、ES6三者之间的联系和区别
#### ES6是什么
- ECMAScript 6.0（以下简称ES6）是JavaScript语言（现在是遵循ES5标准）的下一代标准，已经在2015年6月正式发布了。它的目标，是使得JavaScript语言可以用来编写复杂的大型应用程序，成为企业级开发语言。
- ES6的新特性
	- ES6中的let命令，声明变量，用法和var差不多，但是let是为JavaScript新增了块级作用域，ES5中是没有块级作用域的，并且var有变量提升的概念，但是在let中，使用的变量一定要进行声明。
	- ES6中变量的解构赋值，比如：var [a,b,c] = [0,1,2];
	- ES6中不再像ES5一样使用原型链实现继承，而是引入Class这个概念，听起来和Java中的面向对象编程的语法有些像，但是二者是不一样的。
	- ES6中的函数定义也不再使用关键字function，而是利用了=>来进行定义；
	- ES6中可以设置默认函数参数，如function A（x,y=9）{};
#### ECMAScript和JavaScript的关系
- 由于JavaScript的创造者Netscae公司的版权问题，ECMAScript不能叫Javascript。总之，ECMAScript和JavaScript的关系是，前者是后者的规格（语言规范），后者是前者的一种实现。

#### JavaScript 与 TypeScript 的关系
- TypeScript是Javascript的超集，实现以面向对象编程的方式使用Javascript。当然最后代码还是编译为Javascript。

#### TypeScript和ES6的关系
- TypeScrip相对于ES6,TypeScript最大的改善是增加了类型系统。

#### 总结：
- ES6是Javascript语言的标准，TypeScript是ES6的超集。