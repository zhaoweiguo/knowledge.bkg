账号相关
########


  $ geth account list --help

账号管理::

  // 创建账号
  $ geth account new
  // 指定密码创建
  $ echo "abc123" > password 
  $ geth --password /path/to/password account new
  
  账号创建在 ~/.ethereum/keystore 目录下
  Mac: ~/Library/Ethereum/keystore
  Linux: ~/.ethereum/keystore
  Windows: %APPDATA%/Ethereum/keystore


  //查看账号
  $ geth account list
  $ geth account list --keystore /tmp/mykeystore/

  // 从私钥导入以太坊地址:首先将私钥存储到文件中，然后导入，导入后需要输入密码
  $ echo "f592b7bf06ca9fd7696ba95d6ed8e357de6a2379b6d5fe1ffd53c6b4b063cd4a" > privatekey
  $ geth account import privatekey

  // 查看导入文件
  $ ls .ethereum/keystore/*372fda02e8a1eca513f2ee5901dc55b8b5dd7411
  $ cat .ethereum/keystore/UTC--2018-04-27T09-25-48.189741023Z--372fda02e8a1eca513f2ee5901dc55b8b5dd7411

  $ geth account import --datadir /someOtherEthDataDir ./key.prv
  $ geth account update a94f5374fce5edbc8e2a8697c15331677e6ebf0b
  $ geth account new --password /path/to/password 
  $ geth account import  --datadir /someOtherEthDataDir --password /path/to/anotherpassword ./key.prv

