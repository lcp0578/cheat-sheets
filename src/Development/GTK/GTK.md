## GTK
> GTK（原名GTK+）最初是GIMP的专用开发库（GIMP Toolkit），后来发展为Unix-like系统下开发图形界面的应用程序的主流开发工具之一。

- GTK使用C语言开发，但是其设计者使用面向对象技术。也提供了C++（gtkmm）、Perl、Ruby、Java和Python（PyGTK）绑定，其他的绑定有Ada、D、Haskell、PHP和所有的.NET编程语言。与其他很多部件工具箱不同，GTK并不基于Xt。这一决策优劣互见：优点是GTK可以应用于其他系统，其灵活性也很强；而缺点就是它无法利用以传统方法为X11定制的X资源数据库。GTK最早应用于X Window System，如今已移植至其他平台，诸如Microsoft Windows、DirectFB，以及Mac OS X平台上的Quartz.

### 使用GTK的环境
- GNOME是以GTK为基础，就是说为GNOME编写的程序使用GTK做为其工具箱。
- Xfce也基于GTK，但是它的应用程序并不对很多其他程序有依赖。（这就是"GNOME程序"和"GTK程序"的不同。）
- LXDE也基于GTK，一个尽可能减少包相依性的桌面环境。
- GPE Palmtop环境和Nokia的互联网平板电脑的框架Maemo基于GTK。
这只是一部分，另外，GTK也可以运行在KDE的环境下。而且GTK也可以在Microsoft Windows运行，另外还有DirectFB和ncurses。

### 使用GTK的窗口管理器
- Metacity和Xfwm4使用GTK 2.

### GTK应用程序
以下程序都是使用GTK开发、属于开源软件，可以运行于Linux/Unix，Windows，macOS等多种操作系统平台上。

- Firefox－Mozilla基金会的网页浏览器。
- Geany－代码编辑器
- GIMP－类似于Photoshop的图像处理程序
- Inkscape－类似于Illustrator、CorelDraw的矢量图形绘制工具
- Pidgin－支持多种协议（IRC、Gtalk、Yahoo Talk、MSN等等）的聊天工具
- gcin－一种在Linux、Windows系统上常见的输入法平台