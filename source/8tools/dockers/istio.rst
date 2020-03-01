Istio
#####

::

    希腊语言中大概是风帆的意思
    发音: [iːst'iəʊ]
    Its requirements can include discovery, load balancing, failure recovery, metrics, and monitoring. A service mesh also often has more complex operational requirements, like A/B testing, canary rollouts, rate limiting, access control, and end-to-end authentication.

* 官网 [1]_
* 文档 [2]_

下载安装
========

安装istioctl::

    1. 方法1:
    $ curl -L https://istio.io/downloadIstio | sh -
    Istio 1.4.3 Download Complete!

    Istio has been successfully downloaded into the istio-1.4.3 folder on your system.

    Next Steps:
    See https://istio.io/docs/setup/kubernetes/install/ to add Istio to your Kubernetes cluster.

    Begin the Istio pre-installation verification check by running:
       istioctl verify-install

    Need more information? Visit https://istio.io/docs/setup/kubernetes/install/

    2. 方法2:
    对mac来说本质是执行下面命令并解压
    $ wget https://github.com/istio/istio/releases/download/1.4.3/istio-1.4.3-osx.tar.gz
    $ tar zxvf istio-1.4.3-osx.tar.gz && rm istio-1.4.3-osx.tar.gz

    注: 下载实在太慢, 可以来这儿找
    链接: https://pan.baidu.com/s/1M0XLWNCRSe2dBChlTKAEbA 提取码: xduu





K8s中，同一个Pod的多个容器之间，网络栈是共享的，这是sidecar实现的基础。




Istio is composed of these components::

    1. Envoy - Sidecar proxies per microservice to handle ingress/egress traffic between services in the cluster and from a service to external services. The proxies form a secure microservice mesh providing a rich set of functions like discovery, rich layer-7 routing, circuit breakers, policy enforcement and telemetry recording/reporting functions.

    Note: The service mesh is not an overlay network. It simplifies and enhances how microservices in an application talk to each other over the network provided by the underlying platform.

    2. Mixer - Central component that is leveraged by the proxies and microservices to enforce policies such as authorization, rate limits, quotas, authentication, request tracing and telemetry collection.

    3. Pilot - A component responsible for configuring the proxies at runtime.

    4. Citadel - A centralized component responsible for certificate issuance and rotation.

    5. Citadel Agent - A per-node component responsible for certificate issuance and rotation.

    6. Galley- Central component for validating, ingesting, aggregating, transforming and distributing config within Istio.



参考
====

* `Stop reinventing the wheel with Istio <https://app.yinxiang.com/fx/e470501b-9796-4167-99b1-8079aa764171>`_

* https://tf.wiki/
* https://www.cnblogs.com/liufei1983/p/10335952.html
* https://blog.csdn.net/zhonglinzhang/article/details/85233390


.. [1] https://istio.io/
.. [2] https://istio.io/docs/