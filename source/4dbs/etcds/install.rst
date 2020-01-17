安装&使用
#########

下载安装 [2]_
=============

说明::

    以v3.3.18为例

Linux::

    ETCD_VER=v3.3.18

    # choose either URL
    GOOGLE_URL=https://storage.googleapis.com/etcd
    GITHUB_URL=https://github.com/etcd-io/etcd/releases/download
    DOWNLOAD_URL=${GOOGLE_URL}

    rm -f /tmp/etcd-${ETCD_VER}-linux-amd64.tar.gz
    rm -rf /tmp/etcd-download-test && mkdir -p /tmp/etcd-download-test

    curl -L ${DOWNLOAD_URL}/${ETCD_VER}/etcd-${ETCD_VER}-linux-amd64.tar.gz -o /tmp/etcd-${ETCD_VER}-linux-amd64.tar.gz
    tar xzvf /tmp/etcd-${ETCD_VER}-linux-amd64.tar.gz -C /tmp/etcd-download-test --strip-components=1
    rm -f /tmp/etcd-${ETCD_VER}-linux-amd64.tar.gz

    /tmp/etcd-download-test/etcd --version
    /tmp/etcd-download-test/etcdctl version

macOS (Darwin)::

    ETCD_VER=v3.3.18

    # choose either URL
    GOOGLE_URL=https://storage.googleapis.com/etcd
    GITHUB_URL=https://github.com/etcd-io/etcd/releases/download
    DOWNLOAD_URL=${GOOGLE_URL}

    rm -f /tmp/etcd-${ETCD_VER}-darwin-amd64.zip
    rm -rf /tmp/etcd-download-test && mkdir -p /tmp/etcd-download-test

    curl -L ${DOWNLOAD_URL}/${ETCD_VER}/etcd-${ETCD_VER}-darwin-amd64.zip -o /tmp/etcd-${ETCD_VER}-darwin-amd64.zip
    unzip /tmp/etcd-${ETCD_VER}-darwin-amd64.zip -d /tmp && rm -f /tmp/etcd-${ETCD_VER}-darwin-amd64.zip
    mv /tmp/etcd-${ETCD_VER}-darwin-amd64/* /tmp/etcd-download-test && rm -rf mv /tmp/etcd-${ETCD_VER}-darwin-amd64

    /tmp/etcd-download-test/etcd --version
    /tmp/etcd-download-test/etcdctl version


Docker::

    // etcd uses gcr.io/etcd-development/etcd as a primary container registry, 
    // and quay.io/coreos/etcd as secondary.

    rm -rf /tmp/etcd-data.tmp && mkdir -p /tmp/etcd-data.tmp && \
      docker rmi gcr.io/etcd-development/etcd:v3.3.18 || true && \
      docker run \
      -p 2379:2379 \
      -p 2380:2380 \
      --mount type=bind,source=/tmp/etcd-data.tmp,destination=/etcd-data \
      --name etcd-gcr-v3.3.18 \
      gcr.io/etcd-development/etcd:v3.3.18 \
      /usr/local/bin/etcd \
      --name s1 \
      --data-dir /etcd-data \
      --listen-client-urls http://0.0.0.0:2379 \
      --advertise-client-urls http://0.0.0.0:2379 \
      --listen-peer-urls http://0.0.0.0:2380 \
      --initial-advertise-peer-urls http://0.0.0.0:2380 \
      --initial-cluster s1=http://0.0.0.0:2380 \
      --initial-cluster-token tkn \
      --initial-cluster-state new \
      --log-level info \
      --logger zap \
      --log-outputs stderr

    docker exec etcd-gcr-v3.3.18 /bin/sh -c "/usr/local/bin/etcd --version"
    docker exec etcd-gcr-v3.3.18 /bin/sh -c "/usr/local/bin/etcdctl version"
    docker exec etcd-gcr-v3.3.18 /bin/sh -c "/usr/local/bin/etcdctl endpoint health"
    docker exec etcd-gcr-v3.3.18 /bin/sh -c "/usr/local/bin/etcdctl put foo bar"
    docker exec etcd-gcr-v3.3.18 /bin/sh -c "/usr/local/bin/etcdctl get foo"

简单使用::

    # start a local etcd server
    /tmp/etcd-download-test/etcd

    # write,read to etcd
    /tmp/etcd-download-test/etcdctl --endpoints=localhost:2379 put foo bar
    /tmp/etcd-download-test/etcdctl --endpoints=localhost:2379 get foo


集群安装 [1]_
=============

Set up a cluster(method 1)
--------------------------

On each etcd node, specify the cluster members::

    TOKEN=token-01
    CLUSTER_STATE=new
    NAME_1=machine-1
    NAME_2=machine-2
    NAME_3=machine-3
    HOST_1=10.240.0.17
    HOST_2=10.240.0.18
    HOST_3=10.240.0.19
    CLUSTER=${NAME_1}=http://${HOST_1}:2380,${NAME_2}=http://${HOST_2}:2380,${NAME_3}=http://${HOST_3}:2380

Run this on each machine::

    # For machine 1
    THIS_NAME=${NAME_1}
    THIS_IP=${HOST_1}

    # For machine 2
    THIS_NAME=${NAME_2}
    THIS_IP=${HOST_2}

    # For machine 3
    THIS_NAME=${NAME_3}
    THIS_IP=${HOST_3}

last run on each machine::

    etcd --data-dir=data.etcd --name ${THIS_NAME} \
      --initial-advertise-peer-urls http://${THIS_IP}:2380 --listen-peer-urls http://${THIS_IP}:2380 \
      --advertise-client-urls http://${THIS_IP}:2379 --listen-client-urls http://${THIS_IP}:2379 \
      --initial-cluster ${CLUSTER} \
      --initial-cluster-state ${CLUSTER_STATE} --initial-cluster-token ${TOKEN}


Set up a cluster(method 2)
--------------------------

use our public discovery service::

    $ curl https://discovery.etcd.io/new?size=3
    https://discovery.etcd.io/a81b5818e67a6ea83e9d4daea5ecbc92

    # grab this token
    TOKEN=token-01
    CLUSTER_STATE=new
    NAME_1=machine-1
    NAME_2=machine-2
    NAME_3=machine-3
    HOST_1=10.240.0.17
    HOST_2=10.240.0.18
    HOST_3=10.240.0.19
    DISCOVERY=https://discovery.etcd.io/a81b5818e67a6ea83e9d4daea5ecbc92

    # For machine 1
    THIS_NAME=${NAME_1}
    THIS_IP=${HOST_1}

    # For machine 2
    THIS_NAME=${NAME_2}
    THIS_IP=${HOST_2}

    # For machine 3
    THIS_NAME=${NAME_3}
    THIS_IP=${HOST_3}

last run on each machine::

    etcd --data-dir=data.etcd --name ${THIS_NAME} \
      --initial-advertise-peer-urls http://${THIS_IP}:2380 --listen-peer-urls http://${THIS_IP}:2380 \
      --advertise-client-urls http://${THIS_IP}:2379 --listen-client-urls http://${THIS_IP}:2379 \
      --discovery ${DISCOVERY} \
      --initial-cluster-state ${CLUSTER_STATE} --initial-cluster-token ${TOKEN}

启动::

    export ETCDCTL_API=3
    HOST_1=10.240.0.17
    HOST_2=10.240.0.18
    HOST_3=10.240.0.19
    ENDPOINTS=$HOST_1:2379,$HOST_2:2379,$HOST_3:2379

    etcdctl --endpoints=$ENDPOINTS member list


Access etcd
-----------

put command to write::

    $ etcdctl --endpoints=$ENDPOINTS put foo "Hello World!"

get to read from etcd::

    $ etcdctl --endpoints=$ENDPOINTS get foo
    $ etcdctl --endpoints=$ENDPOINTS --write-out="json" get foo

Get by prefix
-------------

::

    etcdctl --endpoints=$ENDPOINTS put web1 value1
    etcdctl --endpoints=$ENDPOINTS put web2 value2
    etcdctl --endpoints=$ENDPOINTS put web3 value3

    etcdctl --endpoints=$ENDPOINTS get web --prefix











.. [1] https://github.com/etcd-io/etcd/blob/master/Documentation/demo.md
.. [2] https://github.com/etcd-io/etcd/releases/tag/v3.3.18