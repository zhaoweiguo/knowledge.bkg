Docker代理加速
##################

配置镜像加速器 [1]_
::

    // Linux版
    sudo mkdir -p /etc/docker
    sudo tee /etc/docker/daemon.json <<-'EOF'
    {
      "registry-mirrors": ["https://bpsifqa9.mirror.aliyuncs.com"]
    }
    EOF
    sudo systemctl daemon-reload
    sudo systemctl restart docker

.. warning:: 注意, systemctl restart docker会重启docker服务
    k8s集群上执行,所有docker服务都会重启






.. [1] https://cr.console.aliyun.com/cn-hangzhou/instances/mirrors