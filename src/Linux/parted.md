## parted
- parted VS fdisk
	- parted 支持用户在大于 2TB 的硬盘上创建硬盘分区， 但 fdisk 命令不支持
	- 对比 fdisk 来说，parted 是一个更高级的工具
	- 支持更多的分区表类型，包括 GPT （LCTT 译注：全局唯一标识分区表）
	- 它允许用户调整分区大小， 但当缩减分区空间的时候，它没有如我意料的工作，多数情况下我会得到错误消息。所以我会建议用户不要用 parted 来缩减分区大小。
- https://zhuanlan.zhihu.com/p/35613150