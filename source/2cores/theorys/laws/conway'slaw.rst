康威定律(Conway's Law)
######################


在 **划分系统** 时，应该多考虑 康威定律::

    系统架构是公司组织架构的反映
    应该按照业务闭环进行系统拆分／组织架构划分，实现闭环／高内聚／低耦合，减少沟通成本
    如果沟通出现问题，那么应该考虑进行系统和组织架构的调整
    在合适时机进行系统拆分，不要一开始就把系统／服务拆的非常细，虽然闭环，但是每个人维护的系统多，维护成本高


.. note:: 定义: Organizations which design systems are constrained to produce designs which are copies of the communication structures of these organizations. - Melvin Conway(1967) 
    设计系统的组织，其产生的设计等同于组织之内、组织之间的沟通结构 


* 康威定律被视为微服务架构的理论基础

康威4大定律
===========

Law 1::

    Communication dictates design
    o> The mode of organizational communication is expressed through system design

Law 2::

    There is never enough time to do something right, but there is always enough time to do it over
    o> A task can never be done perfectly, even with unlimited time, but there is always time to complete a task

Law 3::

    There is a homomorphism from the linear graph of a system to the linear graph of its design organization
    o> Homomorphism exists between linear systems and linear organizational structures

Law 4::

    The structures of large systems tend to disintegrate during development, qualitatively more so than small systems
    o> A large system organization is easier to decompose than a smaller one




参考
====

1. `【wikipedia】Conway's law <https://en.wikipedia.org/wiki/Conway's_law>`_
2. `【论文】Conway's Law <https://app.yinxiang.com/fx/1d4a3db5-5221-46bf-9fbf-8e2d8805b2c8>`_
3. `【云栖芷沁】Conway's Law – A Theoretical Basis for the Microservice Architecture <https://app.yinxiang.com/fx/5bfa6baa-8383-4aa6-881e-4564900014f4>`_
4. `【ppt】Conway's Law at a Distance <https://app.yinxiang.com/fx/b6ed51d1-0280-4005-b75c-953003537d98>`_
  
说明::

    1. 康威定律的wiki定义
    2. 康威定律出现的论文
    3. 云栖芷沁对4中ppt内容的介绍并在最后论证了与「微服务」的相似点
    4. Mike Amundsen(Author of 「Design RESTful API」)讲解的ppt，并总结出康威4大定律

