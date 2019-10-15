web3
#############

web3
---------

单位::

    // Ether币最小的单位是Wei
    kwei (1000 Wei)
    mwei (1000 KWei)
    gwei (1000 mwei)
    szabo (1000 gwei)
    finney (1000 szabo)
    ether (1000 finney)

单位转换::

    > web3.fromWei(10000000000000000,"ether")
    > web3.fromWei(10000000000000000)

    > web3.toWei(1)
    > web3.toWei(1.3423423)



admin 管理
--------------

::

    > admin
    // 看看 networkid
    > admin.nodeInfo.protocols.eth.network

    // 确保网络可用 
    > net.listening
    // 显示当前节点信息
    > admin.nodeInfo
    // 节点地址
    > admin.nodeInfo.enode 
    // 添加节点
    > admin.addPeer('enode://9f6490ffb5236f2ddc5710ae73d47c740e0a3644bbd2d67029cf4a6c4693d2f470b642fd2cc3507f7e851df60aaeb730a1270b7a477f91ec5b6b17a8a4b40527@172.16.0.1:30303')        

    查看节点
    // 查看节点数量
    > net.peerCount
    // 查看节点地址
    > admin.peers
    // 列出节点IP地址
    > admin.peers.forEach(function(p) {console.log(p.network.remoteAddress);})
    // networkid
    > admin.nodeInfo.protocols.les.network

挖矿相关
------------

::

    // 设置默认矿工账号
    > miner.setEtherbase("0x83fda0ba7e6cfa8d7319d78fa0e6b753a2bcb5a6")

    // 实例:
    > eth.accounts
    > eth.coinbase
    > miner.setEtherbase("0xe8abf98484325fd6afc59b804ac15804b978e607")
    > eth.coinbase










