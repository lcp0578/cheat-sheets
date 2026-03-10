## taskkill
- 按进程名

		taskkill /im nginx.exe /f
		NOTE: /f在这里意为强制结束进程
- 按进程ID

		taskkill /pid {pid}
		taskkill /pid   1988 /F # 强制结束
