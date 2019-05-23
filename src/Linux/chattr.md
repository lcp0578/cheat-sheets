## chattr
- 介绍
在Linux ext文件系统中，权限控制除了常规的chmod，还会有文件属性管理，故出现了chattr命令。 
在linux系统中，内核在2.6以上的，均可执行此命令。通过chattr命令修改属性能够提高系统的安全性，但是它并不适合所有的目录。chattr命令不能保护/、/dev、/tmp、/var目录。lsattr命令是显示chattr命令设置的文件属性。
- root删除文件失败
``` shell
	[root@iZ8vbdufl6tqx12z]# ls -al
    总用量 12
    drwxr-xr-x  2 www  www  4096 5月  21 10:29 .
    drwxr-xr-x 38 root root 4096 5月  13 14:43 ..
    -rw-r--r--  1 root root   59 8月  14 2018 .user.ini
    [root@iZ8vbdufl6tqx12z]# rm -rf .user.ini
    rm: 无法删除".user.ini": 不允许的操作
    [root@iZ8vbdufl6tqx12z#
    [root@iZ8vbdufl6tqx12z]# chattr -i .user.ini
    [root@iZ8vbdufl6tqx12z]#
    [root@iZ8vbdufl6tqx12z]#
    [root@iZ8vbdufl6tqx12z]# rm -rf .user.ini
    [root@iZ8vbdufl6tqx12z]#
    [root@iZ8vbdufl6tqx12z]# ls -al
    总用量 8
    drwxr-xr-x  2 www  www  4096 5月  23 09:41 .
    drwxr-xr-x 38 root root 4096 5月  13 14:43 ..
```