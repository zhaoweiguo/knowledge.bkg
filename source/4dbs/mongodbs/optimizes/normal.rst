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

    COLLSCAN 文档扫描(Collection Scan)即:未命中索引
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


    COLLSCAN：全表扫描
    IXSCAN：索引扫描
    FETCH：根据索引去检索指定 document
    SHARD_MERGE：将各个分片返回数据进行 merge
    SORT：表明在内存中进行了排序
    LIMIT：使用 limit 限制返回数
    SKIP：使用 skip 进行跳过
    IDHACK：针对_id 进行查询
    SHARDING_FILTER：通过 mongos 对分片数据进行查询
    COUNT：利用 db.coll.explain ().count () 之类进行 count 运算
    COUNTSCAN：count 不使用 Index 进行 count 时的 stage 返回
    COUNT_SCAN：count 使用了 Index 进行 count 时的 stage 返回
    SUBPLA：未使用到索引的 $or 查询的 stage 返回
    TEXT：使用全文索引进行查询时候的 stage 返回
    PROJECTION：限定返回字段时候 stage 的返回
    对于普通查询，我希望看到 stage 的组合 (查询的时候尽可能用上索引)：
    Fetch+IDHACK
    Fetch+ixscan
    Limit+（Fetch+ixscan）
    PROJECTION+ixscan
    SHARDING_FITER+ixscan
    COUNT_SCAN

@todo::

    分片表，不分片的话，一个db使用一个shard，另一个db使用另一个shard?





