## 使用 Systemd 进行服务管理
>
> <http://www.ruanyifeng.com/blog/2016/03/systemd-tutorial-commands.html>

- 启用开机自动启动

```shell
sudo systemctl enable tonghttpserver
```

- 验证是否已启用

```shell
sudo systemctl is-enabled tonghttpserver
```

- 查看所有启用开机启动的服务

```shell
systemctl list-unit-files | grep enabled
```

- 修改了配置文件后，重新加载**systemd 的配置文件**。（这个命令**不会重启任何服务**）

```shell
systemctl daemon-reload
```

