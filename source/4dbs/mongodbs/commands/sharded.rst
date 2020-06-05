分片相关
########


查看集合是否分片
================

1. 去config库中查询::
   
    db.collections.find({$and:
        [
        {'dropped':{$ne:true}},  // 没有被删除的
         {'name':'/dbname/'}]  // 根据数据库名进行模糊查询
    })

2. 查看数据分布::

    use dbname
    db.colname.getShardDistribution() #可以查看数据分布

3. 最简单的方法::

    use databaseName;
    db.collectionName.stats().sharded #简单的返回true或者false




