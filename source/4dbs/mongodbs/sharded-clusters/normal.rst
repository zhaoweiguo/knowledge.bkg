常用
####

MongoDB 分片集群的三个组件::

    1. shard
       每个分片是整体数据的一部分子集。每个分片都可以部署为副本集
       强烈建议在生产环境下将分片部署为副本集且最少部署 2 个分片
    2. mongos
       充当查询路由器，提供客户端应用程序和分片集群之间的接口
       应用程序直接连接 mongos 即可，可以部署一个或多个
    3. config servers
       配置服务器存储集群的元数据和配置（包括权限认证相关）
       从 MongoDB 3.4 开始，必须将配置服务器部署为副本集
       （CSRS，全称是 Config Servers Replica Set）

.. figure:: /images/dbs/mongodbs/shard_structure1.png

   MongoDB 分片集群的架构图







