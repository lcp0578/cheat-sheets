## Snap版 与 APT版 Docker对比与配置

####  Snap版 与 APT版 Docker对比

| 特性             | Snap 版 Docker (docker snap)                                 | APT 版 Docker ([docker.io/docker-ce](https://docker.io/docker-ce)) |
| :--------------- | :----------------------------------------------------------- | :----------------------------------------------------------- |
| **安装方式**     | `sudo snap install docker`，一条命令搞定，极其简单。 | 需先添加 Docker 官方 GPG 密钥和软件源，再执行安装，过程稍显繁琐。 |
| **文件访问权限** | **默认严格受限**，只能访问 `/home` 和 `/root` 目录。 | **完全无限制**，可以访问系统任何路径。 |
| **配置文件位置** | 非标准路径：`/var/snap/docker/current/config/daemon.json`。 | 标准路径：`/etc/docker/daemon.json`。                        |
| **配置生效方式** | 必须通过 `sudo snap restart docker` 命令重启。 | 标准方式：`sudo systemctl restart docker`。                  |
| **更新机制**     | **默认自动更新**。好处是能快速获得新功能和安全补丁。 | **手动控制**，由 `apt` 包管理器统一管理，更新决策权在管理员手中。 |
| **核心设计**     | **自包含应用**。将自身和所有依赖打包在一起，像一个独立的应用，与系统其他部分隔离。 | **系统集成包**。更紧密地集成到操作系统中，依赖系统的共享库。 |
| **适用场景**     | 个人开发环境、快速测试、对稳定性要求不高的场景。 | 生产环境、服务器、需要高度可控的研发环境、对稳定性和兼容性有严格要求的场景 |

### snap版docker配置
- 1. 查看 Snap Docker 的完整配置

  	```
  	# cat /var/snap/docker/current/config/daemon.json
  	```
  	
  	

- 2. 手动编辑这个文件

        ```
        # sudo vim /var/snap/docker/current/config/daemon.json
        {
            "log-level": "error",
             "registry-mirrors": [
                "https://docker.1ms.run",
                "https://docker.xuanyuan.me"
            ]
        }
        ```
        
        

- 3. 重启并检查

        ```
        # sudo systemctl restart snap.docker.dockerd
        # docker info | grep -A 5 "Registry Mirrors"
         Registry Mirrors:
          https://docker.1ms.run/
          https://docker.xuanyuan.me/
         Live Restore Enabled: false
        ```