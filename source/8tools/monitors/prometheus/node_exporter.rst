node_exporter [1]_
##################


安装
====

linux版安装
-----------

基本::

    VERSION="0.18.1"   // 20200118最新版
    wget https://github.com/prometheus/node_exporter/releases/download/v$PROMETHEUS_VERSION/node_exporter-$VERSION.linux-amd64.tar.gz -O /tmp/node_exporter-$PROMETHEUS_VERSION.linux-amd64.tar.gz
    tar -xvzf /tmp/node_exporter-$PROMETHEUS_VERSION.linux-amd64.tar.gz --directory /tmp/ --strip-components=1
    
    $ /tmp/node_exporter --version







.. [1] https://github.com/prometheus/node_exporter