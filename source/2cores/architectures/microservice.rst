微服务架构
##############

优势::

  1.服务简单，只关注一个业务功能 
  2.每个微服务可由不同团队开发
  3.微服务是松散耦合的
  4.可用不同的编程语言与工具开发

挑战::

  1.运维开销 
  2.DevOps要求 
  3.隐式接口 
  4.重复劳动 
  5.分布式系统的复杂性 
  6.事务、异步、测试面临挑战


::

  微服务只是结果，而不是最终目的。微服务的目的是有效的拆分应用，实现敏捷开发和部署


Docker最大的特点就是轻量，启动速度快，扩张快，部署快，因此具体实现业务的服务，都应该放在Docker里面进行部署，但是一定要强调，并且一定要保证无状态化，这是快速扩张，自主更新的基础

* 无状态化包括::

    1.没有Session 
    2.磁盘中没有任何中间结果文件 
    3.内存中没有任何处理中间结果，状态

    比较现实的替代方案是Redis，NFS文件共享等等

要求::

  熟悉微服务理论,有过任意RPC框架使用经验,有gRPC,dubbo使用经验
  了解etcd,zookeeper的使用场景
  技术：『容器研究』Docker、kubernetes学习研究


可能由于Service Mesh的发展而被抛弃掉的技术栈:

.. figure:: /images/microservices/tech_stack_2018.png
   :width: 80%


参考
====


* https://www.cnblogs.com/zgynhqf/p/5679028.html?utm_source=tuicool&utm_medium=referral
* http://www.sohu.com/a/192082715_609513
* https://mp.weixin.qq.com/s?__biz=MzI4MTY5NTk4Ng==&mid=2247489318&amp;idx=1&amp;sn=8687a6ebe151991c2da0cf7326518351&source=41#wechat_redirect





