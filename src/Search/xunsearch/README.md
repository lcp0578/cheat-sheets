## xunsearch
- mac安装遇到的问题

		bufferevent_openssl.c:60:10: fatal error: 'openssl/bio.h' file not found
		#include <openssl/bio.h>
		$ sudo find / -name  bio.h
        ind: /dev/fd/3: Not a directory
        find: /dev/fd/4: Not a directory
        /opt/vagrant/embedded/include/openssl/bio.h
        /usr/local/Homebrew/Cellar/openssl/1.0.2o_1/include/openssl/bio.h
        //建立一个软链接
        sudo ln -s /usr/local/Homebrew/Cellar/openssl/1.0.2o_1/include/openssl/ /usr/local/include/openssl
- 启动/重启

		$ cd 安装目录
        $ bin/xs-ctl.sh start|restart