Connectivity相关
===========================

常见命令::

  // 检查网络是否可用
  > net.listening   // 是否监听
  > net.peerCount   // 连接结点数
  > admin.peers     // 连接结点详情
  > admin.nodeInfo  // 当前结点详情


  // 启动时设置bootnodes:
  geth --bootnodes "enode://pubkey1@ip1:port1 enode://pubkey2@ip2:port2 enode://pubkey3@ip3:port3"


静态结点::

  $> touch <datadir>/static-nodes.json
  [
    "enode://f4642fa65af50cfdea8fa7414a5def7bb7991478b768e296f5e4a54e8b995de102e0ceae2e826f293c481b5325f89be6d207b003382e18a8ecba66fbaf6416c0@33.4.2.1:30303",
    "enode://pubkey@ip:port"
  ]

  > admin.addPeer("enode://f4642fa65af50cfdea8fa7414a5def7bb7991478b768e296f5e4a54e8b995de102e0ceae2e826f293c481b5325f89be6d207b003382e18a8ecba66fbaf6416c0@33.4.2.1:30303")
