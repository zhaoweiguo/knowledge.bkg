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

数组查询
========

::

    // 查询字段是数组
    db.time_info.find({"begin_time":{$size:1}})
    // 方法2
    db.time_info.find({ "begin_time.0": {$exists:1} })

    // 数组大小是某个范围(要求数组大小小于3)
    db.time_info.find({ $where: "this.begin_time.length < 3" })
    //数组大小小于1，就意味着num[0]不存在
    db.time_info.find({ "begin_time.0": {$exists:0} })



日期查询
========

::

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
            "$gte" : ISODate("2018-01-23T00:00:00Z"), 
            "$lt" : ISODate("2018-01-24T00:00:00Z")
        }
    })


正则查询
========

regex操作符的介绍::

    MongoDB使用$regex操作符来设置匹配字符串的正则表达式，使用PCRE(Pert Compatible Regular Expression)作为正则表达式语言

regex操作符::

    {<field>:{$regex:/pattern/，$options:’<options>’}}
    {<field>:{$regex:’pattern’，$options:’<options>’}}
    {<field>:{$regex:/pattern/<options>}}

正则表达式对象::

    {<field>: /pattern/<options>}

$regex与正则表达式对象的区别::

    在$in操作符中只能使用正则表达式对象，例如:{name:{$in:[/^joe/i,/^jack/}}
    在使用隐式的$and操作符中，只能使用$regex，例如:{name:{$regex:/^jo/i, $nin:['john']}}
    当option选项中包含X或S选项时，只能使用$regex，例如:{name:{$regex:/m.*line/,$options:"si"}}


$regex操作符中的option选项可以改变正则匹配的默认行为，它包括i, m, x以及S四个选项，其含义如下::

    1. i 忽略大小写，{<field>{$regex/pattern/i}}
       设置i选项后，模式中的字母会进行大小写不敏感匹配。
    2. m 多行匹配模式，{<field>{$regex/pattern/,$options:'m'}
       m选项会更改^和$元字符的默认行为，分别使用与行的开头和结尾匹配，而不是与输入字符串的开头和结尾匹配
    3. x 忽略非转义的空白字符，{<field>:{$regex:/pattern/,$options:'m'}
       设置x选项后，正则表达式中的非转义的空白字符将被忽略，同时井号(#)被解释为注释的开头注，只能显式位于option选项中
    4. s 单行匹配模式{<field>:{$regex:/pattern/,$options:'s'}
       设置s选项后，会改变模式中的点号(.)元字符的默认行为，它会匹配所有字符，包括换行符(\n)，只能显式位于option选项中

使用$regex操作符时，需要注意下面几个问题::

    1. i，m，x，s可以组合使用，例如:{name:{$regex:/j*k/,$options:"si"}}
    2. 在设置索引的字段上进行正则匹配可以提高查询速度，而且当正则表达式使用的是前缀表达式时，查询速度会进一步提高
       例如:{name:{$regex: /^joe/}


查找包含 runoob 字符串的文章::

    >db.posts.find({post_text:{$regex:"runoob"}})
    or
    >db.posts.find({post_text:/runoob/})

如果检索需要不区分大小写，我们可以设置 $options 为 $i::

    >db.posts.find({post_text:{$regex:"runoob", $options:"$i"}})

数组元素使用正则表达式::

    // 查找包含以 run 开头的标签数据
    >db.posts.find({tags:{$regex:"run"}})

模糊查询包含title关键词, 且不区分大小写::

    >db.posts.find({title:eval("/"+title+"/i")})    // 等同于 title:{$regex:title,$Option:"$i"}   


groupby
=======

::


    以用户表(users, {_id, uid, groupid, create_time})为例
    db.users.aggregate ([{"$group": {"_id": "$groupid", count: {"$sum":1}}}])
    但这样只能显示部分数据，想要显示全部数据可以把结果导出到一个临时表里
    
    导出数据到临时表 （将查询结果导出到user_tmp表中）
    db.users.aggregate ([{"$group": {"_id": "$uid", count: {"$sum":1}}}, {"$out": "user_tmp"}])

    这样你就可以随时调用了:
    1. 查询groupid为110的个数
    db.user_tmp.find({"_id":"110"})
    { "_id" : "110", "count" : 163 }
    2. 随便查3条
    db.user_tmp.find({}).limit(3)
    { "_id" : "110", "count" : 163 }
    { "_id" : "111", "count" : 63 }
    { "_id" : "112", "count" : 13 }

    最后用完了，记得删除临时表
    db.user_tmp.drop()


其他
====

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

