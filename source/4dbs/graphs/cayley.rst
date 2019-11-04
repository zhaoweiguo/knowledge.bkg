cayley
###########

* github [1]_
* 文档 [2]_

* Cayley在GitHub上放在Google名下，但它却不是Google官方项目，只是得到了Google的许可，由其员工创建并维护，类似的项目也有很多，比如Protocol Buffers、AngularJS。
* Cayley是受Freebase和Google的Knowledge Graph背后的图数据库graphd所启发，由Google工程师Barak Michener开发的一款开源图数据库。


运行::

    $ docker run -p 64210:64210 cayleygraph/cayley


3种query languages::

    Gizmo: query language inspired by Gremlin
    GraphQL-inspired query language
    MQL: simplified version for Freebase fans

Cayley数据库支持三元组文件导入，所谓三元组，指的是主语subject，谓语predicate 以及宾语object，每个三元组为一行
Cayley数据库支持的三元组文件以nq为后缀，每个三元组为一行，主语、谓语、宾语中间用空格分开，同时还需要注意一下事项

.. note:: note




实践
====

实战1-启动
----------

::

1. 新建网络::

    // 多个docker 使用同一网络便于通信
    $ docker network create network-mongo

2. 启动一个mongo::

    $ docker run --rm --network network-mongo --network-alias mongo -p 27017:27017 mongo:4.2.1

3. 启动cayley并指定后端存储为上面的mongo服务::

    $ docker run --rm --network network-mongo --network-alias network-mongo -p 64210:64210 \
          cayleygraph/cayley cayley init --db=mongo --dbpath="mongo:27017"
    // 执行成功后，会在mongo中增加一DB:cayley，里面有3个表
    log, nodes, quads


4. 使用浏览器打开: http://127.0.0.1:64210




实战2-简单的例子
----------------

.. literalinclude:: /files/dbs/graphs/cayleys/demo2.nq

Gizmo请求::

    g.V('<流浪地球>').Tag("source").Out().Tag("target").All();

.. image:: /images/dbs/graphs/cayleys/demo2.png


说明::

    // 若想实现查询结果的可视化，则需要使用Tag()函数
    [
      {
        "source": "node1",
        "target": "node2"
      },
      {
        "source": "node1",
        "target": "node3"
      },
    ]





.. [1] https://github.com/cayleygraph/cayley
.. [2] https://cayley.gitbook.io/cayley/