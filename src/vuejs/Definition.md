## UMD、CMD、AMD、CommonJs等规范
#### UMD
- UMD 叫做通用模块定义规范（Universal Module Definition）。也是随着大前端的趋势所诞生，它可以通过运行时或者编译时让同一个代码模块在使用 CommonJs、CMD 甚至是 AMD 的项目中运行。
- 它没有自己专有的规范，是集结了 CommonJs、CMD、AMD 的规范于一身

#### CMD 
- CMD叫做通用模块定义规范（Common Module Definiton），它是类似于 CommonJs 模块化规范，但是运行于浏览器之上的。
- 来自淘宝玉伯的 SeaJS 就是它的实现
- CMD 规范尽量保持简单，并与 CommonJS 的 Modules 规范保持了很大的兼容性。通过 CMD 规范书写的模块，可以很容易在 Node.js 中运行。
- CMD 规范拥有简单、异步加载脚本、友好的调试并且兼容 Nodejs，它的确在开发过程中给我们提供了较好的模块管理方式。

#### AMD
- AMD 叫做异步模块定义规范（Asynchronous Module Definition），它是 CommonJs 模块化规范的超集，但是运行于浏览器之上的。
- AMD 的特点就和它的名字一样，模块的加载过程是异步的，它大大的利用了浏览器的并发请求能力，让模块的依赖过程的阻塞变得更少了。
- requireJs 就是 AMD 模块化规范的实现。
- AMD 作为一个规范，只需定义其语法 API，而不关心其实现。

#### CommonJs
- CommonJs 是一种 JavaScript 语言的模块化规范，它通常会在服务端的 Nodejs 上使用。
- 在 CommonJs 的模块化规范中，每一个文件就是一个模块，拥有自己独立的作用域、变量、以及方法等，对其他的模块都不可见。CommonJS规范规定，每个模块内部，module 变量代表当前模块。这个变量是一个对象，它的 exports 属性（module.exports）是对外的接口。加载某个模块，其实是加载该模块的 module.exports 属性。require 方法用于加载模块。
- 模块化规范给项目带来极大的好处，在业务复杂，模块众多的大型项目中，开发者都遵循相同的规则来开发各自的模块，他们通过规范来约束模块的定义，大家不需要太多的沟通或者大量的文档来说明自己的模块使用规则，成千上万的模块就这样生产，并能够容易的使用。它的意义不仅是让模块看起来很规范，在合作开发、社区中传播中也起到了重大的作用。