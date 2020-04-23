k3s
#######

* github [1]_
* k3s 是由 Rancher Labs 于2019年年初推出的一款轻量级 Kubernetes 发行版，满足在边缘计算环境中运行在 x86、ARM64 和 ARMv7 处理器上的小型、易于管理的 Kubernetes 集群日益增长的需求。
* k3s 除了在边缘计算领域的应用外，在研发侧的表现也十分出色。我们可以快速在本地拉起一个轻量级的 k8s 集群，而 k3d 则是 k3s 社区创建的一个小工具，可以在一个 docker 进程中运行整个 k3s 集群，相比直接使用 k3s 运行在本地，更好管理和部署。

安装
====

使用脚本安装::

    $ wget -q -O - https://raw.githubusercontent.com/rancher/k3d/master/install.sh | bash
    # 或
    $ curl -s https://raw.githubusercontent.com/rancher/k3d/master/install.sh | bash

    # 安装指定版本
    $ curl -s https://raw.githubusercontent.com/rancher/k3d/master/install.sh | TAG=v1.3.4 bash

使用 Homebrew 安装::

    $ brew install k3d

创建 k3s 集群
=============

创建 k3s 集群::

    $ k3d create -n k3s-local
    INFO[0000] Created cluster network with ID 4f966a0738b22f77eb0fa37d38d954541947fe2b0f8f0e1fdf731d4a78a55ab8
    INFO[0000] Created docker volume  k3d-k3s-local-images
    INFO[0000] Creating cluster [k3s-local]
    INFO[0000] Creating server using docker.io/rancher/k3s:v1.17.3-k3s1...
    INFO[0000] Pulling image docker.io/rancher/k3s:v1.17.3-k3s1...
    INFO[0017] SUCCESS: created cluster [k3s-local]
    INFO[0017] You can now use the cluster with:

    export KUBECONFIG="$(k3d get-kubeconfig --name='k3s-local')"
    kubectl cluster-info
    // 注意, 镜像拉取需要梯子

删除集群::

    $ k3d delete -n k3s-local
    INFO[0000] Removing cluster [k3s-local]
    INFO[0000] ...Removing server
    INFO[0000] ...Removing docker image volume
    INFO[0000] Removed cluster [k3s-local]

使用::

    $ export KUBECONFIG="$(k3d get-kubeconfig --name='k3s-local')"

    $ kubectl cluster-info
    Kubernetes master is running at https://localhost:6443
    CoreDNS is running at https://localhost:6443/api/v1/namespaces/kube-system/services/kube-dns:dns/proxy
    Metrics-server is running at https://localhost:6443/api/v1/namespaces/kube-system/services/https:metrics-server:/proxy

    $ kubectl get pod -n kube-system







.. [1] https://github.com/rancher/k3d