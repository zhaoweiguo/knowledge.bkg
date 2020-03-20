LimitRange.yaml
###############

LimitRange是namespace级别的, 即在namespace中有一个LimitRange, 则此namespace下创建pod时会自动加上LimitRange上的限制。

.. literalinclude:: /files/k8s/yamls/LimitRange.yaml
   :language: yaml




