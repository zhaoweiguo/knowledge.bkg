kubewatch命令
#############

安装
====

Go安装::

    $ go get -u github.com/bitnami-labs/kubewatch

源码安装::

    $ cd kubewatch
    $ go build -o kubewatch main.go

说明::

    会生成: ~/.kubewatch.yaml

简单实例
========

# Configure the notification channel::

    // slack
    $ kubewatch config add slack --channel <slack_channel> --token <slack_token>
    // flock
    $ kubewatch config add flock --url <flock_webhook_url>

# Add resources to be watched::

    $ kubewatch resource add --po --svc
    INFO[0000] resource svc configured                      
    INFO[0000] resource po configured 


# start kubewatch server::

    $ kubewatch
    INFO[0000] Starting kubewatch controller                 pkg=kubewatch-service
    INFO[0000] Starting kubewatch controller                 pkg=kubewatch-pod
    INFO[0000] Processing add to service: default/kubernetes  pkg=kubewatch-service
    INFO[0000] Processing add to service: kube-system/tiller-deploy  pkg=kubewatch-service
    INFO[0000] Processing add to pod: kube-system/tiller-deploy-69ffbf64bc-h8zxm  pkg=kubewatch-pod
    INFO[0000] Kubewatch controller synced and ready         pkg=kubewatch-service
    INFO[0000] Kubewatch controller synced and ready         pkg=kubewatch-pod

Configure
=========

Viewing config::

    $ kubewatch config view


$ kubewatch config -h::

    config command allows admin setup his own configuration for running kubewatch
    Usage:
      kubewatch config [flags]
      kubewatch config [command]

    Available Commands:
      add         add webhook config to .kubewatch.yaml
      test        test handler config present in .kubewatch.yaml
      view        view .kubewatch.yaml
    Flags:
      -h, --help   help for config
    Use "kubewatch config [command] --help" for more information about a command.


Resources
=========

::

    $ kubewatch resource -h

    manage resources to be watched

    Usage:
      kubewatch resource [flags]
      kubewatch resource [command]

    Available Commands:
      add         adds specific resources to be watched
      remove      remove specific resources being watched

    Flags:
          --cm       watch for plain configmap
          --deploy   watch for deployments
          --ds       watch for daemonsets
      -h, --help     help for resource
          --ing      watch for ingresses
          --job      watch for job
          --ns       watch for namespaces
          --po       watch for pods
          --pv       watch for persistent volumes
          --rc       watch for replication controllers
          --rs       watch for replicasets
          --secret   watch for plain secrets
          --svc      watch for services

    Use "kubewatch resource [command] --help" for more information about a command.

参考
====

* `郭旭东x-Kubernetes 资源观测利器：KubeWatch <https://developer.aliyun.com/article/737956>`_




