临时收集
==========
拜占庭将军问题::

  https://www.zhihu.com/question/23167269


离线的钱包就是冷钱包，
在线的钱包就是热钱包，

从安全性角度看：冷钱包>热钱包>平台
从便捷性看：平台>热钱包>冷钱包

bip32 = hd wallets, what they are how they work
bip39 = specific type of mnemonic, and the process for turning it into a bip32 seed
bip44 = a specific format of a bip32 wallet

如何计算Gas手续费::

    > var estimateGas = eth.estimateGas({from:eth.accounts[1], to: eth.accounts[2], value: web3.toWei(1)})
    undefined

    > console.log(estimateGas)
    21000
    undefined

    > var cost = estimateGas * gasPrice
    undefined

    > console.log(cost)
    378000000000000
    undefined

    > web3.fromWei(cost)
    "0.000378"

转出账号中所有 ETH，Ethereum Wallet 中的 Send everything 实现方法::

    > personal.unlockAccount(eth.accounts[3], "12345678")
    true

    > eth.sendTransaction({from: eth.accounts[3], to: eth.accounts[5], value: eth.getBalance(eth.accounts[3]) - cost, gas: estimateGas})
    "0x4e27a477e128b200239bc2ecd899077c6ae064da963a919fef41bcc7462aec8d"

    // 查看交易细节
    > web3.eth.getTransaction("0x4e27a477e128b200239bc2ecd899077c6ae064da963a919fef41bcc7462aec8d")
    {
      blockHash: "0x59a9905831e7ae3cb9e7c6f125cf48e2688ef4b39317838f6f6b6c8837d01404",
      blockNumber: 4367,
      from: "0x8efb99ec55bcfbe2cfe47918f2d9e55fa732111f",
      gas: 21000,
      gasPrice: 18000000000,
      hash: "0x4e27a477e128b200239bc2ecd899077c6ae064da963a919fef41bcc7462aec8d",
      input: "0x",
      nonce: 15,
      r: "0xa297401df3a1fb0298cbc1dd609deebe9ded319fadc55934ecef4d525198215",
      s: "0x780d8c46bc8d1bb89ae9d78055307d9d68a4f89ba699ef86d3f8ba88383139a6",
      to: "0xf0688330101d53bd0c6ede2ef04d33c2010e9a5d",
      transactionIndex: 0,
      v: "0x42",
      value: 999622000000000000
    }

    // 现在查看from账号，余额已经清零
    > eth.getBalance(eth.accounts[3])
    0





    // 返回交易信息
    > web3.eth.getTransaction("0xece08c46f872bc70406f67c7ce03ba9606532f3459fdaa8b8efeeb12ac8f1004")
    > eth.getBlock(213)
    // 返回交易收据
    > web3.eth.getTransactionReceipt("0x4e27a477e128b200239bc2ecd899077c6ae064da963a919fef41bcc7462aec8d")

    // 返回值说明
    Object - 交易的收据对象，如果找不到返回null 
    blockHash: String - 32字节，这个交易所在区块的哈希。
    blockNumber: Number - 交易所在区块的块号。
    transactionHash: String - 32字节，交易的哈希值。
    transactionIndex: Number - 交易在区块里面的序号，整数。
    from: String - 20字节，交易发送者的地址。
    to: String - 20字节，交易接收者的地址。如果是一个合约创建的交易，返回null。
    cumulativeGasUsed: Number - 当前交易执行后累计花费的gas总值10。
    gasUsed: Number - 执行当前这个交易单独花费的gas。
    contractAddress: String - 20字节，创建的合约地址。如果是一个合约创建交易，返回合约地址，其它情况返回null。
    logs: Array - 这个交易产生的日志对象数组。  

eth.syncing 同步状态::

    > eth.syncing
    // 显示百分比
    > console.log(parseInt(eth.syncing.currentBlock/eth.syncing.highestBlock*100,10)+'%')
    // 剩余块数
    eth.syncing.highestBlock - eth.syncing.currentBlock
    setInterval(function(){
      console.log(eth.syncing.highestBlock - eth.syncing.currentBlock)
    },5000);
    // 进度监控
    var lastPercentage = 0;var lastBlocksToGo = 0;var timeInterval = 10000;
    setInterval(function(){
        var percentage = eth.syncing.currentBlock/eth.syncing.highestBlock*100;
        var percentagePerTime = percentage - lastPercentage;
        var blocksToGo = eth.syncing.highestBlock - eth.syncing.currentBlock;
        var bps = (lastBlocksToGo - blocksToGo) / (timeInterval / 1000)
        var etas = 100 / percentagePerTime * (timeInterval / 1000)

        var etaM = parseInt(etas/60,10);
        console.log(parseInt(percentage,10)+'% ETA: '+etaM+' minutes @ '+bps+'bps');

        lastPercentage = percentage;lastBlocksToGo = blocksToGo;
    },timeInterval);




