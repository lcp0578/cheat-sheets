## SELinux
> SELinux是一种基于 域-类型 模型(domain-type)的强制访问控制(MAC)安全系统

- 查看状态
	- `/usr/sbin/sestatus -v` 如果SELinux status参数为enabled即为开启状态
	- `getenforce` 结果：enforcing开启，permissive关闭
- 关闭
	- 临时关闭 `$ setenforce 0`
	- 修改配置文件,`$ vim /etc/selinux/config`，将`SELINUX=enforcing`改为`SELINUX=disabled`