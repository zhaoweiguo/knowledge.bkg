索引
##########

查看索引
========

查看::

    db.octopus_gadget_info.getIndexes()

查看索引是否生效::

    db.index_test.find({"sex":1}).explain("executionStats")

    相关结果:
    示例1：查询字段不包含索引字段:
    winningPlan.stage=COLLSCAN是全表扫描

    示例2：查询字段同时包含索引字段和非索引字段
    虽然 winningPlan.stage=FETCH以及winningPlan.inputStage.stage =IXSCAN，
    但是其totalKeysExamined和totalDocsExamined都比nReturned大，说明在查询的时候进行了一些没有必要的扫描。

    示例3：查询字段同时只包含索引字段:
    可以看到返回中的
    winningPlan.stage=FETCH(根据索引去检索指定document )
    winningPlan.inputStage.stage =IXSCAN(索引扫描)
    executionStats.nReturned=totalKeysExamined=totalDocsExamined=9表示该查询使用的根据索引去查询指定文档
    (nReturned:查询返回的条目,totalKeysExamined:索引扫描条目,totalDocsExamined:文档扫描条目)

索引与排序的设置对查询性能的影响::

     db.index_test.find({"age":20}).sort({"sex":-1}).explain()
     1. 返回中的winningPlan.stage=SORT 即查询后需要在内存中排序再返回
     2. winningPlan.stage变为了FETCH(使用索引)



创建索引
========

.. note:: 从3.0版本后使用 db.collection.createIndex()代替db.collection.ensureIndex()

语法::

    db.collection.createIndex(keys, options)
    参数说明：
    1. keys: {字段名1：ascending,… 字段名n：ascending}: ascending 设为1 标识索引升序，-1降序
    2. options : 设置索引选项，如设置名称、设置成为唯一索引


::

    db.col.createIndex({"title":1})   // 1是升续 2是降续

    创建唯一索引:
    db.collection.ensureIndex({filed.subfield:1/-1}, {unique:true});

    // 创建多列索引:
    db.collection.ensureIndex({field1:1/-1, field2:1/-1});

    // {background: true}
    // Mongo提供两种建索引的方式foreground和background。
    // 前台操作，它会阻塞用户对数据的读写操作直到index构建完毕；
    // 后台模式，不阻塞数据读写操作，独立的后台线程异步构建索引，此时仍然允许对数据的读写操作
    db.col1.createIndex({name: 1},{unique:true, background: true})
    db.col2.createIndex({ appId: 1, version: 1 },{unique:true, background: true})


    // 创建子文档索引:
    db.collection.ensureIndex({filed.subfield:1/-1});


.. warning:: 创建索引时一定要写{background: true}


删除单个索引::

    db.collection.dropIndex({filed:1/-1});

    // 一下删除所有索引:
    db.collection.dropIndexes();

重建索引::

    一个表经过很多次修改后,导致表的文件产生空洞,索引文件也如此.
    可以通过索引的重建,减少索引文件碎片,并提高索引的效率.

    类似mysql中的optimize table
    db.collection.reIndex()



稀疏索引
========

创建稀疏索引::

    稀疏索引的特点: 如果针对field做索引,针对不含field列的文档,将不建立索引.

    与之相对,普通索引会把该文档的field列的值认为NULL,并建索引.

    适宜于: 小部分文档含有某列时.
    db.collection.ensureIndex({field:1/-1}, {sparse:true});

总结::

        在某一个被创建了稀疏索引字段上执行exists:false查询时，需要显示指定hint，其索引才会起作用；
        而执行 exists:true查询时，则不需要。

        在字段上创建普通索引 ，如果文档不含该字段则其索引值会被设为null，而稀疏索引会跳过该文档；
        这就是说使用该索引扫描集合时稀疏索引会比普通索引少。


哈希索引
========

* 创建哈希索引(2.4新增的)
* 哈希索引速度比普通索引快,但是,无法对范围查询进行优化.
* 适宜于---随机性强的散列

::

    db.collection.ensureIndex({file:’hashed’});

TTL索引
=======

和普通索引的创建方法一样，只是会多加一个expireAfterSeconds的属性::

    格式:
    db.collection.createIndex( {<普通索引>},{ expireAfterSeconds: time})

    实例:
    db.eventlog.createIndex( { "updateDate": 1 }, { expireAfterSeconds: 3600 } )

说明::

    当指定时间到了过期的阈值数据就会过期并删除；
    如果字段是数组，并且索引中有多个日期值，MongoDB使用数组中最低（即最早）的日期值来计算到期阈值；
    如果文档(document)中的索引字段不是日期或包含日期值的数组，则文档(document)将不会过期；
    如果文档(document)不包含索引字段，则文档(document)不会过期。

TTL索引特有限制::

    TTL索引是单字段索引。 复合索引不支持TTL并忽略expireAfterSeconds选项
    _id属性不支持TTL索引
    无法在上限集合上创建TTL索引，因为MongoDB无法从上限集合中删除文档
    不能使用createIndex()方法来更改现有索引的expireAfterSeconds值
        而是将collMod数据库命令与索引集合标志结合使用
        否则，要更改现有索引的选项的值，必须先删除索引并重新创建
    如果字段已存在非TTL单字段索引，则无法在同一字段上创建TTL索引，因为无法在相同key创建不同类型的的索引
        要将非TTL单字段索引更改为TTL索引，必须先删除索引并使用expireAfterSeconds选项重新创建

唯一索引
========

限制::

    如果集合已经包含超出索引的唯一约束的数据（即有重复数据），则MongoDB无法在指定的索引字段上创建唯一索引。
    不能在hash索引上创建唯一索引
    唯一约束适用于Collection中的一个Document。
        由于约束适用于单文档document，因此对于唯一的多键索引，
        只要该文档document的索引键值不与另一个文档document的索引键值重复，
        文档就可能具有导致重复索引键值的数组元素。 在这种情况下，重复索引记录仅插入索引一次。

分片Collection唯一索引只能如下::

    1. 分片键上的索引
    2. 分片键是前缀的复合索引
    3. 默认的_id索引; 
       但是，如果_id字段不是分片键或分片键的前缀，则_id索引仅对每个分片强制执行唯一性约束。
       如果_id字段不是分片键，也不是分片键的前缀，MongoDB希望应用程序在分片中强制执行_id值的唯一性。




说明
====

.. note:: mongo每次查询只会使用一次索引！！！只有$or或查询特殊，他会给每一个或分支使用索引然后再合并。 索引虽然也是持久化在磁盘中的，但为了确保索引的速度，实际上需要将索引加载到内存中使用
















