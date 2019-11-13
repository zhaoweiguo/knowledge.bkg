Docker网络模式详解
##################

网络基础 [1]_
=============


.. image:: /images/dockers/net_osi.png

Docker 四种网络模式::

    默认网络模式 - bridge
    无网络模式 - none
    宿主网络模式 - host
    自定义网络

一, 默认网络模式 - `bridge`
===========================

首先来侃一侃docker0. 之所以说它是默认的网络，是由于当我们运行container的时候没有“显示”的指定网络时，我们的运行起来的container都会加入到这个“默认” docker0 网络。他的模式是bridge。

.. image:: /images/dockers/net_bridge.png

说明 [3]_ ::

    如下图所示为Docker中 bridge 驱动模式的示意图，其中蓝色的模块表示主机上的网卡
    当Docker启动时会自动在主机上创建一个虚拟网桥 docker0 ，
        使用默认网络模式创建docker容器时会自动创建一对儿 veth pair 接口，
            一端连接在docker容器中（如图容器中的 eth0 ），
            一端连接在虚拟网桥 docker0 上（如图 veth ）
    这种 veth pair 是一种虚拟网络设备，主要用于不同namespace中(意味着网络隔离)的网络通信，它总是成对存在的
        在这里可以把它想象成一对儿靠虚拟网线连接起来的两个虚拟网卡
            一端连接着docker容器，一端连接着虚拟网桥 docker0 。

    通过这种方式，不同docker容器之间可以通过ip地址互相通信
        也可以通过虚拟网桥访问主机上的网络 eth0
        (添加iptables规则,将docker容器对目标地址发出的访问通过地址伪装 的方式修改为主机对目标地址进行访问)

    如果想要外界网络访问docker容器时，需要在docker容器启动时加上参数'-p [主机端口]:[容器端口]'进行端口映射
    原理也是通过修改iptables规则将访问[主机端口]的数据转发到docker容器的[容器端口]中
    但是这种做法也存在着占用主机有限的端口资源的缺点。



.. image:: /images/dockers/net_bridge.png

安装Docker时，它会自动创建三个网络::

    $ docker network ls
    NETWORK ID          NAME                DRIVER              SCOPE
    557d70cd18ab        bridge              bridge              local
    27015fb1d01c        host                host                local
    d7bdd36df894        none                null                local

除非您使用该docker run --network=<NETWORK>选项另行指定，否则Docker守护程序默认情况下将容器连接到此网络。您可以使用主机上的ifconfig命令将此桥接器视为主机网络堆栈的一部分::

    $ ifconfig
    docker0   Link encap:Ethernet  HWaddr 02:42:47:bc:3a:eb
              inet addr:172.17.0.1  Bcast:0.0.0.0  Mask:255.255.0.0
              inet6 addr: fe80::42:47ff:febc:3aeb/64 Scope:Link
              UP BROADCAST RUNNING MULTICAST  MTU:9001  Metric:1
              RX packets:17 errors:0 dropped:0 overruns:0 frame:0
              TX packets:8 errors:0 dropped:0 overruns:0 carrier:0
              collisions:0 txqueuelen:0
              RX bytes:1100 (1.1 KB)  TX bytes:648 (648.0 B)

默认的名为bridge的网络是有很多限制的，为此，我们可以自行创建bridge类型的网络。默认的bridge网络与自建bridge网络有以下区别::

    端口不会自行发布，必须使用-p参数才能为外界访问
        而使用自建的bridge网络时，container的端口可直接被相同网络下的其他container访问
    container之间的如果需要通过名字访问，需要`--link`参数，
        而如果使用自建的bridge网络，container之间可以通过名字互访
        注: 不建议采用这种方法

二, 无网络模式 - `none`
=======================

顾名思义，所有加入到这个网络模式中的container，都"不能”进行网络通信。


三, 宿主网络模式 - `host`
=========================


* 直接使用宿主机的网络，端口也使用宿主机的
* 这种网络模式将container与宿主机的网络相连通，虽然很直接，但是却破获了container的隔离性
* 该模型仅适用于Docker17.6及以上版本

四, 自定义网络
==============

docker 允许我们创建3种类型的自定义网络，bridge，overlay，MACVLAN::

    bridge：Bridge模式是Docker默认的网络模式
        当Docker进程启动时，会在主机上创建一个名为docker0的虚拟网桥，用来连接宿主机和容器
        此主机上的Docker容器都会连接到这个虚拟网桥上
    overlay：当有多个docker主机时，跨主机的container通信
        可以连接多个docker守护进程或者满足集群服务之间的通信；适用于不同宿主机上的docker容器之间的通信
    macvlan：每个container都有一个虚拟的MAC地址
        可以为docker容器分配MAC地址，使其像真实的物理机一样运行
    plugins ：使用第三方网络驱动插件；



