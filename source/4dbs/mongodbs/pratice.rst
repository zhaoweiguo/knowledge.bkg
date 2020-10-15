实战
####


命中索引并不一定会带来显著的性能提升，关键在于命中索引之后能否显著降低文档扫描数


查询语句同时命中了两个索引：

strokes_1
strokes_1_pinyin_1
Mongo 会通过优化分析选择其中一种更好的方案放置到 winningPlan，最终的执行计划是 winningPlan 所描述的方式。其它稍次的方案则会被放置到 rejectedPlans 中，仅供参考


如果希望排除其它杂项的干扰，可以直接只返回 winningPlan 即可：
db.getCollection("word").find({ strokes: 5 }).explain().queryPlanner.winningPlan

winningPlan 中，总执行流程分为若干个 stage（阶段），一个 stage 的分析基础可以是其它 stage 的输出结果。从这个案例来说，首先是通过 IXSCAN（索引扫描）的方式获取到初步结果（索引得到的结果是所有符合查询条件的文档在磁盘中的位置信息），再通过 FETCH 的方式提取到各个位置所对应的完整文档。这是一种很常见的索引查询计划（explain 返回的是一个树形结构，实际先执行的是子 stage，再往上逐级执行父 stage）。


非阻塞式创建索引查看执行进度
----------------------------

可以通过db.currentOp()查看进度::

    mongo> db.currentOp()
    { 
      "inprog" : [
        ns: "api.$cmd",
        opid: "d-2ze15bc9e0a5c484:53962865",
        ...
        command: {
          createIndexes: "order",   // 要创建索引的表名
          $db: "api"        // db
          indexes: [          // 要创建的索引
            {
                key: {
                    order_id: 1,
                    created_time: 1,
                },
                name: "order_id_1_created_time_-1",
                background: true
            }
          ],
        },
        // 这儿查看进度百分比 
        "msg" : "Index Build (background) Index Build (background): 439475/1000804 43%",
        "progress" : {
            "done" : 439476.0,      // 已经执行的次数
            "total" : 1000804.0     // 需要执行的总次数
        }
      ], 
      "ok" : 1.0
    }

取消执行错误的命令
------------------

1. 先通过 ``db.currentOp()`` 查出指定进程的opid::
   mongo> db.currentOp()
    { 
      "inprog" : [
        ns: "api.$cmd",
        opid: "d-2ze15bc9e0a5c484:53962865",
        ...
      ]
    }

2. 杀掉此进程::

    mongo> db.killOp(99080)
    @todo 待验证
    mongo> db.killOp("d-2ze15bc9e0a5c484:53962865")




该语句在 Mongo 中的执行分为三个步骤，总耗时是 3476ms：

在内存中扫描索引，得到所有笔画数为 6 的记录，耗时 42ms；
从磁盘中拉取上一个步骤中已经确定位置的文档，耗时 3461ms；
执行字段映射，得到 pinyin 和 _id 两个字段（_id 默认会返回）
db.getCollection("word").find({ strokes: 6 }, { pinyin: 1 }).explain("executionStats")
{ 
    "executionSuccess" : true, 
    "nReturned" : 61628.0, 
    "executionTimeMillis" : 3476.0, 
    "totalKeysExamined" : 61628.0, 
    "totalDocsExamined" : 61628.0, 
    "executionStages" : {
        "stage" : "PROJECTION", 
        "nReturned" : 61628.0, 
        "executionTimeMillisEstimate" : 3461.0, 
        "inputStage" : {
            "stage" : "FETCH", 
            "nReturned" : 61628.0, 
            "executionTimeMillisEstimate" : 3461.0, 
            "inputStage" : {
                "stage" : "IXSCAN", 
                "nReturned" : 61628.0, 
                "executionTimeMillisEstimate" : 42.0, 
                "keyPattern" : {
                    "strokes" : 1.0, 
                    "pinyin" : 1.0
                }, 
                "indexName" : "strokes_1_pinyin_1"
            }
        }
    }
}



$or 查询的优化
==============


当我们使用 $or 查询时，Mongo 的优化是有限的，常见的有下面两种：

1. 查询子句分离::

    db.getCollection("word").find({$or: [{ strokes: 13 }, { pinyin: 'á' }]}, { _id: 0, pinyin: 1 }).explain("executionStats").executionStats
    { 
        "executionSuccess" : true, 
        "nReturned" : 71052.0, 
        "executionTimeMillis" : 100.0, 
        "totalKeysExamined" : 71114.0, 
        "totalDocsExamined" : 0.0, 
        "executionStages" : {
            "stage" : "SUBPLAN", 
            "nReturned" : 71052.0, 
            "executionTimeMillisEstimate" : 68.0, 
            "inputStage" : {
                "stage" : "PROJECTION", 
                "nReturned" : 71052.0, 
                "executionTimeMillisEstimate" : 68.0, 
                "inputStage" : {
                    "stage" : "OR", 
                    "nReturned" : 71052.0, 
                    "executionTimeMillisEstimate" : 32.0, 
                    "dupsTested" : 71114.0, 
                    "dupsDropped" : 62.0, 
                    "inputStages" : [
                        {
                            "stage" : "IXSCAN", 
                            "nReturned" : 62.0, 
                            "executionTimeMillisEstimate" : 0.0, 
                            "keyPattern" : {
                                "pinyin" : 1.0, 
                                "strokes" : 1.0
                            }, 
                            "indexName" : "pinyin_1_strokes_1",
                        }, 
                        {
                            "stage" : "IXSCAN", 
                            "nReturned" : 71052.0, 
                            "executionTimeMillisEstimate" : 0.0, 
                            "keyPattern" : {
                                "strokes" : 1.0, 
                                "pinyin" : 1.0
                            }, 
                            "indexName" : "strokes_1_pinyin_1"
                        }
                    ]
                }
            }
        }
    }

