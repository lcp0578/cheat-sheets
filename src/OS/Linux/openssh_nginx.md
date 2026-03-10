## 升级完OpenSSH后，xshell断开nginx进程被杀死
- 主要就是openssh8+以上的版本对安全策略做了修改。
- 解决办法：
	- 在/usr/lib/systemd/system/sshd@.service配置下追加`KillMode=process`