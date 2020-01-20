基本
#############


快速启动::

  // 正式
  $ geth console
  $ geth attach
  // 测试版
  $ geth --testnet console
  $ geth attach <datadir>/testnet/geth.ipc   // 重新连接
  // proof-of-authority based test network
  $ geth --rinkeby console


基本命令::

  // 列出帐户列表
  > personal.listAccounts
  // 创建新帐户
  > personal.newAccount()

  // 查询默认帐户余额
  > web3.fromWei(eth.getBalance(eth.coinbase), "ether")
  // 查询第2个帐户余额
  web3.fromWei(eth.getBalance(eth.accounts[1]),"ether")

  // 开始挖矿
  miner.start(1)
  // 停止挖矿
  miner.stop()
  // 说明：当出现“Mined block”这样的字眼时，说明成功挖矿

  // 转帐
   eth.sendTransaction({from: '0x08268e9540b8d21f0867ce436e792777737ecfb6', to: '0x6eb4fe3bbcc30bb2f588996d9947398c77637ddb', value: web3.toWei(1, "ether")})

  // 帐号解锁
  personal.unlockAccount("0x08268e9540b8d21f0867ce436e792777737ecfb6", "q1w2e3r4", 300)

初始化创建::

  // 新增配置文件:genesis.json
  {
    "config": {   // 定义个人链的设置
          "chainId": 0,         // 你个人链的唯一标识
          "homesteadBlock": 0,  // 定义ethereum平台的version和protocol
          "eip155Block": 0,     // 用于支持non-backward-compatible协议的改变
          "eip158Block": 0      // 
      },
    "alloc"      : {},
    "coinbase"   : "0x0000000000000000000000000000000000000000",
    "difficulty" : "0x2000",    // 挖矿难度
    "extraData"  : "",
    "gasLimit"   : "0x2fefd8",  // 燃料限制，越大限制越少
    "nonce"      : "0x0000000000000042",
    "mixhash"    : "0x0000000000000000000000000000000000000000000000000000000000000000",
    "parentHash" : "0x0000000000000000000000000000000000000000000000000000000000000000",
    "timestamp"  : "0x00"
  }
  // 注:
  // 1. 不想让别人连接你的话，修改nonce的值
  // 2. 可以修改alloc的值来预先给帐户钱
  "alloc": {
    "0x0000000000000000000000000000000000000001": {"balance": "111111111"},
    "0x0000000000000000000000000000000000000002": {"balance": "222222222"}
  }

  ./geth  --datadir "/data/chain" init init.json
  // 初始创建后，就可用以下命令启动
  ./geth --datadir "/data/chain" console
  // 启动后可以用以下命令连接
  geth attach /data/chain/geth.ipc


