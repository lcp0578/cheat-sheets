## 

- 在Ubuntu 22 上安装

```
sudo apt update
sudo apt install -y debian-keyring debian-archive-keyring apt-transport-https curl
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' | sudo gpg --dearmor -o /usr/share/keyrings/caddy-stable-archive-keyring.gpg
curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' | sudo tee /etc/apt/sources.list.d/caddy-stable.list
sudo chmod o+r /usr/share/keyrings/caddy-stable-archive-keyring.gpg
sudo chmod o+r /etc/apt/sources.list.d/caddy-stable.list
sudo apt update
sudo apt install caddy
```

- 安装完成后，主要文件说明
  - **主程序**：`/usr/bin/caddy`
  - **配置文件 (Caddyfile)**：`/etc/caddy/Caddyfile`
  - **服务单元**：`/lib/systemd/system/caddy.service`

- 服务管理
    - caddy服务管理：
       - 启动 `sudo systemctl start caddy`
       - 重启 `sudo systemctl restart caddy`
       - 停止`sudo systemctl stop caddy`
    - 手动启动（不推荐）：`caddy run --config /etc/caddy/Caddyfile`

- 示例：两个 vhost + 路径处理

    ```
    # vhost 1：内网 IP 提供 3D Tiles 和地图服务
    http://192.168.1.205:80 {
        handle_path /qinshui_river/* {
            root * /home/NVMe_data/qinshui_river
            file_server {
                index tileset.json
            }
            header {
                Access-Control-Allow-Origin *
            }
        }
        handle_path /map/* {
            root * /var/www/map
            file_server
        }
        handle {
            respond "Tile service running" 200
        }
    }
    
    # vhost 2：另一个端口提供管理后台
    http://192.168.1.205:8080 {
        reverse_proxy localhost:3000
    }
    ```

     - 说明：
       - 每个 { } 块就是一个虚拟主机。
       - 基于域名的站点直接写域名；基于 IP 的写成 http://ip:port。
       - Caddy 默认会为域名开启 HTTPS（自动申请证书），如果你的环境没有公网域名或无法验证，必须显式写上 http:// 来禁用 HTTPS。
       - 在一个站点内部，用 handle_path 或 route 实现路径分发，不需要额外创建 vhost。