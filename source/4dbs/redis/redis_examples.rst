.. _redis_examples:

redis使用实例
==================
删除所有Key::

    //删除当前数据库中的所有Key
    flushdb
    //删除所有数据库中的key
    flushall


简单的赋值、取值set, get, getset::

    set server:name "fido"//设值
    get server:name => "fido"//取值
    getset server:name "change" => "fido"//先取值，再设值
    get server:name => "change"

自增，自减:incr, incrby, decr, decrby, del::

    set num 10
    incr num => 11//自增1
    incr num => 12
    incrby num 10 => 22//自增10
    decr num =>21
    decrby num 10 =>11
    del num//删除变量
    incr num => 1

有生命周期的变量::

    set source "redis"
    expire source 120//把变量source生命周期设为120秒
    ttl source => 119,118...//剩余生命时间

列表lpush, rpush, llen, lrange, lpop::

    rpush friends "simon"//右写列表
    lpush friends "bland"
    lpush friends "hopen"//左写列表
    lrange friends 0 -1 => ["hopen", "bland", "simon"]//取出从0到倒数第一位数据(-2:倒数据第二位)
    lrange friends 0 1 => ["hopen", "bland"]
    llen friends => 3//求列表长度
    lpop friends => "bland"//左取数据
    rpop friends => "simon"//右取数据

set集:sadd, srem, sismember, smembers, sunion::

    sadd sets "a"//增加
    sadd sets "b"
    sadd sets "c"
    srem sets "c"//移除
    sismember sets "a" => 1//查看有无些元素
    sismember sets "d" => 0
    smembers sets =>["a", "b"]//查看所有元素
    sadd anothers "a"//新增一个set
    sadd anothers "d"
    sunion sets anothers => ["a", "b","d"]//把两set合并

order set:zadd, zrange::

    zadd ordersets 1 "a" =>1//插入数据
    zadd ordersets 4 "d" =>1
    zadd ordersets 3 "c" =>1
    zadd ordersets 5 "e" =>1
    zrange ordersets 2 4 => ["d", "e"]//得到2-4的数据(从0开始)
    zrange ordersets 0 3 => ["a", "c", "d", "e"]//得到全部数据
    zadd order set 5 "e" => 0//插入重复数据失败
    zrange ordersets 0 4 => ["a", "c", "d", "e"]










