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

* 参考: https://github.com/influxdata/influxdb/issues/14137

GROUP BY(1w)按周查询问题
------------------------

* 默认是从周四开始(即周四为第1天)
* 如果想从周一开始则使用 ``GROUP BY time(7d, 4d)`` or ``GROUP BY time(1w, 4d)`` or ``GROUP BY time(1w, -3d)``
* 如果想从周三开始则使用 ``GROUP BY time(1w, 6d)`` or ``GROUP BY time(1w, -1d)``
* 本质就是从周四到周x有几天(为正), 周x到周四有几天(为负)

* 参考1: https://github.com/influxdata/influxdb/issues/9130
* 参考2: https://github.com/influxdata/influxdb/issues/7594
* https://docs.influxdata.com/influxdb/v1.0/query_language/data_exploration/#advanced-group-by-time-syntax

GROUP BY(1M)按月查询问题
------------------------

* 未解决: https://github.com/influxdata/influxdb/issues/3991


.. [1] https://docs.influxdata.com/influxdb/v1.7/troubleshooting/errors
