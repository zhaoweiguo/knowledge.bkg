常见问题
########

* :ref:`阿里SLB限制导致service一直pending <ali_slb_limit>`

Job has reached the specified backoff limit
===========================================

说明::

    我使用Job启动一个服务, 这个服务是一个死循环, 启动起来一直运行
    有一段时间后发现这个服务不可用了, 有对应的job但没有对应的pod

查看过程::

    $ kubectl get Job
    // 此job对应的COMPLETIONS为未执行完
    NAME              COMPLETIONS   DURATION   AGE
    <jobName>           0/1           91d        91d
    $ kubectl get po
    // 对应的pod为空, 找不到对应的pod了
    $ kubectl describe job <jobName>
    ...
    // pod状态有一个显示Failed
    Pods Statuses:  0 Running / 0 Succeeded / 1 Failed
    ...
    $ kubectl get job <jobName> -o yaml:
    // 再细查, 发现具体原因是BackoffLimitExceeded
    ...
    status:
      conditions:
      - lastProbeTime: 2020-02-25T02:59:22Z
        lastTransitionTime: 2020-02-25T02:59:22Z
        message: Job has reached the specified backoff limit
        reason: BackoffLimitExceeded
        status: "True"
        type: Failed
    ...

解决::

    由于pod已经没有了, 所以查不出具体原因, 猜测是因为pod崩溃重启超过6次后不再重启了
    配置选项: spec.backoffLimit不配置默认是6
    即超过6次重启后就不再重启

    后续:
    先重启起来，继续定位问题



