
实践
====

实战1-启动
----------

1. 新建网络::

    // 多个docker 使用同一网络便于通信
    $ docker network create net-mongo

2. 启动一个mongo::

    $ docker run --rm --network net-mongo --network-alias mongo -p 27017:27017 mongo:4.2.1

3. 启动cayley并指定后端存储为上面的mongo服务::

    $ docker run --rm --network net-mongo --network-alias cayley -p 64210:64210 \
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
   :width: 70%


说明::

    // 若想实现查询结果的可视化，则需要使用Tag()函数
    // 并形成返回值有source和target的json
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

