常见问题
###########

Broker may not be available
-------------------------------
现象::

    $>  ./kafka-console-producer.sh --broker-list localhost:9092 --topic test

    [2018-03-08 13:59:36,276] WARN [Producer clientId=console-producer] Connection to node -1 could not be established. Broker may not be available. (org.apache.kafka.clients.NetworkClient)
    [2018-03-08 14:01:43,637] WARN [Producer clientId=console-producer] Connection to node -1 could not be established. Broker may not be available. (org.apache.kafka.clients.NetworkClient)
    [2018-03-08 14:03:51,125] WARN [Producer clientId=console-producer] Connection to node -1 could not be established. Broker may not be available. (org.apache.kafka.clients.NetworkClient)

原因::

    endpoints:["PLAINTEXT://172.28.50.143:9092"] 

解决::

    将localhost:9092改为PLAINTEXT://172.28.50.143:9092
    $> ./kafka-console-consumer.sh --bootstrap-server PLAINTEXT://172.28.50.143:9092 --topic test

panic: kafka: client has run out of available brokers
-----------------------------------------------------

* 现象::

    panic: kafka: client has run out of available brokers to talk to 
    (Is your cluster reachable?)

* 过程::
  
    最近用golang写的一个项目用到kafka,在本地测试好好的,一到线上就有问题
    最后一点点调试找到原因,连接kafka server是成功的,但收到返回值是"EOF",最后找到原因

* 原因::

    由于kafka的版本不一致导致的

* 说明::

    kafka_2.10-0.8.2-beta.jar
    其中:
      2.10是Scala版本
      0.8.2-beta是Kafka版本







