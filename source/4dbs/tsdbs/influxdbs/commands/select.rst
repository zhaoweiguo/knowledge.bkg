查询
####

语法::

    SELECT <field_key>[,<field_key>,<tag_key>] 
    FROM <measurement_name>[,<measurement_name>]




最简单的::

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

使用非默认RP::

    只要不是使用默认的RP我们就需要指定RP
    注:这儿measurement为downsampled_orders的rp名为rp_year
    > SELECT * FROM "rp_year"."downsampled_orders" LIMIT 5


查询中的基本计算::

    // SELECT语句支持使用基本的数学运算符，例如，+、-、/、*和()等等。
    SELECT field_key1 + field_key2 AS "field_key_sum" 
      FROM "measurement_name" WHERE time < now() - 15m
    SELECT (key1 + key2) - (key3 + key4) AS "some_calculation" 
      FROM "measurement_name" WHERE time < now() - 15m

GroupBy
=======

GroupBy指定时区::

    influx -precision rfc3339 -execute="
        SELECT count(*) FROM "win_cpu" 
        WHERE (time >= now() - 15d) 
        GROUP BY IP,host,customer TZ('Asia/Beijing')"  // 指定东八区
        -database=telegraf -format=csv

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

