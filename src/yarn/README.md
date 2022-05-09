## yarn
#### 简介
- yarn 是 facebook 等公司在 npm v3 时推出的一个新的开源的 Node Package Manager，它的出现是为了弥补 npm 当时安装速度慢、依赖包版本不一致等问题。
- yarn 有以下优点：
	- 安装速度快
		- 并行安装：npm 是按照队列依次安装每个 package，当前一个 package 安装完成之后，才能继续后面的安装。而 Yarn 是同步执行所有任务。
		- 缓存：如果一个 package 之前已经安装过，yarn 会直接从缓存中获取，而不是重新下载。
	- 版本统一
		- yarn 创新性的新增了 yarn.lock 文件，它是 yarn 在安装依赖包时，自动生成的一个文件，作用是记录 yarn 安装的每个 package 的版本，保证之后 install 时的版本一致。不过随着后来 npm 也新增了作用相同的 package-lock.json，这个优势已经不太明显。


#### 安装

		npm install --global yarn
		
		added 1 package, and audited 2 packages in 4s
		
		found 0 vulnerabilities
		npm notice 
		npm notice New minor version of npm available! 8.5.5 -> 8.9.0
		npm notice Changelog: https://github.com/npm/cli/releases/tag/v8.9.0
		npm notice Run npm install -g npm@8.9.0 to update!
		npm notice 
		
		yarn --version
		1.22.18