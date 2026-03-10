## Process Monitor 使用进程监视器排查软件异常原因
- https://learn.microsoft.com/en-us/sysinternals/downloads/procmon
- Process Monitor is an advanced monitoring tool for Windows that shows real-time file system, Registry and process/thread activity. 
- 筛选器的使用（核心功能）
	- 设置基本筛选条件
		- 示例 1：仅显示特定进程的事件。
		
				条件：Process Name is notepad.exe → 点击 Add → OK。
		
		- 示例 2：过滤非成功操作。
		
				条件：Result is not  SUCCESS → Add → OK。