## access_list 配置笔记
> Symfony creates an instance of RequestMatcher for each access_control entry, which determines whether or not a given access control should be used on this request. 

- 配置项
	- path
	- ip or ips (netmasks are also supported)
	- host
	- methods
	
> https://symfony.com/doc/current/security/access_control.html