区块链的每个参与者都保存一个账本，账本中的一页叫做一个“区块”（block）。账本中保存系统里每一笔交易的信息。通过类似于民主投票的方式，保证所有数据的一致性。只要大多数人是好的，就可以保证系统的正确运行。一个区块链系统是由一批分布（在全球）的节点组成的，其中每个节点都是一台自主的设备（计算机）。系统存在的目的是为了维护一个分布式的账本。这个账本是由一个个的数据区块（block）有序连接在一起形成的一个链条——区块链。系统中每一个节点都完整地保存整条区块链上所有的数据。因此，只要大多数节点是好的，任何异常、非法的行为都会立刻被发现并且纠正。


根据组成节点的类型，区块链系统可以分为：
公有链（public blockchains）：节点分别属于众多不同的组织和个人。理论上讲，任何计算设备都可以自由加入系统。
私有链（private blockchains）：所有节点属于同一个组织。只有获得管理员批准的计算设备才可以加入系统。
联盟链（consortium blockchains）：节点属于有紧密联系的若干组织或个人。介乎于公有链与私有链之间，由一组管理员来共同协调管理。


区块链系统中每一个节点都完整地保存整条区块链上所有的数据。显然，每一个节点随时都可以自由地读取区块链上的数据。同样显然，不可能允许节点们同时去写区块链上的数据。任何时刻，只能有唯一一个写者。究竟谁有资格写数据？算力证明（Proof of Work）、



分叉与共识
只有提供了算力证明的节点才能获得写区块的权力。但是，如果两个甚至更多个节点几乎同时提供了算力证明，这就会导致不同节点分别写入不同的区块，从而造成区块链分叉。当区块链出现分叉时，使用如下方法在不同节点间取得共识：最长链法则：要求大家都尽量选取最长的那个分叉。如果有多个分叉都是最长，那么在其中随便选取一个在任意时刻，不同节点对于数据的认知都可能是不同的显然无法保证节点之间立刻取得共识但随着时间推移，节点对于“有年龄的数据”的认知趋于一致！


智能合约
金融合同的数字化、自动化实现。用分布在多方的代码来表示合同的内容。通过运行这些代码来自动执行合同。主流区块链系统普遍支持智能合约：比特币系统提供一个脚本语言，可以用来书写智能合约，但该功能是图灵不完全的。以太坊系统提供了图灵完全的智能合约功能区块链系统的分布性、无中心性为智能合约提供了绝佳的环境支撑。智能合约的强大功能为区块链系统提供了无穷的潜力。


区块链的密码学支撑

区块链系统在本质上是密码学的应用，依赖于一系列密码学工具的支持。例如，对于数据完整性（data integrity）的保护依赖于数字签名、Merkle树等来保障其真实性。数字签名：一长串0/1
。
• Alice对于任意文本都能产生
对应的签名；
• Bob总可以验证签名的有效性。
• 敌方对于任意文本都不能伪
造对应的签名。
• Bob总可以检测出伪造。

在区块链系统中，一个区块通常包含上千个交易记录。为了保护数据完整性，对每一个交易记录做数字签名是非常低效的做法。常采用Merkle树技术来大大提高效率，采用Merkle树之后，每个区块只需要一个数字签名。但对于上千个交易记录中任何一个的篡改都可以被迅速检测找出。




优势：
去中心化
在创造性地去除被信任的第三方，转而依靠全体节点共识之后，系统各方面性能得到大幅度提升：用户控制力增强；数据质量提高；系统可靠性提高；系统生命期延长；透明性更好；

智能合约的使用
智能合约是区块链生命力的保障，去中心化的区块链环境恰好为智能合约提供了理想的土壤有了区块链，有了区块链支持的智能合约，就可以大规模地进行像高频交易(Highfrequency trading)这样的新兴金融业务。



潜在问题：
效率瓶颈
比特币使用的交易模式是UTXO，每个区块产生时间大约为10分钟，每秒的交易效率为7次；以太坊使用账户余额的交易模式
效 率 7tx/s 280tx/s
出块时间 10min 14s
普通人的耐心：几秒到几分钟

安全与隐私
保护用户隐私，支持匿名交易，严格监管，支持案件调查、追踪，防止对同一货币的再次使用
智能合约的强大功能是区块链系统的巨大优势，然而智能合约又含有众多严重的安全隐患。
编码状态机中的逻辑错误
不对等的激励（misaligned
调用栈bug

