## 主流图数据库对比总结
<table>
    <tr>
        <th>特性</th>
        <th>JanusGraph</th>
        <th>Neo4j</th>
        <th>Dgraph</th>
        <th>NebulaGraph</th>
    </tr>
    <tr>
        <td>首次发布</td>
        <td>2017年</td>
        <td> 2007年</td>
        <td> 2016年</td>
        <td> 2019年</td>
    </tr>
    <tr>
        <td>开发语言 </td>
        <td>Java </td>
        <td>Java</td>
        <td> Go </td>
        <td>C++</td>
    </tr>
    <tr>
        <td>开源</td>
        <td>是 </td>
        <td>是</td>
        <td> 是 </td>
        <td>是
        </td>
    </tr>
    <tr>
        <td>属性图模型</td>
        <td>完整的属性图模型</td>
        <td>完整的属性图模型 </td>
        <td>类RDF存储 </td>
        <td>完整的属性图模型
        </td>
    </tr>
    <tr>
        <td>架构 </td>
        <td>分布式 </td>
        <td>单机</td>
        <td>分布式</td>
        <td>分布式
        </td>
    </tr>
    <tr>
        <td>存储后端 </td>
        <td> Hbase、Cassandra、BerkeleyDB </td>
        <td>自定义文件格式</td>
        <td> 键值数据库BadgerDB </td>
        <td>键值数据库 RocksDB
        </td>
    </tr>
    <tr>
        <td>高可用性 </td>
        <td>支持</td>
        <td>不支持 </td>
        <td>支持 </td>
        <td>支持
        </td>
    </tr>
    <tr>
        <td>高可靠性 </td>
        <td>支持</td>
        <td>不支持 </td>
        <td>支持</td>
        <td>支持
        </td>
    </tr>
    <tr>
        <td>一致性协议 </td>
        <td>Paxos等</td>
        <td> 无</td>
        <td> RAFT </td>
        <td>RAFT
        </td>
    </tr>
    <tr>
        <td>跨数据中心复制 </td>
        <td>支 持 </td>
        <td>不支持 </td>
        <td>支持</td>
        <td>不支持
        </td>
    </tr>
    <tr>
        <td>事务 </td>
        <td>ACID或BASE </td>
        <td>完全的ACID </td>
        <td>Omid修改版 </td>
        <td>不支持
        </td>
    </tr>
    <tr>
        <td>分区策略</td>
        <td>随机分区，支持显式指定分区策略 </td>
        <td>不支持分区</td>
        <td>自动分区 </td>
        <td>静态分区
        </td>
    </tr>
    <tr>
        <td>大数据平台集成</td>
        <td> Spark、Hadoop、Giraph </td>
        <td>Spark </td>
        <td>不支持</td>
        <td> Spark、Flink
        </td>
    </tr>
    <tr>
        <td>查询语言</td>
        <td> Gremlin </td>
        <td>Cypher </td>
        <td>GraphQL</td>
        <td> nGQL
        </td>
    </tr>
    <tr>
        <td>全文检索 </td>
        <td>ElasticSearch、Solr、Lucene </td>
        <td>内置 </td>
        <td>内置 </td>
        <td>ElasticSearch
        </td>
    </tr>
    <tr>
        <td>多个图 </td>
        <td>支持创建任意多图 </td>
        <td>一个实例只能有一个图 </td>
        <td>一个集群只能有一个图 </td>
        <td>支持创建任意多图
        </td>
    </tr>
    <tr>
        <td>属性图模式 </td>
        <td>多种约束方法</td>
        <td> 可选模式约束 </td>
        <td>无模式</td>
        <td> 强制模式约束
        </td>
    </tr>
    <tr>
        <td>客户端协议 </td>
        <td>HTTP、WebSockets</td>
        <td> HTTP、BOLT </td>
        <td>HTTP、gRPC等 HTTP
        </td>
    </tr>
    <tr>
        <td>客户端语言</td>
        <td>Java、Python、C#、Go、Ruby、Rust等</td>
        <td>Java、.NET、JavaScript、Python、Go等</td>
        <td>Java、Go、Python、.NET等 </td>
        <td>Python、Java等
        </td>
    </tr>
</table>