## 使用 Systemd 进行服务管理
> http://www.ruanyifeng.com/blog/2016/03/systemd-tutorial-commands.html

## 启用开机自动启动

	sudo systemctl enable tonghttpserver

## 验证是否已启用

	sudo systemctl is-enabled tonghttpserver

## 查看所有启用开机启动的服务

	systemctl list-unit-files | grep enabled