Kafka Broker 配置文件
########################
collect::

    broker.id: int类型
    log.dirs: 日志目录,默认:/tmp/kafka-logs 
    zookeeper.connect: 以格式->hostname1:port1,hostname2:port2/chroot/path
    port: 服务端口号,默认9092
    listeners: 监听列表,以「,」分隔,如:
        PLAINTEXT://myhost:9092,SSL://:9091 
        CLIENT://0.0.0.0:9092,REPLICATION://localhost:9093
    num.partitions: 每个topic默认log partitions数,默认值为1
    zookeeper.connection.timeout.ms: 默认为zookeeper.session.timeout.ms的值
    zookeeper.session.timeout.ms: 默认为6000

    num.network.threads: 服务用于接收请求和向网络发送请求的线程数,默认为3
    num.io.threads: 服务用于处理请求的线程数,包括disk io

    socket.send.buffer.bytes: socketServer SO_SNDBUF buffer,默认为:102400(-1:使用OS的值)
    socket.receive.buffer.bytes: SO_RCVBUF的值,默认为:102400
    socket.request.max.bytes: socket请求的最大bytes,默认为104857600

    cleanup.policy: [compact, delete],默认值为delete
    retention.bytes:
    retention.ms:
    delete.retention.ms:

    log.cleanup.policy: 保留窗口之外segments的清理机制

    log.retention.ms: 删除保留日志文件的毫秒数
    log.retention.minutes: 删除保留日志文件的分钟数
    log.retention.hours: 删除保留日志文件的小时数,默认168
    log.retention.bytes: 删除保留日志文件的最大size,默认为-1
    log.retention.check.interval.ms: 日志清理程序检查频率,默认为300000ms

    offsets.retention.check.interval.ms:
    offsets.retention.minutes:

    log.cleaner.delete.retention.ms:默认86400000ms

    delete.topic.enable: 如关闭,使用admin tool删除topic将不起作用

Updating Broker Configs::

  % 更改代理ID为0的当前代理配置(日志清理程序的线程数)
  > bin/kafka-configs.sh --bootstrap-server localhost:9092 --entity-type brokers --entity-name 0 --alter --add-config log.cleaner.threads=2
  % 查看 
  > bin/kafka-configs.sh --bootstrap-server localhost:9092 --entity-type brokers --entity-name 0 --describe

  % 删除
  > bin/kafka-configs.sh --bootstrap-server localhost:9092 --entity-type brokers --entity-name 0 --alter --delete-config log.cleaner.threads

  % 更新所有brokder的日志清理程序的线程数
  > bin/kafka-configs.sh --bootstrap-server localhost:9092 --entity-type brokers --entity-default --alter --add-config log.cleaner.threads=2
  % 查看
  > bin/kafka-configs.sh --bootstrap-server localhost:9092 --entity-type brokers --entity-default --describe

配置文件读取顺序::

  Dynamic per-broker config stored in ZooKeeper
  Dynamic cluster-wide default config stored in ZooKeeper
  Static broker config from server.properties
  Kafka default

Updating Password Configs Dynamically::

  // Updating Password Configs in ZooKeeper Before Starting Brokers
  > bin/kafka-configs.sh --zookeeper localhost:2181 --entity-type brokers --entity-name 0 --alter 
    --add-config 'listener.name.internal.ssl.key.password=key-password,password.encoder.secret=secret,password.encoder.iterations=8192'

Updating SSL Keystore of an Existing Listener::

  ssl.keystore.type
  ssl.keystore.location
  ssl.keystore.password
  ssl.key.password

Updating Log Cleaner Configs::

  log.cleaner.threads
  log.cleaner.io.max.bytes.per.second
  log.cleaner.dedupe.buffer.size
  log.cleaner.io.buffer.size
  log.cleaner.io.buffer.load.factor
  log.cleaner.backoff.ms

Updating Thread Configs::

  % 确保正常更新,范围限定在:currentSize / 2 to currentSize * 2
  num.network.threads
  num.io.threads
  num.replica.fetchers
  num.recovery.threads.per.data.dir
  log.cleaner.threads
  background.threads



  








