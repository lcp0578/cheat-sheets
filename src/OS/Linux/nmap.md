## nmap - Network Mapper，是Linux下的网络扫描和嗅探工具包
- 基本功能
	- 扫描主机端口，嗅探所提供的网络服务
	- 探测一组主机是否在线
	- 推断主机所用的操作系统，到达主机经过的路由，系统已开放端口的软件版本
- nmap 常用的几个参数

		nmap -v ip 显示详细的扫描过程
		nmap -p  ip  扫描指定端口
		nmap -A ip  全面扫描操作系统
		nmap -sP ip  进行ping扫描主机存活
		nmap -Pn/-P0 ip 禁ping扫描
		nmap -sS ip 进行tcp syn扫描 也叫半开放扫描
		nmap -sT ip 进行tcp连接扫描 （准确性高）
- 端口状态信息
	- open ：端口开启
	- closed ：端口关闭
	- filtered ：端口被过滤，因为报文被防火墙拦截
	- Unfiltered ：不确定端口是否开放 没有被过滤
	- open|filtered(closed|filtered) ：不能确定端口是否开放（关闭）或者被过滤