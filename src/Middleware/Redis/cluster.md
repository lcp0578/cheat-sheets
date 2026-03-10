## Redis cluster
- 官方文档
> https://redis.io/topics/cluster-tutorial
- 背景
	- 其他方案，一直都是向1台redis写数据，其他的redis只是备份而已。实际场景中，单个redis节点可能不满足要求，因为：
		- 单个redis并发有限
		- 单个redis接收所有的数据，最终回导致内存太大，内存太大回导致rdb文件过大，从很大的rdb文件中同步恢复数据会很慢。

	因此，我们需要redis cluster 即redis集群。
- Redis Cluster介绍
	- Redis 集群是一个提供在**多个Redis间节点间共享数据**的程序集。
	- Redis集群并不支持处理多个keys的命令,因为这需要在不同的节点间移动数据,从而达不到像Redis那样的性能,在高负载的情况下可能会导致不可预料的错误.
	- Redis 集群通过分区来提供**一定程度的可用性**,在实际环境中当某个节点宕机或者不可达的情况下继续处理命令. Redis 集群的优势:
		- 自动分割数据到不同的节点上。
		- 整个集群的部分节点失败或者不可达的情况下能够继续处理命令。
- 集群部署
	- 至少需要6个节点
	> Note that the minimal cluster that works as expected requires to contain at least three master nodes.
	
    因为最小的redis集群，需要至少3个主节点，既然有3个主节点，而一个主节点搭配至少一个从节点，因此至少得6台redis。