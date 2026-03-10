## 升级gcc到4.8.5
- 获取gcc4.8.5的源码包

		$ wget http://ftp.gnu.org/gnu/gcc/gcc-4.8.5/gcc-4.8.5.tar.bz2
- 解压压缩包

		$ tar -jxvf gcc-4.8.5.tar.bz2
- 进入解压后的目录

		$ cd gcc-4.8.5
- 下载、配置和安装需要的依赖库
	
    	$ ./contrib/download_prerequisites //这个脚本文件会自动帮我们下载、配置、安装依赖库，可以节约我们大量的时间和精力。
        //若是离线安装，需要手动下载
        $ cat ./contrib/download_prerequisites
        #! /bin/sh
        MPFR=mpfr-2.4.2
        GMP=gmp-4.3.2
        MPC=mpc-0.8.1

        wget ftp://gcc.gnu.org/pub/gcc/infrastructure/$MPFR.tar.bz2 || exit 1
        tar xjf $MPFR.tar.bz2 || exit 1
        ln -sf $MPFR mpfr || exit 1

        wget ftp://gcc.gnu.org/pub/gcc/infrastructure/$GMP.tar.bz2 || exit 1
        tar xjf $GMP.tar.bz2  || exit 1
        ln -sf $GMP gmp || exit 1

        wget ftp://gcc.gnu.org/pub/gcc/infrastructure/$MPC.tar.gz || exit 1
        tar xzf $MPC.tar.gz || exit 1
        ln -sf $MPC mpc || exit 1
        rm $MPFR.tar.bz2 $GMP.tar.bz2 $MPC.tar.gz || exit 1
        //可以看到，这个脚本下载了mpfr、gmp、mpc依赖，手动下载到gcc-4.8.5目录下

- 直接在当前目录下创建一个目录，存放编译后的文件。
	
    	$ mkdir gcc-build-4.8.5
- 进入这个目录来编译

		$ cd gcc-build-4.8.5
- 生成Makefile文件，准备编译整个项目（gcc4.8.5）

		$ ../configure -enable-checking=release -enable-languages=c,c++ -disable-multilib
- 编译安装

		$ make && make install
- 替换系统低版本gcc  
系统自带低版本 gcc 文件位置为/usr/bin/gcc和/usr/bin/lib，(新编译的gcc在/usr/local/bin下)此时需要将这些命令后缀加上.bak，然后通过建立软连接的方式替换系统默认位置的 gcc、c++、g++ 文件。

		$ cd /usr/bin
		$ mv ./c++ ./c++.bak
		$ mv ./g++ ./g++.bak
		$ mv ./gcc ./gcc.bak
		$ ln -s /usr/local/bin/c++ /usr/bin/c++
		$ ln -s /usr/local/bin/g++ /usr/bin/g++
		$ ln -s /usr/local/bin/gcc /usr/bin/gcc
- 替换系统gcc动态链接库

        $ strings /usr/lib64/libstdc++.so.6 | grep GLIBC
        GLIBCXX_3.4
        GLIBCXX_3.4.1
        GLIBCXX_3.4.2
        GLIBCXX_3.4.3
        GLIBCXX_3.4.4
        GLIBCXX_3.4.5
        GLIBCXX_3.4.6
        GLIBCXX_3.4.7
        GLIBCXX_3.4.8
        GLIBCXX_3.4.9
        GLIBCXX_3.4.10
        GLIBCXX_3.4.11
        GLIBCXX_3.4.12
        GLIBCXX_3.4.13
        GLIBC_2.2.5
        GLIBC_2.3
        GLIBC_2.4
        GLIBC_2.3.2
        GLIBCXX_FORCE_NEW
        GLIBCXX_DEBUG_MESSAGE_LENGTH
        [root@sft-sfxzsp-db-02 ~]# find / -name "libstdc++.so*"
        /usr/lib/gcc/x86_64-redhat-linux/4.4.4/libstdc++.so
        /usr/lib64/libstdc++.so.6
        /usr/lib64/libstdc++.so.6.0.13
        /usr/lib64/libcastools/libstdc++.so.6
        /usr/local/lib64/libstdc++.so.6.0.19-gdb.py
        /usr/local/lib64/libstdc++.so.6.0.19
        /usr/local/lib64/libstdc++.so.6
        /usr/local/lib64/libstdc++.so
        $ ll /usr/lib64/libstdc++.so.6
        lrwxrwxrwx 1 root root 19 Jul 11 02:24 /usr/lib64/libstdc++.so.6 -> libstdc++.so.6.0.13
        $ ll /usr/local/lib64/libstdc++.so.6
        lrwxrwxrwx 1 root root 19 Jul 31 12:25 /usr/local/lib64/libstdc++.so.6 -> libstdc++.so.6.0.19
        //执行替换操作
        $ rm -rf /usr/lib64/libstdc++.so.6
        $ ln -s /usr/local/lib64/libstdc++.so.6.0.19 /usr/lib64/libstdc++.so.6
        $ ll /usr/lib64/libstdc++.so.6
		lrwxrwxrwx 1 root root 36 Aug  1 00:58 /usr/lib64/libstdc++.so.6 -> /usr/local/lib64/libstdc++.so.6.0.19
        $ strings /usr/lib64/libstdc++.so.6 | grep GLIBC //核实替换结果


