.. _mongodb_simple:

MongoDB簡单用法
#######################


.. toctree::
   :maxdepth: 1

   commands/server
   commands/db
   commands/table
   commands/index
   commands/select
   commands/insert
   commands/update
   commands/array
   commands/sharded


其他
------------

View的使用（只读）::

    // 创建view
    db.runCommand( { create: <view>, viewOn: <source>, pipeline: <pipeline> } )
    db.runCommand( { create: <view>, viewOn: <source>, pipeline: <pipeline>, collation: <collation> } )
    mongo> db.createView(<view>, <source>, <pipeline>, <collation> )

    // 删除view
    db.collection.drop()

    //The following read operations can support views:
    db.collection.find()
    db.collection.findOne()
    db.collection.aggregate()
    db.collection.count()
    db.collection.distinct()





