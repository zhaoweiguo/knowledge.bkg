admin 管理
--------------

::

    > admin
    // 看看 networkid
    > admin.nodeInfo.protocols.eth.network

    // 确保网络可用 
    > net.listening
    // 节点地址
    > admin.nodeInfo.enode      

    查看节点
    // 列出节点IP地址
    > admin.peers.forEach(function(p) {console.log(p.network.remoteAddress);})
    // networkid
    > admin.nodeInfo.protocols.les.network

查看节点数量::

    > net.peerCount
    2


连接结点详情::

    > admin.peers
    [{
      ID: 'a4de274d3a159e10c2c9a68c326511236381b84c9ec52e72ad732eb0b2b1a2277938f78593cdbe734e6002bf23114d434a085d260514ab336d4acdc312db671b',
      Name: 'Geth/v0.9.14/linux/go1.4.2',
      Caps: 'eth/60',
      RemoteAddress: '5.9.150.40:30301',
      LocalAddress: '192.168.0.28:39219'
    }, {
      ID: 'f4642fa65af50cfdea8fa7414a5def7bb7991478b768e296f5e4a54e8b995de102e0ceae2e826f293c481b5325f89be6d207b003382e18a8ecba66fbaf6416c0',
      Name: '++eth/Zeppelin/Rascal/v0.9.14/Release/Darwin/clang/int',
      Caps: 'eth/60, shh/2',
      RemoteAddress: '129.16.191.64:30303',
      LocalAddress: '192.168.0.28:39705'
    } ]

显示当前节点信息::

    > admin.nodeInfo
    {
      Name: 'Geth/v0.9.14/darwin/go1.4.2',
      NodeUrl: 'enode://3414c01c19aa75a34f2dbd2f8d0898dc79d6b219ad77f8155abf1a287ce2ba60f14998a3a98c0cf14915eabfdacf914a92b27a01769de18fa2d049dbf4c17694@[::]:30303',
      NodeID: '3414c01c19aa75a34f2dbd2f8d0898dc79d6b219ad77f8155abf1a287ce2ba60f14998a3a98c0cf14915eabfdacf914a92b27a01769de18fa2d049dbf4c17694',
      IP: '::',
      DiscPort: 30303,
      TCPPort: 30303,
      Td: '2044952618444',
      ListenAddr: '[::]:30303'
    }

添加节点::

    > admin.addPeer('enode://9f6490ffb5236f2ddc5710ae73d47c740e0a3644bbd2d67029cf4a6c4693d2f470b642fd2cc3507f7e851df60aaeb730a1270b7a477f91ec5b6b17a8a4b40527@172.16.0.1:30303')   







