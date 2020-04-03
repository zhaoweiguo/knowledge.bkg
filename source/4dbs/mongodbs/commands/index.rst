索引
##########

查看::

    db.octopus_gadget_info.getIndexes()

创建索引::

    db.col.createIndex({"title":1})   // 1是升续 2是降续

创建多列索引::

    db.collection.ensureIndex({field1:1/-1, field2:1/-1});

创建子文档索引::

    db.collection.ensureIndex({filed.subfield:1/-1});

创建唯一索引::

    db.collection.ensureIndex({filed.subfield:1/-1}, {unique:true});

删除单个索引::

    db.collection.dropIndex({filed:1/-1});

一下删除所有索引::

    db.collection.dropIndexes();

重建索引::

    一个表经过很多次修改后,导致表的文件产生空洞,索引文件也如此.
    可以通过索引的重建,减少索引文件碎片,并提高索引的效率.

    类似mysql中的optimize table
    db.collection.reIndex()



稀疏索引
========

创建稀疏索引::

    稀疏索引的特点: 如果针对field做索引,针对不含field列的文档,将不建立索引.

    与之相对,普通索引会把该文档的field列的值认为NULL,并建索引.

    适宜于: 小部分文档含有某列时.
    db.collection.ensureIndex({field:1/-1},{sparse:true});

哈希索引
========

* 创建哈希索引(2.4新增的)
* 哈希索引速度比普通索引快,但是,无法对范围查询进行优化.
* 适宜于---随机性强的散列

::

    db.collection.ensureIndex({file:’hashed’});

















