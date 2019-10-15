IP选路，动态选路
------------------
静态IP选路::

  % 一个简单的路由表
  Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
  192.168.11.0    *               255.255.255.0   U     0      0        0 eth0
  169.254.0.0     *               255.255.0.0     U     0      0        0 eth0
  default         192.168.11.1    0.0.0.0         UG    0      0        0 eth0

五种不同的flag::

    U表明该路由可用
    G表明该路由是到一个网关
      如果没有这个标志，说明和Destination是直连的
      而相应的Gateway应该直接给出Destination的地址
    H表明该路由是到一个主机
      如果没有该标志，说明Destination是一个网络
      换句话说Destination就应该写成一个网络号和子网号的组合,而不包括主机号(主机号码处为0)
      例如 192.168.11.0
    D表明该路由是为重定向报文创建的
    M该路由已经被重定向报文修改






