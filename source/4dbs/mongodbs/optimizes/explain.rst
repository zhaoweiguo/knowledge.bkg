explain命令
###############

* 命中索引并不一定会带来显著的性能提升，关键在于命中索引之后能否显著降低文档扫描数

原理
====



查询语句同时命中了两个索引：

strokes_1
strokes_1_pinyin_1
Mongo 会通过优化分析选择其中一种更好的方案放置到 winningPlan，最终的执行计划是 winningPlan 所描述的方式。其它稍次的方案则会被放置到 rejectedPlans 中，仅供参考


如果希望排除其它杂项的干扰，可以直接只返回 winningPlan 即可：
db.getCollection("word").find({ strokes: 5 }).explain().queryPlanner.winningPlan

winningPlan 中，总执行流程分为若干个 stage（阶段），一个 stage 的分析基础可以是其它 stage 的输出结果。从这个案例来说，首先是通过 IXSCAN（索引扫描）的方式获取到初步结果（索引得到的结果是所有符合查询条件的文档在磁盘中的位置信息），再通过 FETCH 的方式提取到各个位置所对应的完整文档。这是一种很常见的索引查询计划（explain 返回的是一个树形结构，实际先执行的是子 stage，再往上逐级执行父 stage）。





