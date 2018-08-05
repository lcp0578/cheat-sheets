## rz & sz
- CentOS

		yum install lrzsz
- Mac上item2上安装
	- brew安装
	
			brew install lrzsz
    - 源码安装
    	- 下载源码包：www.ohse.de/uwe/releases/lrzsz-0.12.20.tar.gz
    	- 解压：tar -xvf lrzsz-0.12.20.tar.gz
    	- 准备编译：./configure
    	- 编译安装： make && make install
    	- 建立软连接
    	
        		ln -s /usr/local/bin/lsz /usr/local/bin/sz
				ln -s /usr/local/bin/lrz /usr/local/bin/rz
	- 配置ZModem（Automatic ZModem support for iTerm 2）
		- 下载shell脚本：https://github.com/mmastrac/iterm2-zmodem
		- 复制iterm2-recv-zmodem.sh和iterm2-send-zmodem.sh文件，放入/usr/local/bin目录。
	- 打开iTerm2设置界面，Profiles -> Advanced -> Edit
	
    		\*\*B010                                  Run Silent Coprocess        /usr/local/bin/iterm2-send-zmodem.sh

        	\*\*B00000000000000              Run Silent Coprocess        /usr/local/bin/iterm2-recv-zmodem.sh