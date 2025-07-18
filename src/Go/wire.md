## 依赖注入框架wire
- https://github.com/google/wire
- wire简介
	- wire是google开源的依赖注入框架。
	- Wire is a code generation tool that automates connecting components using dependency injection.
- 为什么选择wire
	- 除了wire，Go的依赖注入框架还有Uber的dig和Facebook的inject，它们都是使用反射机制来实现运行时依赖注入(runtime dependency injection)，而wire则是采用代码生成的方式来达到编译时依赖注入(compile-time dependency injection)。
	- 使用反射带来的性能损失倒是其次，更重要的是反射使得代码难以追踪和调试（反射会令Ctrl+左键失效…）。
	- 而wire生成的代码是符合程序员常规使用习惯的代码，十分容易理解和调试。
- Provider & Injector
	- provider和injector是wire的两个核心概念。
		- provider: a function that can produce a value. These functions are ordinary Go code.
		- injector: a function that calls providers in dependency order. With Wire, you write the injector’s signature, then Wire generates the function’s body.
	- 通过提供provider函数，让wire知道如何产生这些依赖对象。wire根据我们定义的injector函数签名，生成完整的injector函数，injector函数是最终我们需要的函数，它将按依赖顺序调用provider。
- https://zhuanlan.zhihu.com/p/338926709