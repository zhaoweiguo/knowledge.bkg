.. _redis_commands:

redis命令列表
====================

server::

    shutdown:从客户端同步的把redis中的数据存入到磁盘并关闭服务端
    save:手动的把redis中的数据同步到磁盘上
    monitor:实时监听所有服务端请求，可以用这个命令来查看redis有没有问题,它是一个调试时用到的命令，输出整个redis服务端接到的请求
    lastsave:得到最后一次成功将数据保存到磁盘的unix时间戳，单位是秒
    info:得到redis的一些基本的信息

        <1>used_memory:redis实际用到的内存
        <2>used_memory_rss:用top、ps看到redis所占内存。(这儿<1>与<2>的比例可以看成是“内存碎片比例”)
        <3>changes_since_last_save:上次存储到磁盘后修改的记录数(上次save或bgsave调用后，产生数据改变的操作数)
        <4>allocation_stats:展示了一定大小分配数据的直方图(最大256)[holds a histogram containing the number of allocations of a certain size (up to 256).]它提供了在redis运行时期测量分配类型的执行的工具。

    flushdb:清除当前数据库中所有的键
    flushall:清除所有数据库中所有的键
    debug segfault:让服务端崩溃，服务端在崩溃前会打印一些日志信息
    debug object "key":得到键"key"的调试信息
    dbsize:返回数据库中的键的数量
    config resetstat:重置被info命令返回的统计
    config set "param" "value":把一个配置参数赋值给一个给定的值
    config get "param":得到这个配置参数的值
    bgsave:异步存储数据到磁盘
    bgrewriteaof:异步重写只添加文件

lists::

    blpop "key" [key ...] timeout:移除并得到列表的第一个元素，或者阻塞直到其中一个空闲
    brpop "key" [key ...] timeout:同上，相当于阻塞的rpop
    brpoplpush "source" "destination" "...":取出数据,然后把数据压入到另一个列表
    lindex "key" "index":得到列表下第index的值
    linsert "key" BEFORE｜AFTER:在一个元素前面｜后面插入一个元素
    llen "key":得到列表的长度
    lpop "key":移除列表中的第一个元素，然后返回它的值
    lpush "key" "value":把值压入到列表中
    lpushx "key" "value":只有当列表存在时，才把值压入列表中
    lrange "key" "start" "stop":得到列表中从"start"到"stop"的值
    lrem "key" "count" "value":从列表中移除元素

        "count"为正数时，从头到尾查询移除"count"个等于"value"的值
        "count"为负数时，从尾到头查询移除|count|个等于"value"的值
        "count"为零时，移除列表中所有等于"value"的值

    lset "key" "index" "value":设定列表中第"index"的值为"value"
    ltrim "key" "start" "stop":取出列表中从start到stop的值
    rpop:同上
    rpoppush:同上
    rpush:同上
    rpushx:同上