区块链是一种分布式的账本，其去中心化的思想带给我们一种颠覆性的新技术。区块链系统优势明显，但其在诸如安全隐私、效率等方面的潜在问题也不可忽视。



以太坊中查询某个地址的交易记录
--------------------------------------

以太坊提供了查询某个block中包含的Transactions，以及根据交易hash来获取Transaction的方法。但是以太坊并没有提供，直接根据一个Address查询对应交易记录的方法。那么我们有三种方法可以来查询。

利用循环的方式，查询某一个block区间中，包含的与该地址相关的交易。
利用 filter监听交易，当出现与该地址相关的交易时，存储到数据库中（eg:ES）。但是这个可能会遇到一个问题，就是假如某一个时刻，服务中断或出现异常，那么可能这一条数据就丢失了。
启动一个Job,用Job来遍历数据，把数据插入到本地数据库中，（eg:ES）.

根据地址查询交易
'''''''''''''''''

这边提供第一种方法的web3.js实现，利用循环的方式，查询某一个block区间中，包含的与该地址相关的交易。废话不多说，代码如下::

    var Web3 = require("web3");
    var web3 = new Web3();
    web3.setProvider(new web3.providers.HttpProvider('http://localhost:8545'));
    getTransactionsByAddr(web3,"0x6e4Cc3e76765bdc711cc7b5CbfC5bBFe473B192E",133064,134230);
    //myaccount :需要查询的地址信息，startBlockNumber：查询的其实blockNumber，endBlockNumber：查询的结束blockNumber
    async function getTransactionsByAddr(web3,myaccount,startBlockNumber,endBlockNumber) {

        if (endBlockNumber == null) {
          endBlockNumber = await web3.eth.blockNumber;
          console.log("Using endBlockNumber: " + endBlockNumber);
        }
        if (startBlockNumber == null) {
          startBlockNumber = endBlockNumber - 1000;
          console.log("Using startBlockNumber: " + startBlockNumber);
        }
        console.log("Searching for transactions to/from account \"" + myaccount + "\" within blocks " + startBlockNumber + " and " + endBlockNumber);

        for (var i = startBlockNumber; i <= endBlockNumber; i++) {
          if (i % 1000 == 0) {
            console.log("Searching block " + i);
          }
          var block = await web3.eth.getBlock(i, true);
          if (block != null && block.transactions != null) {
            block.transactions.forEach(function (e) {
              if (myaccount == "*" || myaccount == e.from || myaccount == e.to) {
                console.log(" tx hash : " + e.hash + "\n"
                  + " nonce : " + e.nonce + "\n"
                  + " blockHash : " + e.blockHash + "\n"
                  + " blockNumber : " + e.blockNumber + "\n"
                   + " transactionIndex: " + e.transactionIndex + "\n"
                  + " from : " + e.from + "\n" 
                  + " to : " + e.to + "\n"
                  + " value : " + web3.utils.fromWei(e.value.toString()) + "\n"
                  + " time : " + timeConverter(block.timestamp) + " " + new Date(block.timestamp * 1000).toGMTString() + "\n"
                  + " gasPrice : " + e.gasPrice + "\n"
                  + " gas : " + e.gas + "\n"
                   + " input : " + e.input
                  + "--------------------------------------------------------------------------------------------"
                );
              }
            })
          }
        }
      }

      function timeConverter(UNIX_timestamp) {
        var a = new Date(UNIX_timestamp * 1000);
        var year = a.getFullYear();
        var month = a.getMonth() + 1;
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = year + '/' + month + '/' + date + ' ' + hour + ':' + min + ':' + sec;
        return time;
      }

命令
----

::

    eth.accounts[0]
    eth.getBalance(eth.accounts[0])

    transaction = "0x1c3950f2e70c6d237cb39bb73bc529fdd1f0c7da5c95761f3c44aff7e5bc6734";
    eth.getTransaction(transaction);


    personal.unlockAccount(eth.accounts[0], "q1w2e3r4")

    var code = "603d80600c6000396000f3007c01000000000000000000000000000000000000000000000000000000006000350463c6888fa18114602d57005b6007600435028060005260206000f3";
    eth.sendTransaction({from: eth.accounts[0], data : code});

    web3.eth.sendTransaction({from: eth.accounts[0], data: code}, function(err, transactionHash) {
      if (!err)
        console.log(transactionHash);
    });


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









性能测试
'''''''''''''

https://blog.csdn.net/manok/article/details/82084852
https://zhuanlan.zhihu.com/p/39262324


