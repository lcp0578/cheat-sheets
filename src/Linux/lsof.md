## lsof(list open files)
- 简介
	- lsof 是一个列出当前系统打开文件的工具。
	- 在linux环境下，任何事物都以文件的形式存在，通过文件不仅仅可以访问常规数据，还可以访问网络连接和硬件。所以如传输控制协议 (TCP) 和用户数据报协议 (UDP) 套接字等，系统在后台都为该应用程序分配了一个文件描述符，无论这个文件的本质如何，该文件描述符为应用程序与基础操作系统之间的交互提供了通用接口。因为应用程序打开文件的描述符列表提供了大量关于这个应用程序本身的信息。
- 查看端口占用情况

        $ sudo lsof -i :80
        COMMAND   PID    USER   FD   TYPE             DEVICE SIZE/OFF NODE NAME
        httpd      81    root    4u  IPv6 0xbca310699e3858f3      0t0  TCP *:http (LISTEN)
        httpd     413    _www    4u  IPv6 0xbca310699e3858f3      0t0  TCP *:http (LISTEN)