*********************
私有仓库拉取镜像 [1]_
*********************

目的::

    从私有docker仓库拉取镜像，部署pod

.. note:: 阿里本帐号的k8s集群使用本帐号下的私有镜像库有更方便的办法，具体参考ali相关资料

创建Secret::

    // k8s集群使用类型为docker-registry
    $ kubectl -n goweb create secret docker-registry <registry-key> \
    --docker-server=registry.cn-beijing.aliyuncs.com \
    --docker-username=zhaoweiguo \
    --docker-password=<your-pword> \
    --docker-email=xxxx@163.com

使用::

    apiVersion: apps/v1
    kind: Deployment
    metadata:
      name: anlysis-web-deploy
      namespace: goweb
    spec:
      selector:
        matchLabels:
          app: anlysis-web
      replicas: 2
      template:
        metadata:
          labels:
            app: anlysis-web
        spec:
          imagePullSecrets:
            - name: <registry-key>
          containers:
            - name: anlysis-web
              image: registry.cn-beijing.aliyuncs.com/xxxxxxxx/analysis-backend:v3
              command: ["/analysis-backend"]














.. [1] https://help.aliyun.com/document_detail/86307.html