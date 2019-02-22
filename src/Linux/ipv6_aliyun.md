## Aliyun服务器ipv6隧道配置
- 修改服务器的配置
	- vim /etc/modprobe.d/disable_ipv6.conf
	
            alias net-pf-10 off
            options ipv6 disable=0
	- vim /etc/sysconfig/network
	
			NETWORKING_IPV6=yes
    - vim /etc/sysconfig/network-scripts/ifcfg-eth0
    
            IPV6INIT=yes
            IPV6_AUTOCONF=yes
    - vim /etc/sysctl.conf

            net.ipv6.conf.all.disable_ipv6 = 0
            net.ipv6.conf.default.disable_ipv6 = 0
            net.ipv6.conf.lo.disable_ipv6 = 0
    - sysctl -p
- 重启服务器
	- init 6
- tunnelbroker
	- Create Regular Tunnel
	- Example Configurations -> Linux-route2
	
    		modprobe ipv6
            ip tunnel add he-ipv6 mode sit remote 216.218.221.6 local 172.26.216.87 ttl 255 #此处一定要换成内网IP：172.26.216.87
            ip link set he-ipv6 up
            ip addr add 2001:470:18:14b3::2/64 dev he-ipv6
            ip route add ::/0 dev he-ipv6
            ip -f inet6 addr
- 测试
	- ping6 ipv6.baidu.com 进行测试
    - http://ipv6-test.com/validate.php
- 配置修改
	- nginx
	
            server {
                listen 80; // 监听 IPv4 的 80 端口
                listen [::]:80; // 监听 IPv6 的 80 端口
            }
            server {
                listen 443 ssl http2; // 监听 IPv4 的 443 端口
                listen [::]:443 ssl http2; // 监听 IPv6 的 443 端口
            }
	- 域名解析
		- 为网站域名添加AAAA解析，值填 HE 里的Client IPv6 Address，，去掉最后的/64 即可。如2001:470:18:14b3::2。
