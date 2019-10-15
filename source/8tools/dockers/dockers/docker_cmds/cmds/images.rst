docker images
######################

Usage::

    // 列出images列表
    // List images
    docker images [OPTIONS] [REPOSITORY[:TAG]]


实例::

    $ docker images
    # docker images test/static_web
    REPOSITORY          TAG                 IMAGE ID            CREATED             VIRTUAL SIZE
    test/static_web     latest              94728651ce15        20 hours ago        212.1 MB

    # 查看所有镜像,可与其他命令配合使用(如rmi)
    $ docker images -a -q

Options::

    -a, --all             Show all images (default hides intermediate images)
        --digests         Show digests
    -f, --filter filter   Filter output based on conditions provided
        --format string   Pretty-print images using a Go template
        --no-trunc        Don't truncate output
    -q, --quiet           Only show numeric IDs