这条 OR 查询被 Mongo 分离为两条独立的查询子句，并分别命中 pinyin_1_strokes_1 和 strokes_1_pinyin_1 两个索引，两个查询的结果由 STAGE_OR 进行合并去重（结果集较大时也是一笔不小的消耗），dupsDropped 表示的是结果集的重合条数。
但要注意的是，除非所有 OR 查询子句都可以命中索引，否则 Mongo 只会执行全文档扫描。


2. 查询子句合并::
   
    db.getCollection("word").find({$or: [{ strokes: 13 }, { strokes: 12 }]}, { _id: 0, pinyin: 1 }).explain("executionStats").executionStats
    { 
        "executionSuccess" : true, 
        "nReturned" : 178560.0, 
        "executionTimeMillis" : 233.0, 
        "totalKeysExamined" : 178561.0, 
        "totalDocsExamined" : 0.0, 
        "executionStages" : {
            "stage" : "SUBPLAN", 
            "nReturned" : 178560.0, 
            "executionTimeMillisEstimate" : 205.0, 
            "inputStage" : {
                "stage" : "PROJECTION", 
                "nReturned" : 178560.0, 
                "executionTimeMillisEstimate" : 205.0, 
                "inputStage" : {
                    "stage" : "IXSCAN", 
                    "nReturned" : 178560.0, 
                    "executionTimeMillisEstimate" : 135.0, 
                    "keyPattern" : {
                        "strokes" : 1.0, 
                        "pinyin" : 1.0
                    }, 
                    "indexName" : "strokes_1_pinyin_1", 
                    "indexBounds" : {
                        "strokes" : [
                            "[12.0, 12.0]", 
                            "[13.0, 13.0]"
                        ], 
                        "pinyin" : [
                            "[MinKey, MaxKey]"
                        ]
                    }
                }
            }
        }
    }

这种情况基本等同于使用 $in 来查询，仅限于查询子句本身可以命中索引的情况下才会出现该优化。
除了这两种简单的优化之外，$or 在组合索引的使用上有一些需要注意的地方。

1. $or 子句全部命中索引::
   
    db.collection.find({ 
        $or: [{
            province: "广东省"
        }, {
            province: "福建省"
        }],
        city: "深圳市",
        district: "南山区",
        subDistrict: "粤海街道" 
    })

理想来说，这应该是可以全匹配命中 province_1_city_1_district 这个索引的，但由于引入了 $or，会导致只能命中 province（查询子句分离优化），也即范围还是在省，剩下的三个条件则作为 fetch 阶段的匹配依据使用。

正确的方式应该是改为 $in::

    db.collection.find({ 
        province: {
            $in: ["广东省", "福建省"]
        },
        city: "深圳市",
        district: "南山区",
        subDistrict: "粤海街道" 
    })

2. $or 子句没有全部命中索引::

    db.collection.find({ 
        province: "广东省",
        $or: [{
            city: "深圳市"
        }, {
            city: "广州市"
        }],
        district: "南山区",
        subDistrict: "粤海街道" 
    })


数据分批处理
============

获取下面的 100 条数据实际上需要扫描 100 万 + 100 次::

    db.getCollection("word").find().sort({ _id: 1 }).skip(1000000).limit(100)

利用 id 可以得到有效的改善，大概流程是，第一次获取到的结果集中，提取最后一条记录的 _id 字段，作为下一次查询的条件::

    // 首次正常查询，但使_id有序
    db.getCollection("word").find().sort({ _id: 1 }).limit(100)
    // 下一页用 _id 过滤掉前面的结果，命中 _id 索引，结果已经有序，所以 sort 实际上也可以不需要
    db.getCollection("word").find({ _id: { $gt: lastId } }).sort({ _id: 1 }).limit(100)

在没有任何查询条件时，性能达到最高，文档扫描数等于 limit，当有查询条件时，文档扫描数则取决于什么时候凑够 limit 条数据。
尽管理论上可行，但这仅限于连续的分页请求，如果需要随机获取某一页的数据就不太可行了，因为获取不到该页之前的最后一个 _id。









参考
====

* Mongo 性能调优: https://zhuanlan.zhihu.com/p/68106413

