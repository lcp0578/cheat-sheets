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

		unzip file.zip //解压zip
