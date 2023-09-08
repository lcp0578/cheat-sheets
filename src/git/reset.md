## git reset 撤销本地commit
- 撤销上一次的commit

		git reset HEAD~

	或者

		git reset HEAD~1

- 多个commit，那么可以通过修改`HEAD~`之后的数字
	- 如撤销前3次的commit

			git reset HEAD~3

- 注：使用此命令，你原来提交的代码都在，不会被撤销
- 使用了多次git commit命令，但是发现刚刚commit的内容不需要提交了，需要恢复到上一次的commit时，使用如下命令：

		git reset --hard HEAD^1

- 注：使用了之后，你最新的commit命令下修改的内容将完全被撤销。
- 注意：谨慎使用 –-hard 参数，它会删除回退点之前的所有信息。

- `HEAD` 说明：
	- `HEAD` 表示当前版本
		- `HEAD^` 上一个版本
		- `HEAD^^` 上上一个版本
		- `HEAD^^^` 上上上一个版本
		- 以此类推...

	- 可以使用 `～`数字表示
		- `HEAD~0` 表示当前版本
		- `HEAD~1` 上一个版本
		- `HEAD^2` 上上一个版本
		- `HEAD^3` 上上上一个版本
		- 以此类推...