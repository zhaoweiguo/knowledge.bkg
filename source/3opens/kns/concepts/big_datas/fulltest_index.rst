全文索引
############


Solr
'''''''''
Solr是一个高性能，采用Java5开发，基于Lucene的全文搜索服务器。同时对其进行了扩展，提供了比Lucene更为丰富的查询语言，同时实现了可配置、可扩展并对查询性能进行了优化，并且提供了一个完善的功能管理界面，是一款非常优秀的全文搜索引擎。

文档通过Http利用XML 加到一个搜索集合中。查询该集合也是通过http收到一个XML/JSON响应来实现。它的主要特性包括：高效、灵活的缓存功能，垂直搜索功能，高亮显示搜索结果，通过索引复制来提高可用性，提供一套强大Data Schema来定义字段，类型和设置文本分析，提供基于Web的管理界面等。




Elasticsearch
''''''''''''''''
ElasticSearch是一个基于Lucene的搜索服务器。它提供了一个分布式多用户能力的全文搜索引擎，基于RESTful web接口。Elasticsearch是用Java开发的，并作为Apache许可条款下的开放源码发布，是当前流行的企业级搜索引擎。设计用于云计算中，能够达到实时搜索，稳定，可靠，快速，安装使用方便。

cluster
代表一个集群，集群中有多个节点，其中有一个为主节点，这个主节点是可以通过选举产生的，主从节点是对于集群内部来说的。es的一个概念就是去中心化，字面上理解就是无中心节点，这是对于集群外部来说的，因为从外部来看es集群，在逻辑上是个整体，你与任何一个节点的通信和与整个es集群通信是等价的。
shards
代表索引分片，es可以把一个完整的索引分成多个分片，这样的好处是可以把一个大的索引拆分成多个，分布到不同的节点上。构成分布式搜索。分片的数量只能在索引创建前指定，并且索引创建后不能更改。
replicas
代表索引副本，es可以设置多个索引的副本，副本的作用一是提高系统的容错性，当某个节点某个分片损坏或丢失时可以从副本中恢复。二是提高es的查询效率，es会自动对搜索请求进行负载均衡。
recovery
代表数据恢复或叫数据重新分布，es在有节点加入或退出时会根据机器的负载对索引分片进行重新分配，挂掉的节点重新启动时也会进行数据恢复。
river
代表es的一个数据源，也是其它存储方式（如：数据库）同步数据到es的一个方法。它是以插件方式存在的一个es服务，通过读取river中的数据并把它索引到es中，官方的river有couchDB的，RabbitMQ的，Twitter的，Wikipedia的。
gateway
代表es索引快照的存储方式，es默认是先把索引存放到内存中，当内存满了时再持久化到本地硬盘。gateway对索引快照进行存储，当这个es集群关闭再重新启动时就会从gateway中读取索引备份数据。es支持多种类型的gateway，有本地文件系统（默认），分布式文件系统，Hadoop的HDFS和amazon的s3云存储服务。
discovery.zen
代表es的自动发现节点机制，es是一个基于p2p的系统，它先通过广播寻找存在的节点，再通过多播协议来进行节点之间的通信，同时也支持点对点的交互。
Transport
代表es内部节点或集群与客户端的交互方式，默认内部是使用tcp协议进行交互，同时它支持http协议（json格式）、thrift、servlet、memcached、zeroMQ等的传输协议（通过插件方式集成）。


.. _presto:

Presto
''''''''''

1.1 定义
Presto是一个分布式的查询引擎，本身并不存储数据，但是可以接入多种数据源，并且支持跨数据源的级联查询。Presto是一个OLAP的工具，擅长对海量数据进行复杂的分析；但是对于OLTP场景，并不是Presto所擅长，所以不要把Presto当做数据库来使用。

和大家熟悉的Mysql相比：首先Mysql是一个数据库，具有存储和计算分析能力，而Presto只有计算分析能力；其次数据量方面，Mysql作为传统单点关系型数据库不能满足当前大数据量的需求，于是有各种大数据的存储和分析工具产生，Presto就是这样一个可以满足大数据量分析计算需求的一个工具。

1.2 数据源
Presto需要从其他数据源获取数据来进行运算分析，它可以连接多种数据源，包括Hive、RDBMS（Mysql、Oracle、Tidb等）、Kafka、MongoDB、Redis等

一条Presto查询可以将多个数据源的数据进行合并分析。
比如：select * from a join b where a.id=b.id;，其中表a可以来自Hive，表b可以来自Mysql。

1.3 优势
Presto是一个低延迟高并发的内存计算引擎，相比Hive，执行效率要高很多。


1.4数据模型
Presto使用Catalog、Schema和Table这3层结构来管理数据。

Catalog:就是数据源。Hive是数据源，Mysql也是数据源，Hive 和Mysql都是数据源类型，可以连接多个Hive和多个Mysql，每个连接都有一个名字。一个Catalog可以包含多个Schema，大家可以通过show catalogs 命令看到Presto连接的所有数据源。
Schema：相当于一个数据库实例，一个Schema包含多张数据表。show schemas from 'catalog_name'可列出catalog_name下的所有schema。
Table：数据表，与一般意义上的数据库表相同。show tables from 'catalog_name.schema_name'可查看'catalog_name.schema_name'下的所有表。

在Presto中定位一张表，一般是catalog为根，例如：一张表的全称为 hive.test_data.test，标识 hive(catalog)下的 test_data(schema)中test表。
可以简理解为：数据源的大类.数据库.数据表。


Presto与Hive:

Hive是一个基于HDFS(分布式文件系统)的一个数据库，具有存储和分析计算能力， 支持大数据量的存储和查询。Hive 作为数据源，结合Presto分布式查询引擎，这样大数据量的查询计算速度就会快很多。

Presto支持标准SQL，这里需要提醒大家的是，在使用Hive数据源的时候，如果表是分区表，一定要添加分区过滤，不加分区扫描全表是一个很暴力的操作，执行效率低下并且占用大量集群资源，大家尽量避免这种写法。

这里提到Hive分区，我简单介绍一下概念。Hive分区就是分目录，把一个大的数据集根据业务需要分割成更细的数据集。

















