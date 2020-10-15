常用命令
========

查看当前数据库的可用连接数::

    > db.serverStatus().connections
    { 
        "current" : 6.0, 
        "available" : 3885.0, 
        "totalCreated" : 9.0
    }

开启慢日志::

    db.setProfilingLevel(<level>, <slowtime_ms>)

    参数说明:
    1. level:
      // 支持三个级别:
      0:默认，不开启命令记录
      1:记录慢日志，默认记录执行时间大于 100ms 的命令
      2:记录所有命令
    2. slowtime_ms:
      指定超过多少 ms 被认为是慢命令


直接获取当前数据库正在执行中的命令::

    db.currentOp()


停止指定进程的操作::

    db.killOp(99080)

获取某一个集合总的索引大小(bytes)::

    db.collection.totalIndexSize()

查看占存储量
============

数据库查询::

    > db.stats();
    {
      "db" : "test",        // 当前数据库
      "collections" : 3,      // 当前数据库多少表
      "objects" : 4,        // 当前数据库所有表多少条数据
      "avgObjSize" : 51,      // 每条数据的平均大小
      "dataSize" : 204,      // 所有数据的总大小
      "storageSize" : 16384,    // 所有数据占的磁盘大小
      "numExtents" : 3,
      "indexes" : 1,        // 索引数
      "indexSize" : 8176,     // 索引大小
      "fileSize" : 201326592,   // 预分配给数据库的文件大小
      "nsSizeMB" : 16,
      "dataFileVersion" : {
        "major" : 4,
        "minor" : 5
      },
      "ok" : 1
    }

表查询::

    > db.posts.stats();
    {
      "ns" : "test.posts",
      "count" : 1,
      "size" : 56,
      "avgObjSize" : 56,
      "storageSize" : 8192,
      "numExtents" : 1,
      "nindexes" : 1,
      "lastExtentSize" : 8192,
      "paddingFactor" : 1,
      "systemFlags" : 1,
      "userFlags" : 0,
      "totalIndexSize" : 8176,
      "indexSizes" : {
        "_id_" : 8176
      },
      "ok" : 1
    }

以 KB 为单位显示::

    // 默认单位是 bytes，可改成KB
    >  db.posts.stats(1024);

仅查看集合占用空间大小::

    > db.posts.dataSize();



other
=====

db.system.profile.find({millis:{$gt:5000}})

