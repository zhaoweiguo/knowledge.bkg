prometheus [1]_
###############

安装
====

linux版安装
-----------

基本::

    PROMETHEUS_VERSION="2.15.2"   // 20200118最新版
    wget https://github.com/prometheus/prometheus/releases/download/v$PROMETHEUS_VERSION/prometheus-$PROMETHEUS_VERSION.linux-amd64.tar.gz -O /tmp/prometheus-$PROMETHEUS_VERSION.linux-amd64.tar.gz
    tar -xvzf /tmp/prometheus-$PROMETHEUS_VERSION.linux-amd64.tar.gz --directory /tmp/ --strip-components=1
    /tmp/prometheus -version

配置::

    $ cat > /tmp/test-etcd.yaml <<EOF
    global:
      scrape_interval: 10s
    scrape_configs:
      - job_name: test-etcd
        static_configs:
        - targets: ['10.240.0.32:2379','10.240.0.33:2379','10.240.0.34:2379']
    EOF
    $ cat /tmp/test-etcd.yaml


Set up the Prometheus handler::

    nohup /tmp/prometheus \
        -config.file /tmp/test-etcd.yaml \
        -web.listen-address ":9090" \
        -storage.local.path "test-etcd.data" >> /tmp/test-etcd.log  2>&1 &

* Now Prometheus will scrape etcd metrics every 10 seconds.



Docker版安装
------------

::

    $ docker run \
      -p 9090:9090 \
      -v /tmp/prometheus.yml:/etc/prometheus/prometheus.yml \
      prom/prometheus








.. [1] https://github.com/prometheus/prometheus