## short cut
- vscode 
    - 新建文件vscode.desktop，命令如下：

            sudo gedit  /usr/share/applications/vscode.desktop 
    - 添加如下内容并保存

            [Desktop Entry] 
            Encoding=UTF-8 
            Name=vscode  
            Comment=VSCode IDE  
            Exec=/use/share/code/code // 可执行文件的路径
            Icon=/use/share/code/blink_image_resources_200_percent.pak  //图标
            Terminal=false  //为false表示启动时不启动命令行窗口，值为true表示启动命令行窗口
            StartupNotify=true  
            Type=Application  
            Categories=Application;Development; // Categories这里的内容决定创建出的起动器在应用程序菜单中的位置
