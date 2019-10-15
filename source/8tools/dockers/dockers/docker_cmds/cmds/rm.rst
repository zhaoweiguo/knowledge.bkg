docker rm
################


Usage::

    // 移除containers
    // Remove one or more containers
    docker rm [OPTIONS] CONTAINER [CONTAINER...]


Options::

    -f, --force     Force the removal of a running container (uses SIGKILL)
    -l, --link      Remove the specified link
    -v, --volumes   Remove the volumes associated with the container

实例::

    $ docker rm container1
    # 一次删除2个
    $ docker rm container2 container3







