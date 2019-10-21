协议-CLI
################

技巧
-------
::

    1.直接执行 influx -precision rfc3339
    2.或者登录到influx cli之后
        precision rfc3339

登录
--------
::

    $> influx -ssl -username <账号名称> -password <密码> -host <网络地址> -port 3242 
      -import -path=path/to/apple_stand.txt -database=apple_stand

    > create user gordon with password '1QAZ2wsx'
    > CREATE USER root WITH PASSWORD 'wisedu123' WITH ALL PRIVILEGES

    grant all privileges to gordon
    create database testdb

    ./influx -host <host> -port 3242 -ssl -username gordon -password <pwd>


插入
----------
::

    INSERT weather,location=us-midwest temperature=82 1465839830100400200


查询
---------

最简单的::

    1. # 显示时间线
    show series 
    2. # 显示度量
    show measurements
    3. # 显示Tag的Key
    show tag keys
    4. # 显示数据字段的Key
    show field keys


    1. select * from metrics
    2. show tag keys from metrics
    3. show field keys from metrics

    # 查看自定度量的数据, 里面的相关字段，官方建议使用“双引号”标注出来
    select * from "CPU" order by time desc

    # 查看指定的Field和Tag
    select "load1","role" from "CPU" order by time desc

    # 只查看Field
    select *::field from "CPU" 

    # 执行基本的运算
    select ("load1" * 2) + 0.5 from "CPU"

    # 查询指定Tag的数据，注意，Where子句的字符串值要使用“单引号”，字符串值
    # 如果没有使用引号或者使用了双引号，都不会有任何值的返回
    select * from "CPU" where role = 'FrontServer'

    # 查询Field中，load1 > 20 的所有数据
    select * from "CPU" where "load1" > 20

查询中的基本计算::

    // SELECT语句支持使用基本的数学运算符，例如，+、-、/、*和()等等。
    SELECT field_key1 + field_key2 AS "field_key_sum" 
      FROM "measurement_name" WHERE time < now() - 15m
    SELECT (key1 + key2) - (key3 + key4) AS "some_calculation" 
      FROM "measurement_name" WHERE time < now() - 15m

使用Group计算百分比::

    SELECT (sum(field_key1) / sum(field_key2)) * 100 AS "calculated_percentage" 
      FROM "measurement_name" WHERE time < now() - 15m GROUP BY time(1m)
    SELECT count(value) FROM devices where time > '2019-08-29T00:00:00Z' 
        group by gadget_type_id, time(1d)

时间相关查询::

    > SELECT count(value) FROM devices where time > '2019-08-26T00:00:00Z' group by time(1d)
    > SELECT count(value) FROM devices where time > now() - 10w group by time(1w)

其他::

    SELECT * from (_INNER_QUERY_HERE_) 
    WHERE count_linux = -1 AND count_linux64 = -1 AND count_mac = -1 
        AND count_win = -1 AND count_win64 = -1;

    SELECT * from (_INNER_QUERY_HERE_) 
    WHERE count_linux = -1 OR count_linux64 = -1 OR count_mac = -1 
        OR count_win = -1 OR count_win64 = -1;




策略
--------

查询策略::

    >show RETENTION POLICIES ON <DB>
    name    duration   shardGroupDuration replicaN default
    ----    --------   ------------------ -------- -------
    autogen 33600h0m0s 168h0m0s           1        true

    说明:
    name:       名称
    duration:   数据保存时间，0代表无限制
    shardGroupDuration:     shardGroup的存储时间
    replicaN:   副本个数(REPLICATION)
    default:    是否是默认策略

    注:
    创建数据库时会自动创建一个默认存储策略:
        永久保存数据，对应的在此存储策略下的 shard 所保存的数据的时间段为 7 天
    如果创建一个新的 retention policy 设置数据的保留时间为 1 天，则
        单个 shard 所存储数据的时间间隔为 1 小时，超过1个小时的数据会被存放到下一个shard

    Retention Policy’s DURATION         Shard Group Duration
        < 2 days                                1 hour
        >= 2 days and <= 6 months               1 day
        > 6 months                              7 days

创建策略::

    CREATE RETENTION POLICY <retention_policy_name> ON <database_name> 
        DURATION <duration> REPLICATION <n> [SHARD DURATION <duration>] [DEFAULT]

    示例1：为数据库mydb创建一个策略
    CREATE RETENTION POLICY "one_day_only" ON "mydb" DURATION 1d REPLICATION 1

    示例2：为数据库mydb创建一个默认策略。
    CREATE RETENTION POLICY "one_day_only" ON "mydb" 
        DURATION 23h60m REPLICATION 1 DEFAULT

修改策略::

    ALTER RETENTION POLICY <retention_policy_name> ON <database_name> 
        DURATION <duration> REPLICATION <n> SHARD DURATION <duration> DEFAULT


删除策略::

    DROP RETENTION POLICY <retention_policy_name> ON <database_name>










