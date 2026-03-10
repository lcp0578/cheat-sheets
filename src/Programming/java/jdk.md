## jdk安装
- 下载jdk
	下载地址：https://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html
- 创建java目录

		$ mkdir /usr/local/java
        $ cd /usr/local/java
        $ tar -zxvf jdk-8u181-linux-x64.tar.gz
- 创建环境变量

		$ vim /etc/profile
            JAVA_HOME=/usr/local/java/jdk1.8.0_181
            JRE_HOME=${JAVA_HOME}/jre
            CLASSPATH=.:${JAVA_HOME}/lib/dt.jar:${JAVA_HOME}/lib/tools.jar:${JRE_HOME}/lib

            export JAVA_HOME JRE_HOME CLASSPATH
            export PATH=$PATH:$JAVA_HOME/bin:$JRE_HOME/bin
        $ source /etc/profile
- 测试

		$ java -version
        java version "1.8.0_181"
        Java(TM) SE Runtime Environment (build 1.8.0_181-b13)
        Java HotSpot(TM) 64-Bit Server VM (build 25.181-b13, mixed mode)