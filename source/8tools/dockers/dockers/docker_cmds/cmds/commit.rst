docker commit
###################

Usage::

    // Create a new image from a container's changes
    docker commit [OPTIONS] CONTAINER [REPOSITORY[:TAG]]

Options::

    -a, --author string    Author (e.g., "John Hannibal Smith <hannibal@a-team.com>")
    -c, --change list      Apply Dockerfile instruction to the created image
    -m, --message string   Commit message
    -p, --pause            Pause container during commit (default true)

实例::

    // 提交commit: -m: 消息内容, -a: 提交者
    $ docker commit -m="Added json gem" -a="Kate Smith" 0b2616b0e5a8 zhaoweiguo/sinatra:v2





