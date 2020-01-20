临时
####

私链创建与启动
#####################


连接控制台::

    // 启动
    $ geth --networkid 123456 --rpc --rpcaddr="0.0.0.0" --rpccorsdomain "*" --nodiscover &  
    // 进入控制台
    $ geth attach

    // 指定 geth.ipc 文件位置
    $ geth --ipcpath ~/.ethereum/geth.ipc attach
    //IPC 方式连接
    $ geth attach ethereum/data1/geth.ipc 
    // TCP 连接控制台
    $ geth --exec 'eth.coinbase' attach http://172.16.0.10:8545
    // WebSocket 方式
    $ geth attach ws://191.168.1.1:8546

配置自动解锁账号::

    $ cat ./password
    123456
    123456
    123456  
    $ geth --networkid 123456 --rpc --rpcaddr="0.0.0.0" --rpccorsdomain "*" --mine --minerthreads 1 --unlock 0 --password ./password

运行JS::

    $ geth --exec "eth.blockNumber" attach
    531
    $ geth --exec 'loadScript("/tmp/checkbalances.js")' attach http://123.123.123.123:8545
    $ geth --jspath "/tmp" --exec 'loadScript("checkbalances.js")' attach http://123.123.123.123:8545     

节点管理::

    geth --bootnodes enode://pubkey1@ip1:port1,enode://pubkey2@ip2:port2,enode://pubkey3@ip3:port3

启动挖矿::

    geth --mine
    //指定挖矿线程数，默认线程数为 2
    geth --mine --minerthreads=16
    // 指定旷工账号, 默认是第一个账号
    geth --mine --minerthreads=16 --etherbase=0x83fda0ba7e6cfa8d7319d78fa0e6b753a2bcb5a6


api 相关参数::

    // rpcapi 启动后允许连接到系统的API协议
    geth --networkid 100000 --rpc --rpcapi "db,eth,net,web3" --rpccorsdomain "*" --datadir "/app/chain" --port "30303" console  
    // 系统默认监听 127.0.0.1 如果希望外部访问本机，需要通过--rpcaddr指定监听地址
    geth --networkid 123456 --rpc --rpcaddr="0.0.0.0" --rpccorsdomain "*" --nodiscover    

.. option:: rpcapi

    // --rpcapi 可以控制访问内容
    $ geth --rpc --rpcapi personal,db,eth,net,web3 --rinkeby  

.. option:: rpcaddr

    默认是 127.0.0.1
    HTTP endpoint closed: http://127.0.0.1:8545
    通过 --rpcaddr="0.0.0.0" 指定监听地址
    HTTP endpoint opened: http://0.0.0.0:8545

.. option:: verbosity

    --verbosity 日志输出级别控制
    geth --verbosity 0 console


启动 Websocket 端口::

    geth --syncmode light --rpc --rpcaddr 0.0.0.0 --rpcapi web3,eth --ws --wsaddr 0.0.0.0 --wsapi web3,eth --wsorigins '*'

    安装 websocket 测试工具 wscat
    npm install -g wscat
    测试 Websocket
    wscat -c ws://127.0.0.1:8546




