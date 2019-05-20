## git update  git版本更新
- 在服务器上直接git clone项目的版本库的时候报401错误
	错误如下：：error: The requested URL returned error: 401 Unauthorized while accessing
	原因：git 版本过低
- 查看git版本

        # git --version
        git version 1.7.1
- 卸载系统自带的低版本git

		# yum remove git
- 升级git
	- 更新yum
	
    		yum update
	- 安装依赖包
	
    		yum install curl-devel expat-devel gettext-devel openssl-devel zlib-devel gcc perl-ExtUtils-MakeMaker
	- 下载git源码包
	
    		wget https://github.com/git/git/archive/v2.18.0.tar.gz
            //或 https://mirrors.edge.kernel.org/pub/software/scm/git/
    - 解压、安装
    
    		# tar -zxvf v2.18.0.tar.gz
            # whereis git
            git: /usr/bin/git /usr/share/man/man1/git.1.gz
            # cd git-2.18.0/
            # ./configure --prefix=/usr/local --with-iconv=/usr/local/libiconv
            # make && make install
- 验证版本号

        # git --version
        git version 2.18.0
- 解决安装时libiconv报错
	- 报错信息
	
            LINK git-credential-store
            libgit.a(utf8.o): In function `reencode_string_iconv':
            /usr/src/git-2.8.3/utf8.c:463: undefined reference to `libiconv'
            libgit.a(utf8.o): In function `reencode_string_len':
            /usr/src/git-2.8.3/utf8.c:502: undefined reference to `libiconv_open'
            /usr/src/git-2.8.3/utf8.c:521: undefined reference to `libiconv_close'
            /usr/src/git-2.8.3/utf8.c:515: undefined reference to `libiconv_open'
            collect2: ld returned 1 exit status
            make: *** [git-credential-store] Error 1
    - 安装libiconv
     
			# cd /usr/local/src
			# wget http://ftp.gnu.org/pub/gnu/libiconv/libiconv-1.14.tar.gz
			# tar -zxvf libiconv-1.14.tar.gz
			# cd libiconv-1.14
			# ./configure --prefix=/usr/local/libiconv  &&  make  && make install
    - 创建一个软链接到/usr/lib
      
			# ln -s /usr/local/lib/libiconv.so /usr/lib
			# ln -s /usr/local/lib/libiconv.so.2 /usr/lib