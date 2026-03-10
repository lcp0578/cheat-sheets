## iconv

- iconv help

		iconv --help
        Usage: iconv [OPTION...] [-f ENCODING] [-t ENCODING] [INPUTFILE...]
        or:    iconv -l

        Converts text from one encoding to another encoding.

        Options controlling the input and output format:
          -f ENCODING, --from-code=ENCODING
                                      the encoding of the input
          -t ENCODING, --to-code=ENCODING
                                      the encoding of the output

        Options controlling conversion problems:
          -c                          discard unconvertible characters
          --unicode-subst=FORMATSTRING
                                      substitution for unconvertible Unicode characters
          --byte-subst=FORMATSTRING   substitution for unconvertible bytes
          --widechar-subst=FORMATSTRING
                                      substitution for unconvertible wide characters

        Options controlling error output:
          -s, --silent                suppress error messages about conversion problems

        Informative output:
          -l, --list                  list the supported encodings
          --help                      display this help and exit
          --version                   output version information and exit

        Report bugs to <bug-gnu-libiconv@gnu.org>.

- iconv用法

		iconv --list # 显示可识别的编码名称iconv --list >./infomation.log # 显示可识别的编码名称，将信息存入infomation.log文件中
        iconv -f GB2312 -t UTF-8 a.html > b.html # 转换GB2312编码的文件a.html为UTF-8编码，存入b.html
        iconv -f GB2312 -t BIG5 a.html > b.html # 转换GB2312编码的文件a.html为BIG5编码，存入b.html

- mac下gbk文件转utf-8

		find *.php -exec sh -c "iconv -f GB2312 -t UTF8 {} > {}.utf8.php" \;  