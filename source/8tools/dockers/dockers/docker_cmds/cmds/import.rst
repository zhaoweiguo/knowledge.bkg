docker import
######################

Docker导入本地镜像::

    // 注意镜像文件必须是tar.gz类型的文件
    cat alibaba-rocketmq-3.2.6.tar.gz | docker import - rocketmq:3.2.6(镜像名自己定义)

保存镜像::


    docker save -o rocketmq.tar rocketmq:3.2.6
    # -o：指定保存的镜像的名字；
    # rocketmq.tar：保存到本地的镜像名称；
    # rocketmq：镜像名字，通过"docker images"查看


载入镜像::

    docker load --input rocketmq.tar 
    或
    docker load < rocketmq.tar




