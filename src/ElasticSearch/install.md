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
- 


