启动ssh隧道
====================

linux下操作 [1]_
-------------------

* 直接使用终端,输入::

    ssh -D 7070 username@yourserver.com

    ssh -CfNg -D 0.0.0.0:1080 -l username xxx.xxx.xxx.xxx
    各参数含义:
    -C 传输时压缩数据
    -f 输入密码登陆后，ssh进入后台运行
    -N 不执行远程命令，只提供端口转发。仅用于ssh2协议
    -g 允许远程主机连接ssh转发端口
    -D 设置socks代理地址和监听端口，如果是只允许本地访问则指定IP为127.0.0.1
    -l ssh登陆用户名
    -i 指定ssh登陆用的私钥，如果是用公钥、私钥对登陆则需要指定


* 使用gSTM客户端(ubuntu)::

    apt-get install gstm
    “应用程序->互联网“菜单下面找到:gSTM

* gSTM客户端使用:

.. figure:: /images/fanqiangs/mytunnel.png
   :width: 80%

.. figure:: /images/fanqiangs/mini-gstm-edit-redirection-mini.png
   :width: 80%

windows下操作
------------------


使用Tunnelier这个软件

* 首先打开软件后设置登入信息. 打开login选项, 然后看图:

.. figure:: /images/fanqiangs/Bitvise-Tunnelier-SSH2-Client.png
   :width: 80%

* 打开Options选项 按图来就可以了 其他的不需要动:

.. figure:: /images/fanqiangs/Bitvise-Tunnelier-SSH2-Client2.png
   :width: 80%

* Options选择完后 接着打开Services选项:

.. figure:: /images/fanqiangs/Bitvise-Tunnelier-SSH2-Client3.png
   :width: 80%



.. [1] http://blog.csdn.net/luosiyong/article/details/7685273


