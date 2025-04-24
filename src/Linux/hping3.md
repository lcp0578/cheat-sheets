## 禁ping时使用hping3测试网络延迟
- 发送 TCP SYN 包并测量响应时间：

		hping3 -S -p <目标端口> <目标IP> -c 5
	- `-S`：发送 SYN 包（模拟 TCP 握手）。
	- `-p <目标端口>`：指定目标开放的 TCP 端口（如 80、443、22）。
	- `-c 5`：发送 5 次探测。
- 使用示例

		# hping3 -S -p 54321 22.167.162.252 -c 5
		HPING 22.167.162.252 (enp3s0 22.167.162.252): S set, 40 headers + 0 data bytes
		len=44 ip=22.167.162.252 ttl=52 DF id=0 sport=54321 flags=SA seq=0 win=42340 rtt=7.9 ms
		len=44 ip=22.167.162.252 ttl=52 DF id=0 sport=54321 flags=SA seq=1 win=42340 rtt=7.9 ms
		len=44 ip=22.167.162.252 ttl=52 DF id=0 sport=54321 flags=SA seq=2 win=42340 rtt=9.3 ms
		len=44 ip=22.167.162.252 ttl=52 DF id=0 sport=54321 flags=SA seq=3 win=42340 rtt=10.9 ms
		len=44 ip=22.167.162.252 ttl=52 DF id=0 sport=54321 flags=SA seq=4 win=42340 rtt=10.4 ms
		
		--- 22.167.162.252 hping statistic ---
		5 packets transmitted, 5 packets received, 0% packet loss
		round-trip min/avg/max = 7.9/9.3/10.9 ms
