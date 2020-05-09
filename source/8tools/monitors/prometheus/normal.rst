常用
####

组件
====

Prometheus Server::

    主要负责数据采集和存储，提供PromQL查询语言的支持

Push Gateway::

    支持临时性Job主动推送指标的中间网关

DashBoard::

    使用rails开发的dashboard，用于可视化指标数据
    PushGateway支持Client主动推送metrics到PushGateway，而Prometheus只是定时去Gateway上抓取数据

AlertManager::

    警告管理器，用来进行报警
    独立于Prometheus的一个组件，可以支持Prometheus的查询语句，提供十分灵活的报警方式

Exporter::

    Exporter是Prometheus的一类数据采集组件的总称。它负责从目标处搜集数据，并将其转化为Prometheus支持的格式。
    与传统的数据采集组件不同的是，它并不向中央服务器发送数据，而是等待中央服务器主动前来抓取。

    支持其他数据源的指标导入到Prometheus，支持数据库、硬件、消息中间件、存储系统、http服务器、jmx等, 也可以自行开发

参考文档
========

* Prometheus 实战: https://songjiayang.gitbooks.io/prometheus/content/




