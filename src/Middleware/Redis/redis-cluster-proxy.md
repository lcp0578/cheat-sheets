## Redis 6 redis-cluster-proxy
> 伴随着Redis6.0的发布，Redis官方同时推出Redis集群的proxy：redis-cluster-proxy

- redis-cluster-proxy主要特性
	- redis-cluster-proxy是Redis集群的代理。Redis能够在基于自动故障转移和分片的集群模式下运行。
	- 这种特殊模式（指Redis集群模式）需要使用特殊的客户端来理解集群协议:通过代理，集群被抽象了出来，可以实现像单实例一样实现redis集群的访问。
	- Redis集群代理是多线程的，默认情况下，它目前使用多路复用通信模型，这样每个线程都有自己的集群连接，所有属于线程本身的客户端都可以共享该连接。
	- 无论如何，在某些特殊情况下(多事务或阻塞命令)，多路复用被禁用，客户端将拥有自己的集群连接。
	- 通过这种方式，只发送简单命令(比如get和set)的客户端将不需要一组到Redis集群的私有连接。
- 安装注意事项
	- Redis 6.0以及redis-cluster-proxy的编译依赖于gcc 5+，centos 7上的默认gcc版本是4.+，无法满足编译要求
