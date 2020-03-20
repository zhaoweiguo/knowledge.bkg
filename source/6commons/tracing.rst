Tracing相关
#################


.. toctree::
   :glob:
   :maxdepth: 1
   :name: 分布式的追踪系统

   tracings/opentracing
   tracings/opencensus
   tracings/opentelemetry
   tracings/jaeger
   tracings/zipkin
   tracings/dapper
   tracings/other




Logging，Metrics 和 Tracing 有各自专注的部分::

    Logging - 用于记录离散的事件
        例如, 应用程序的调试信息或错误信息,它是我们诊断问题的依据
    Metrics - 用于记录可聚合的数据
        例如, 
        队列的当前深度可被定义为一个度量值,在元素入队或出队时被更新
        HTTP 请求个数可被定义为一个计数器,新请求到来时进行累加
    Tracing - 用于记录请求范围内的信息
        例如, 一次远程方法调用的执行过程和耗时,它是我们排查系统性能问题的利器

这三者也有相互重叠的部分，如下图所示 [1]_ :

.. figure:: /images/cores/tracing_logging_metrics.png
    :width: 80%





.. [1] http://peter.bourgon.org/blog/2017/02/21/metrics-tracing-and-logging.html


 