案例1-默认网络
==============

运行以下两个命令以启动两个Ubuntu容器，每个容器都连接到默认bridge网络::

    $ docker run -itd --name container1 ubuntu
    ea30f1c9d86621b54e38b0c890c717b1a56391f0545560b883322edd398c7d98

    $ docker run -itd --name container2 ubuntu
    ecc3bdf69155dd76955ea2ef7573789ab293ecab61488e5d9c81e589d4395d2b

bridge启动两个容器后再次检查网络。确保两个Ubuntu容器都连接到网络::

    $ docker network inspect bridge
    [
        {
            "Name": "bridge",
            "Id": "4784e1934901e6ec7b3575d824904e9022980563aa547059e2e842016e05cf4b",
            "Created": "2019-02-15T17:33:24.059683063+08:00",
            "Scope": "local",
            "Driver": "bridge",
            "EnableIPv6": false,
            "IPAM": {
                "Driver": "default",
                "Options": null,
                "Config": [
                    {
                        "Subnet": "172.17.0.0/16",
                        "Gateway": "172.17.0.1"
                    }
                ]
            },
            "Internal": false,
            "Attachable": false,
            "Ingress": false,
            "ConfigFrom": {
                "Network": ""
            },
            "ConfigOnly": false,
            "Containers": {
                "ea30f1c9d86621b54e38b0c890c717b1a56391f0545560b883322edd398c7d98": {
                    "Name": "container1",
                    "EndpointID": "eb8055f5187b1dfa8c17049ca55c53d28c52de6c95ff42d0d23892f0151151f4",
                    "MacAddress": "02:42:ac:11:00:02",
                    "IPv4Address": "172.17.0.2/16",
                    "IPv6Address": ""
                },
                "ecc3bdf69155dd76955ea2ef7573789ab293ecab61488e5d9c81e589d4395d2b": {
                    "Name": "container2",
                    "EndpointID": "e0fc810bf1fded3c80a7d89c84bc41a0f83b742f280cab7111002fd266c6ec7c",
                    "MacAddress": "02:42:ac:11:00:03",
                    "IPv4Address": "172.17.0.3/16",
                    "IPv6Address": ""
                }
            },
            "Options": {
                "com.docker.network.bridge.default_bridge": "true",
                "com.docker.network.bridge.enable_icc": "true",
                "com.docker.network.bridge.enable_ip_masquerade": "true",
                "com.docker.network.bridge.host_binding_ipv4": "0.0.0.0",
                "com.docker.network.bridge.name": "docker0",
                "com.docker.network.driver.mtu": "1500"
            }
        }
    ]



案例2-自己的桥接网络
====================

创建自己的桥接网络
------------------

::

    $ docker network create -d bridge tinywan_bridge
    // Docker Engine本身支持桥接网络和覆盖网络。
    //     桥接网络仅限于运行Docker Engine的单个主机
    //     覆盖网络可以包含多个主机，是一个更高级的主题
    // 在本例中，您将创建一个桥接网络

    $ docker network ls    // 查看
    NETWORK ID          NAME                DRIVER              SCOPE
    4784e1934901        bridge              bridge              local
    e8e19c0711e1        host                host                local
    1e8bc1e399a7        none                null                local
    9fd23f7f3998        tinywan_bridge      bridge              local    <-- 新增

指定网络启动容器db
------------------

::

    $ docker run -d --net=tinywan_bridge  --name db redis:5.0-alpine
    // 利用`--network`或者`--net`启动容器提供服务
    // 或者使用全名:
    $ docker run -d --network=tinywan_bridge  --network-alias db redis:5.0-alpine
    通过选项--network-alias将取名的db起了一个别名

    $ docker inspect --format='{{json .NetworkSettings.Networks}}' db
    {
        "tinywan_bridge": {
            "IPAMConfig": null,
            "Links": null,
            "Aliases": [
                "11379ad91a62"
            ],
            "NetworkID": "9fd23f7f3998962d6b378f4cbab8cc9f8a2e7aa64bb3502dd1c0b3a5c1d0c7b0",
            "EndpointID": "9c530e400049590b4ba63b75de96c0039b4ee52dbf36fad51df84a24fc028e3e",
            "Gateway": "192.168.192.1",
            "IPAddress": "192.168.192.2",
            "IPPrefixLen": 20,
            "IPv6Gateway": "",
            "GlobalIPv6Address": "",
            "GlobalIPv6PrefixLen": 0,
            "MacAddress": "02:42:c0:a8:c0:02",
            "DriverOpts": null
        }
    }

方法1:手工附加网络连接db容器
----------------------------

