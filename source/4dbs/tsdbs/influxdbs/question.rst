常见问题 [1]_
################

partial write: points beyond retention policy dropped=1
----------------------------------------------------------------

如:
存储2天前的数据，存储策略存储1天

时区问题
--------

说明::

    influx的时间是utc时间,但查询要用当地时区

解决::

    // 增加选项: TZ('Asia/Beijing')
    如:
    influx -precision rfc3339 -execute="
      SELECT count(*) FROM "win_cpu"
      WHERE (time >= now() - 15d)
      GROUP BY IP,host TZ('Asia/Beijing')"  // 指定东八区
      -database=telegraf -format=csv





.. [1] https://docs.influxdata.com/influxdb/v1.7/troubleshooting/errors
