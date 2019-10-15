network简单命令
======================


.. _host:

host命令
----------------

::

    host example.com
    host -t TYPE example.com  # TYPE有mx, ns, a, txt, soa, any
    host -t a example.com

.. _ping:

ping命令使用
---------------
::

    ping <IP 地址>


.. _ip:

ip命令使用
---------------

子命令::

       link 网卡配置
       address 配置地址。相当于 ifconfig
       route 配置路由。相当于 route

参数::

       show 显示 (默认)
       set 设置
       add 添加
       del 删除

示例::

     ip link show              显示网卡配置
     ip link set eth0 name xxx 重命名网络接口



.. _ifconfig:

ifconfig命令使用
--------------------


ifconfig  配置网络接口::

    -a 显示所有网络接口

ifconfig <网卡> up|down  激 活|禁用网卡

示例::

  ifconfig eth0 down    // 关闭网卡
  ifconfig eth0 up      // 激活网卡

给网卡指定 IP 地址或子网掩码::

    ifconfig <网卡> add <IP 地址> [ netmask <子网掩码> ]

例::
  
    sudo ifconfig eth0 192.168.10.123 netmask 255.255.255.0



.. _telnet:

telnet命令
---------------

* telnet命令::

    >>telnet $Url $Port
    Trying $Url...
    Connected to $Url. 
    Escape character is '^]'
    >>GET /$Path HTTP/1.1 
    >>Accept: text/plain 
    >>
    HTTP/1.1 200 OK

* 想输入命令::

    Ctrl + ]



