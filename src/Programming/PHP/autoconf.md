## 升级autoconf
- 编译php扩展时，执行phpize命令后，报错"Autoconf version 2.68 or higher is required"
- 升级autoconf
``` shell
$ wget http://ftp.gnu.org/gnu/autoconf/autoconf-latest.tar.gz
$ tar -zxvf autoconf-latest.tar.gz 
$ cd autoconf-2.69/
$ ./configure --prefix=/usr
$ make
$ make install
$ autoconf --version 
```