使用默认网络启动容器web::

    $ docker run -d  --name web nginx
    // 默认bridge网络中运行
    $ docker inspect --format='{{json .NetworkSettings.Networks}}' web
    {
        "bridge": {
            "IPAMConfig": null,
            "Links": null,
            "Aliases": null,
            "NetworkID": "4784e1934901e6ec7b3575d824904e9022980563aa547059e2e842016e05cf4b",
            "EndpointID": "4f6372bc7152f73b6ddc13296ce365a024ada4074d19b2aaac8066b1a6f8ca92",
            "Gateway": "172.17.0.1",
            "IPAddress": "172.17.0.2",
            "IPPrefixLen": 16,
            "IPv6Gateway": "",
            "GlobalIPv6Address": "",
            "GlobalIPv6PrefixLen": 0,
            "MacAddress": "02:42:ac:11:00:02",
            "DriverOpts": null
        }
    }
    //获取您的IP地址web容器的
    $ docker inspect --format='{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' web
    172.17.0.2

在web容器ping db容器::

    $ docker exec -it web bash

    root@b6b8928824f8:/# ifconfig 
    eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
            inet 172.17.0.2  netmask 255.255.0.0  broadcast 172.17.255.255
            ether 02:42:ac:11:00:02  txqueuelen 0  (Ethernet)
            RX packets 2521  bytes 8728256 (8.3 MiB)
            RX errors 0  dropped 0  overruns 0  frame 0
            TX packets 2460  bytes 175592 (171.4 KiB)

    // ping失败。这是因为两个容器在不同的网络上运行
    root@b6b8928824f8:/# ping 192.168.192.2 
    PING 192.168.192.2 (192.168.192.2) 56(84) bytes of data.
    ^C
    --- 192.168.192.2 ping statistics ---
    7 packets transmitted, 0 received, 100% packet loss, time 6046ms

将容器附加到指定网络::

    $ docker network connect tinywan_bridge web
    $ docker inspect --format='{{range .NetworkSettings.Networks}} {{.IPAddress}}{{end}}' web
    172.17.0.2 192.168.192.3

断开容器与docker0的连接::

    $ docker network disconnect bridge web
    // 我们的容器仍然连接着默认bridge docker0 ，而现在我们已经不需要它

再次在web容器ping db容器::

        root@b6b8928824f8:/# ping db 
        // 成功ping通
        注: 只使用容器名称db而不是IP地址
        PING db (192.168.192.2) 56(84) bytes of data.
        64 bytes from db.tinywan_bridge (192.168.192.2): icmp_seq=1 ttl=64 time=0.079 ms

.. image:: /images/dockers/net_eth0.png



方法2:启动容器指定网络连接db容器
--------------------------------

启动容器::

    $ docker run -d --network=tinywan_bridge  --network-alias web --name web nginx

ping db容器::

        root@b6b8928824f8:/# ping db 
        // 成功ping通
        注: 只使用容器名称db而不是IP地址
        PING db (192.168.192.2) 56(84) bytes of data.
        64 bytes from db.tinywan_bridge (192.168.192.2): icmp_seq=1 ttl=64 time=0.079 ms

自定义网络和运行时指定IP [2]_
=============================

使用默认的网络是不支持指派固定IP的::

    ~ docker run -itd --net bridge --ip 172.17.0.10 centos:latest/bin/bash
    6eb1f228cf308d1c60db30093c126acbfd0cb21d76cb448c678bab0f1a7c0df6
    docker: Error response from daemon: User specified IP address is supported on user defined networks only.

步骤1: 创建自定义网络::

    ➜ ~ docker network create --subnet=172.18.0.0/16mynetwork
    ➜ ~ docker network ls
    NETWORK ID     NAME        DRIVER       SCOPE
    9781b1f585ae    bridge       bridge      local
    1252da701e55    host        host       local
    4f11ae9c85de    mynetwork      bridge      local
    237ea3d5cfbf    none        null       local

步骤2: 创建Docker容器::

    ~ docker run -itd --name networkTest1 --net mynetwork --ip 172.18.0.2 centos:latest bash

    [root@ec8e31938fe7 /]# ifconfig
    eth0   Link encap:Ethernet HWaddr 02:42:AC:12:00:02
         inet addr:172.18.0.2 Bcast:0.0.0.0 Mask:255.255.0.0
         inet6 addr: fe80::42:acff:fe12:2/64Scope:Link
         UP BROADCAST RUNNING MULTICAST MTU:1500 Metric:1
         RX packets:88 errors:0 dropped:0 overruns:0 frame:0
         TX packets:14 errors:0 dropped:0 overruns:0 carrier:0
         collisions:0 txqueuelen:0
         RX bytes:4056 (3.9 KiB) TX bytes:1068 (1.0 KiB)





.. [1] https://cloud.tencent.com/developer/article/1464744
.. [2] https://blog.csdn.net/sbxwy/article/details/78962809
.. [3] https://www.codercto.com/a/79681.html