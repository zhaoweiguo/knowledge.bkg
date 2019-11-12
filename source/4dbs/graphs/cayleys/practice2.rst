实战2-简单的例子
################

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



原始数据
--------

.. literalinclude:: /files/dbs/graphs/cayleys/demo3.nq

