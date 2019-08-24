## context
> https://golang.google.cn/pkg/context

- Context 介绍
	- `Context` 的主要作用就是在不同的 Goroutine 之间同步请求特定的数据、取消信号以及处理请求的截止日期。
	- 在不同 Goroutine 之间对信号进行同步避免对计算资源的浪费，与此同时 `Context` 还能携带以请求为作用域的键值对信息。
	- `Context` 其实是 Go 语言 `context` 包对外暴露的接口，该接口定义了四个需要实现的方法
		- `Deadline` 方法需要返回当前 `Context` 被取消的时间，也就是完成工作的截止日期；
		- `Done` 方法需要返回一个 `Channel`，这个 `Channel` 会在当前工作完成或者上下文被取消之后关闭，多次调用 `Done` 方法会返回同一个 `Channel`；
		- `Err` 方法会返回当前 `Context` 结束的原因，它只会在 `Done` 返回的 `Channel` 被关闭时才会返回非空的值；
			- 如果当前 `Context` 被取消就会返回 `Canceled` 错误；
			- 如果当前 `Context` 超时就会返回 `DeadlineExceeded` 错误；
		- `Value` 方法会从 `Context` 中返回键对应的值，对于同一个上下文来说，多次调用 `Value` 并传入相同的 `Key` 会返回相同的结果，这个功能可以用来传递请求特定的数据；
- `context` 包的方法
	- `func WithCancel(parent Context) (ctx Context, cancel CancelFunc)`
	- `func WithDeadline(parent Context, d time.Time) (Context, CancelFunc)`
	- `func WithTimeout(parent Context, timeout time.Duration) (Context, CancelFunc)`