并发相关
############


分布式系统理论基础 - CAP [1]_
=============================

CAP由Eric Brewer在2000年PODC会议上提出[1][2]，是Eric Brewer在Inktomi[3]期间研发搜索引擎、分布式web缓存时得出的关于数据一致性(consistency)、服务可用性(availability)、分区容错性(partition-tolerance)的猜想：

It is impossible for a web service to provide the three following guarantees : Consistency, Availability and Partition-tolerance.

* 数据一致性(consistency)：如果系统对一个写操作返回成功，那么之后的读请求都必须读到这个新数据；如果返回失败，那么所有读操作都不能读到这个数据，对调用者而言数据具有强一致性(strong consistency) (又叫原子性 atomic、线性一致性 linearizable consistency)[5]
* 服务可用性(availability)：所有读写请求在一定时间内得到响应，可终止、不会一直等待
* 分区容错性(partition-tolerance)：在网络分区的情况下，被分隔的节点仍能正常对外服务


* 在某时刻如果满足AP，分隔的节点同时对外服务但不能相互通信，将导致状态不一致，即不能满足C
* 如果满足CP，网络分区的情况下为达成C，请求只能一直等待，即不满足A；
* 如果要满足CA，在一定时间内要达到节点状态一致，要求不能出现网络分区，则不能满足P。


* 序列一致性(sequential consistency)[13]：不要求时序一致，A操作先于B操作，在B操作后如果所有调用端读操作得到A操作的结果，满足序列一致性
* 最终一致性(eventual consistency)[14]：放宽对时间的要求，在被调完成操作响应后的某个时间点，被调多个节点的数据最终达成一致


PACELC
------
CAP理论的修改版本

例如延时(latency)，它是衡量系统可用性、与用户体验直接相关的一项重要指标[16]。CAP理论中的可用性要求操作能终止、不无休止地进行，除此之外，我们还关心到底需要多长时间能结束操作，这就是延时，它值得我们设计、实现分布式系统时单列出来考虑。

延时与数据一致性也是一对“冤家”，如果要达到强一致性、多个副本数据一致，必然增加延时。加上延时的考量，我们得到一个CAP理论的修改版本PACELC[17]：如果出现P(网络分区)，如何在A(服务可用性)、C(数据一致性)之间选择；否则，如何在L(延时)、C(数据一致性)之间选择






.. [1] https://www.bbsmax.com/A/mo5k2qk4Jw/