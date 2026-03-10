## Redis Sentinel
- 官方文档
> https://redis.io/topics/sentinel
- Redis-Sentinel(哨兵模式)介绍
	- Redis-Sentinel(哨兵模式)是Redis官方推荐的高可用性(HA)解决方案
	- Redis-sentinel本身也是一个独立运行的进程，它能监控多个master-slave集群，发现master宕机后能进行自动切换。
	- 它的主要功能有以下几点：
		- 不时地监控redis是否按照预期良好地运行;
		- 如果发现某个redis节点运行出现状况，能够通知另外一个进程(例如它的客户端);
		- 能够进行自动切换。当一个master节点不可用时，能够选举出master的多个slave(如果有超过一个slave的话)中的一个来作为新的master,其它的slave节点会将它所追随的master的地址改为被提升为master的slave的新地址。
		- 客户端连接redis主从的时候，先连接 sentinel，sentinel会告诉客户端主redis的地址是多少，然后客户端连接上redis并进行后续的操作。
- Redis-Sentinel配置