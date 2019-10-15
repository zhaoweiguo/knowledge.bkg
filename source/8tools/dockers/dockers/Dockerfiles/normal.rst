Dockerfile命令说明 [1]_
#######################


FROM::

    每个Dockerfile的第一条指令都应该是FROM,
    FROM指令指定一个已经存在的镜像，后续指令都是将基于该镜像进行，
    这个镜像被称为基础镜像（base iamge）
    
    格式:
    FROM <image>
    FROM <image>:<tag>
    
    实例:
    FROM zhaoweiguo/utuntu:12.02
    FROM python:2.7-slim


MAINTAINER::

    # 这条指令会告诉Docker该镜像的作者是谁，以及作者的邮箱地址。这有助于表示镜像的所有者和联系方式
    MAINTAINER <name>

RUN::

    每条RUN指令都会创建一个新的镜像层，如果该指令执行成功，就会将此镜像层提交
    之后继续执行Dockerfile中的下一个指令

    格式:
    RUN <command>
    RUN ["executable", "param1", "param2"]

    实例:
    1. 默认情况下，RUN指令会在shell里使用命令包装器/bin/sh -c 来执行
    RUN apt-get update
    RUN apt-get install -y nginx
    RUN echo 'Hi, I am in your container' > /usr/share/nginx/html/index.html

    2. 如果是在一个不支持shell的平台上运行或者不希望在shell中运行
    也可以使用exec格式的RUN指令，通过一个数组的方式指定要运行的命令和传递给该命令的每个参数
    RUN ["/bin/bash", "-c", "echo hello"]
    RUN ["apt-get", "install", "-y", "nginx"]

ARG::

    格式:
    ARG <参数名>[=<默认值>]

    以在构建命令 docker build 中用 --build-arg <参数名>=<值> 来覆盖


CMD::

    格式:
    # The main purpose of a CMD is to provide defaults for an executing container. 
    CMD ["executable", "param1", "param2"]    # (like an exec, this is the preferred form)
    CMD ["param1","param2"]       #  (as default parameters to ENTRYPOINT)
    CMD command param1 param2     #  (as a shell)

    实例:
    e.g. CMD echo "This is a test." | wc -
    e.g. CMD ["/usr/bin/wc","--help"]
    Note: don't confuse RUN with CMD. RUN actually runs a command and commits the result; CMD does not execute anything at build time, but specifies the intended command for the image.

EXPOSE::

    EXPOSE指令是告诉Docker该容器内的应用程序将会使用容器的指定端口
    出于安全的原因，Docker并不会自动打开该端口，
    而是需要你在使用docker run运行容器时来指定需要打开哪些端口
    可以指定多个EXPOSE指令来向外部公开多个端口，Docker也使用EXPOSE指令来帮助将多个容器

    格式:
    EXPOSE <port> [<port>...]

    实例:


ENV::

    # 设定环境变量environment
    ENV <key> <value>
    # 可以通过docker inspect查看这些值
    # 可以通过docker run --env <key>=<value>修改这些值
    e.g. ENV DEBIAN_FRONTEND noninteractive   # will persist when the container is run interactively; for example: docker run -t -i image bash

ADD::

    # 拷贝一个宿主机上的文件<src>到container的<dest>目录下
    ADD <src> <dest>
    类似: mount到指定位置
    # @todo 还有好多信息

COPY::

    # 和ADD命令有细微不同
    COPY <src> <dest>
    类似cp命令

ENTRYPOINT::

    # 一个Dockerfile文件中只能有一个ENTRYPOINT
    # 如果有ENTRYPOINT那么整个container可看作一个executable文件
    # 执行的命令不会被docker run覆盖(与CMD不同)

    样例1:
    ENTRYPOINT  ["executable", "param1", "param2"]   # (like an exec, the preferred form)
    // exec形式: 主进程(Pid 1)是node进程
    $> docker exec <xxx> ps x
    Pid TTY STAT    COMMAND
    1   ?   Ssl     node app.js
    12  ?   Rs      ps x

    样例2:
    ENTRYPOINT command param1 param2    # (as a shell)
    // shell形式: 主进程(Pid 1)是shell进程而非node进程
    $> docker exec <xxx> ps x
    Pid TTY STAT    COMMAND
    1   ?   Ss     /bin/sh -c node app.js
    7   ?   Sl     node app.js
    12  ?   Rs      ps x



VOLUME::

    # 磁盘挂载
    VOLUME ["/data"]
    VOLUME /var/log

USER::

    # sets the user name or UID
    USER daemon

WORKDIR::

    格式:
    WORKDIR /path/to/workdir
    
    实例:
    WORKDIR /a
    WORKDIR b
    WORKDIR c
    RUN pwd
    # /a/b/c

ONBUILD::

    ONBUILD [INSTRUCTION]




实例::

    # This is a comment
    FROM ubuntu:14.04
    MAINTAINER Kate Smith <ksmith@example.com>
    RUN apt-get update && apt-get install -y ruby ruby-dev
    RUN gem install sinatra



.. [1] https://docs.docker.com/reference/builder/

