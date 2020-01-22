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


* https://app.yinxiang.com/fx/7583fd82-196f-4935-b625-5c5c0fa75c16
* https://app.yinxiang.com/fx/00df0370-4452-426f-9cf1-6724644b06b8
* https://app.yinxiang.com/fx/3f06d693-c5d9-4f68-be16-4d8a4938379e
* https://app.yinxiang.com/fx/ab629053-5fe4-41ed-9669-fe71f8bedab3




