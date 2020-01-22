kubectl label
###################

Usage::

    kubectl label [--overwrite] (-f FILENAME | TYPE NAME) KEY_1=VAL_1 ... KEY_N=VAL_N [--resource-version=version] [options]

实例::

    # 添加标签: key=value
    $> kubectl label po <podName> key=value

    # 修改标签: key2=value2
    $> kubectl label po <podName> key=value2 --overwrite

    # node指定标签,一般是区分不同主机:
    # 1.有gpu 2.有ssd硬盘 3.地点等
    # 注意: 不特别说明pod会调度到哪个node,因为这违背kubenetes对运行在其上的应用程序隐藏实际的基础架构的整个构想
    $> kubectl label node <nodeName> key=value


Examples::

    # Update pod 'foo' with the label 'unhealthy' and the value 'true'.
    kubectl label pods foo unhealthy=true

    # Update pod 'foo' with the label 'status' and the value 'unhealthy', overwriting any existing value.
    kubectl label --overwrite pods foo status=unhealthy

    # Update all pods in the namespace
    kubectl label pods --all status=unhealthy

    # Update a pod identified by the type and name in "pod.json"
    kubectl label -f pod.json status=unhealthy

    # Update pod 'foo' only if the resource is unchanged from version 1.
    kubectl label pods foo status=unhealthy --resource-version=1

    # Update pod 'foo' by removing a label named 'bar' if it exists.
    # Does not require the --overwrite flag.
    kubectl label pods foo bar-





