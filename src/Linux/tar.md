## tar
- tar帮助文档

		tar --help
        tar(bsdtar): manipulate archive files
        First option must be a mode specifier:
          -c Create  -r Add/Replace  -t List  -u Update  -x Extract
        Common Options:
          -b #  Use # 512-byte records per I/O block
          -f <filename>  Location of archive
          -v    Verbose #显示进度信息
          -w    Interactive
        Create: tar -c [options] [<file> | <dir> | @<archive> | -C <dir> ]
          <file>, <dir>  add these items to archive
          -z, -j, -J, --lzma  Compress archive with gzip/bzip2/xz/lzma
          --format {ustar|pax|cpio|shar}  Select archive format
          --exclude <pattern>  Skip files that match pattern
          -C <dir>  Change to <dir> before processing remaining files
          @<archive>  Add entries from <archive> to output
        List: tar -t [options] [<patterns>]
          <patterns>  If specified, list only entries that match
        Extract: tar -x [options] [<patterns>]
          <patterns>  If specified, extract only entries that match
          -k    Keep (don't overwrite) existing files
          -m    Don't restore modification times
          -O    Write entries to stdout, don't restore to disk
          -p    Restore permissions (including ACLs, owner, file flags)
        bsdtar 2.8.3 - libarchive 2.8.3
- 解压
	- .tar.gz     
		
			tar   -zxvf   xx.tar.gz
	- .tar.bz2   
	
			tar   -jxvf    xx.tar.bz2
	- 解压到指定目录
	
			tar jzxvf xx.tar.gz -C /home/dist
- 压缩
	- .tar.gz
	
			tar -czf test.tar.gz test(目录)
- 仅打包，不压缩
	- .tar
	
    		tar -cvf /tmp/etc.tar /etc 
- 总结

        tar -xvf file.tar //解压 tar包

        tar -xzvf file.tar.gz //解压tar.gz

        tar -xjvf file.tar.bz2   //解压 tar.bz2

        tar -xZvf file.tar.Z   //解压tar.Z

        unrar e file.rar //解压rar

		unzip file.zip -d dir //解压zip,到dir中
- 解压总结
	- .tar 
		- 解包：tar xvf FileName.tar
		- 打包：tar cvf FileName.tar DirName
	- .gz
		- 解压1：gunzip FileName.gz
		- 解压2：gzip -d FileName.gz
		- 压缩：gzip FileName

	- .tar.gz 和 .tgz
		- 解压：tar zxvf FileName.tar.gz
		- 压缩：tar zcvf FileName.tar.gz DirName
	- .bz2
		- 解压1：bzip2 -d FileName.bz2
		- 解压2：bunzip2 FileName.bz2
		- 压缩： bzip2 -z FileName
	- .tar.bz2
		- 解压：tar jxvf FileName.tar.bz2
		- 压缩：tar jcvf FileName.tar.bz2 DirName
	- .bz
		- 解压1：bzip2 -d FileName.bz
		- 解压2：bunzip2 FileName.bz
	- .tar.bz
		- 解压：tar jxvf FileName.tar.bz
	- .Z
		- 解压：uncompress FileName.Z
		- 压缩：compress FileName
	- .tar.Z
		- 解压：tar Zxvf FileName.tar.Z
		- 压缩：tar Zcvf FileName.tar.Z DirName
	- .zip
		- 解压：unzip FileName.zip
		- 压缩：zip FileName.zip DirName
	- .rar
		- 解压：rar x FileName.rar
		- 压缩：rar a FileName.rar DirName
	- .lha
		- 解压：lha -e FileName.lha
		- 压缩：lha -a FileName.lha FileName
	- .rpm
		- 解包：rpm2cpio FileName.rpm | cpio -div
	- .deb
		- 解包：ar p FileName.deb data.tar.gz | tar zxf -
