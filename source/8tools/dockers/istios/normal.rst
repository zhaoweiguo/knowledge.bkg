常用
####


.. toctree::
   :maxdepth: 2

   normals/install

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

