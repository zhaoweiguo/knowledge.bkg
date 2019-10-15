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




