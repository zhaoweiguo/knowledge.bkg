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





