常用
####


帮助::

    db.getCollection("word").explain().help()


explain 支持三种分析模式::

    queryPlanner(仅给出执行计划，默认)
    executionStats(给出执行计划并执行)
    allPlansExecution(前两种的结合)


explain返回字段说明::

    nReturned：执行返回的文档数
    executionTimeMillis： 执行时间（ms）
    totalKeysExamined：索引扫描条数
    totalDocsExamined：文档扫描条数
    executionStages：执行步骤



Mongo 常见的执行步骤stage::

    COLLSCAN 文档扫描(Collection Scan)
    IXSCAN 索引扫描
    FETCH 检索文档
    SORT 内存排序
    COUNT 位于根节点，计算子节点所返回的条目
    COUNT_SCAN 基于索引的统计
    PROJECTION 字段映射
    OR $or 查询子句全部命中索引时出现
    LIMIT 结果集条数限制
    SKIP 从结果集中跳过部分条目
    IDHACK _id 查询

    SINGLE_SHARD:   数据在一个shard中
    SHARD_MERGE:    数据分布在多个shard中



@todo::

    分片表，不分片的话，一个db使用一个shard，另一个db使用另一个shard?





