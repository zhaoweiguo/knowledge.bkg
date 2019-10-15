docker attach
#####################

Usage::

    // Attach local standard input, output, and error streams to a running container
    docker attach [OPTIONS] CONTAINER

实例::

    # 连接到container
    $ docker attach <container>


Options::

      --detach-keys string   Override the key sequence for detaching a container
      --no-stdin             Do not attach STDIN
      --sig-proxy            Proxy all received signals to the process (default true)


