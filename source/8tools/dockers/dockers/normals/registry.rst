运行自己的Docker Registry
------------------------------

1. 从Docker容器安装一个Registry::

    ## 拉去registry镜像
    # docker pull registry
     
    ## 搭建本地镜像源
    # docker run -d -v /opt/registry:/var/lib/registry -p 5000:5000 --restart=always --name registry registry:latest
     
    ## 查看容器状态
    # docker ps -a
    CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS                     PORTS                    NAMES
    f570fab5d67d        registry:latest     "/entrypoint.sh /etc   3 seconds ago       Up 3 seconds               0.0.0.0:5000->5000/tcp   registry


将我们的镜像上传到本地的Docker Registr::

    ## 找到我们要上传的镜像
    # docker images test/apache2
    REPOSITORY          TAG                 IMAGE ID            CREATED             VIRTUAL SIZE
    test/apache2       latest              9c30616364f4        7 days ago          254.4 MB
     
    ## 使用新的Registry给该镜像打上标签
    # docker tag 9c30616364f4 docker.example.com:5000/test/apache2
     
    ## 通过docker push 命令将它推送到新的Registry中去
    # docker push docker.example.com:5000/test/apache2
    The push refers to a repository [docker.example.com:5000/test/apache2] (len: 1)
    9c30616364f4: Image already exists
    f5bb94a8fac4: Image successfully pushed
    2e36b30057ab: Image successfully pushed
    0346cecb4e51: Image successfully pushed
    274da7f89b05: Image successfully pushed
    b5ce920a148c: Image successfully pushed
    576b12d1aa01: Image successfully pushed
    Digest: sha256:0c22a559f8dea881bca046e0ca27a01f73aa5f3c153b08b8bdf3306082e48b72
     
    ## 测试我们上传的镜像
    # docker run -it docker.example.com:5000/test/apache2 /bin/bash








