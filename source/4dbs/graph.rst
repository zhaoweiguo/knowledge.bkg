图数据库
###########


.. toctree::
   :maxdepth: 1

   graphs/neo4j
   graphs/dgraph
   graphs/cayley

两个重要属性
============

1. 原生图存储::
   
    Neo4J就是属于原生图数据库，它使用的后端存储是专门为Neo4J这种图数据库定制和优化的
        理论上说能更有利于发挥图数据库的性能
    而JanusGraph不是原生图数据库，而将数据存储在其他系统上，比如Hbase

2. 图处理引擎::
   
    原生图处理（也称为无索引邻接）是处理图数据的最有效方法，因为连接的节点在数据库中物理地指向彼此
    非本机图处理使用其他方法来处理CRUD操作。

NoSQL数据库大致可以分为四类::

    键值(key/value)数据库
    列存储数据库
    文档型数据库
    图数据库



.. image:: /images/dbGraphs/nosql-databases-overview.png






