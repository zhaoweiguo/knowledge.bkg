安装
####

使用docker快速启动::

    $ docker run -d --name jaeger \
      -e COLLECTOR_ZIPKIN_HTTP_PORT=9411 \
      -p 5775:5775/udp \
      -p 6831:6831/udp \
      -p 6832:6832/udp \
      -p 5778:5778 \
      -p 16686:16686 \
      -p 14268:14268 \
      -p 9411:9411 \
      jaegertracing/all-in-one:1.15

命令行启动::

    $ jaeger-all-in-one --collector.zipkin.http-port=9411

* Jaeger UI: http://localhost:16686

端口说明::

    Port  | Protocol | Component   |     Function
    5775  | UDP      |  agent      | accept zipkin.thrift over compact thrift protocol 
                     |             |     (deprecated, used by legacy clients only)
    6831  | UDP      |  agent      |   accept jaeger.thrift over compact thrift protocol
    6832  | UDP      |  agent      |   accept jaeger.thrift over binary thrift protocol
    5778  | HTTP     |  agent      |   serve configs
    16686 | HTTP     |  query      |   serve frontend
    14268 | HTTP     |  collector  |   accept jaeger.thrift directly from clients
    14250 | HTTP     |  collector  |   accept model.proto
    9411  | HTTP     |  collector  |   Zipkin compatible endpoint (optional)





