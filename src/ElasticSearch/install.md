## ElasticSearch install
- 使用rpm包安装

		$ rpm -ivh elasticsearch-7.5.1-x86_64.rpm 
        warning: elasticsearch-7.5.1-x86_64.rpm: Header V4 RSA/SHA512 Signature, key ID d88e42b4: NOKEY
        Preparing...                ########################################### [100%]
        Creating elasticsearch group... OK
        Creating elasticsearch user... OK
           1:elasticsearch          ########################################### [100%]
        ### NOT starting on installation, please execute the following statements to configure elasticsearch service to start automatically using chkconfig
         sudo chkconfig --add elasticsearch
        ### You can start elasticsearch service by executing
         sudo service elasticsearch start
        future versions of Elasticsearch will require Java 11; your Java version from [/usr/local/java/jdk1.8.0_231/jre] does not meet this requirement
        Created elasticsearch keystore in /etc/elasticsearch
- 安装目录 `/usr/share/elasticsearch/`
- 配置文件目录 `/etc/elasticsearch/`
- 启动 `./bin/elasticsearch -d`
- 启动报错
	- error1:(修改配置文件)

			[cluster.initial master nodes] is empty on this node

	- error2:(修改配置文件)

			the default discovery settings are unsuitable for production use; at least one of [discovery.seed_hosts, discovery.seed_providers, cluster.initial_master_nodes] must be configured
    - max number of threads [1024] for user [es] likely too low, increase to at least [4096]
	原因：无法创建本地线程问题,用户最大可创建线程数太小
	解决方案：切换到root用户，进入limits.d目录下，修改90-nproc.conf 配置文件。
    
            vi /etc/security/limits.d/90-nproc.conf
            #找到如下内容：
            * soft nproc 1024
            #修改为
            * soft nproc 4096



