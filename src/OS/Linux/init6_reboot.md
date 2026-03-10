## init 6 VS reboot
- 对这两个操作使用man命令看到的内容如下：
> init 6 Stop the operating system and reboot to the state defined by the initdefault entry in /etc/inittab.
> reboot – reboot performs a sync(1M) operation on the disks, and then a multi- user reboot is initiated. See init(1M) for details.

- “init 6″基于一系列/etc/inittab文件，并且每个应用都会有一个相应shutdown脚本。
- “init 6″调用一系列shutdown脚本(/etc/rc0.d/K*)来使系统优雅关机；
- “reboot”并不执行这些过程，reboot更是一个kernel级别的命令，不对应用使用shutdown脚本。
- 所以我们应该在通常情况下使用 init 6。
- 在出问题的状况下或强制重启时使用reboot。
