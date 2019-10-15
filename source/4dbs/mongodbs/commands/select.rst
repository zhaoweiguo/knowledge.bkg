查询相关
#############



数据查询
-----------
::

    # 查出所有数据
    db.<tableName>.find().limit(30)
    # 等于
    db.<tableName>.find({"key" : <value>})
    # 不等于
    db.<tableName>.find({"key" :{$ne: <value>}})
    # 多条件and
    db.<tableName>.find({"key1" : <value1>, "key2" : <value2>})
    # 多条件or
    db.<tableName>.find({$or : [{"key1" : <value1>}, {"key2" : <value2>}]})

    # 查出一条数据
    db.<tableName>.findOne()
    # 查出满足条件的一条数据
    db.<tableName>.findOne({<key>, <value>})
    # Match an Embedded Document
    db.inventory.find( { size: { h: 14, w: 21, uom: "cm" } } )
    db.inventory.find( { "size.uom": "in" } )
    # 根据数组字段部分匹配
    # "red"是tags字段中的其中一个element
    db.inventory.find( { tags: "red" } )
    # 数组的完全匹配
    db.inventory.find( { tags: ["red", "blank"] } )



指定返回的键::

    # 只取出表中字段为<key1>和<key2>的值
    db.<tableName>.find({}, {<key1> : 1, <key2> : 1})
    # 取出除字段<key>之外的表的数据
    db.<tableName>.find({}, {<key> : 0})

查询条件( ``$lt``, ``$lte``, ``$gt``, ``$gte`` 的使用 )::

    db.<tableName>.find({<key> : {"$gte" : <value1>, "$lte" : <value2>} } )

``$or``, ``$in`` 进行OR查询::

    # $in
    db.<tableName>.find({<key> : {"$in" : [<value1>, <value2>]}})
    # $or
    db.<tableName>.find({"$or" : [{<key1>:<value1>}, {<key2>:<value2>}]})

``$not`` 是元条件句, 即可以用在任何其他条件之上

查询表数据条数::

    # 查询此表的数据条数
    db.<tableName>.count()
    # 查询此表按条件的数据条数
    db.<tableName>.find({<key> : <value>}).count()

limit, skip, sort::

    # 查询出限定条数的数据
    db.<tableName>.find({<key> : <value>}).limit(<count>)

    # 排序
    db.<tableName>.find().sort(<key>, -1)    # 降序
    db.<tableName>.find().sort(<key>, 1)     # 升序

    # 忽略前<count>个匹配的文档,如果匹配的小于<count>则不返回任何文档
    db.<tableName>.find().skip(<count>)


日期查询::

    // 大于指定时间
    db.getCollection('octopus_user_line').find({
        "time_created":{$gt:ISODate("2018-08-02T11:21:00.000Z")}
    }).sort({"time_created": 1}).limit(30)

    // 大于指定时间且指定用户
    db.getCollection('octopus_user_line').find({
        $and : [
            {"user_id":"8e96652473d485d7f6f28e37cebc2a89"}, {"time_created":{$gt:ISODate("2018-01-02")}}
        ]
    }).sort({"time_created": -1}).limit(300)

    db.getCollection('octopus_user_line').find({
        "time_created": {
            "$gte" : ISODate("2018-01-23"), "$lt" : ISODate("2018-01-24")
        }
    })

like模糊查询::

    mongoDB 支持正则表达式
    1. select * from users where name like "%hurry%";
    db.users.find({name:/hurry/}); 
    2. select * from users where name like "hurry%";
    db.users.find({name:/^hurry/}); 

$in, $and复杂查询::

    db.getCollection('octopus_gadget_info').find({
        $and : [
          {"time_created": {
              "$gte" : ISODate("2019-01-02"), "$lt" : ISODate("2019-07-03")
          }},
          {"gadget_type_id": {"$in" : [200001, 200007, 200020, 200022, 200024, 200026, 200027, 200028]} }
        ]
      }).count()









