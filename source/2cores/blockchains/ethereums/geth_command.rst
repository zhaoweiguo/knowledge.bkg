ethereums命令
======================

::

  $ geth help


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

命令使用::

    geth [global options] command [command options] [arguments...]

    COMMANDS:
       recover      attempts to recover a corrupted database by setting a new block by number or hash. See help recover.
       blocktest    loads a block test file
       import       import a blockchain file
       export       export blockchain into file
       upgradedb    upgrade chainblock database
       removedb     Remove blockchain and state databases
       dump         dump a specific block from storage
       monitor      Geth Monitor: node metrics monitoring and visualization
       makedag      generate ethash dag (for testing)
       version      print ethereum version numbers
       wallet       ethereum presale wallet
       account      manage accounts
       console      Geth Console: interactive JavaScript environment
       attach       Geth Console: interactive JavaScript environment (connect to node)
       js           executes the given JavaScript files in the Geth JavaScript VM
       help         Shows a list of commands or help for one command

    GLOBAL OPTIONS:
       --identity                                                           Custom node name
       --unlock
       Unlock the account given until this program exits (prompts for password). '--unlock n' unlocks the n-th account in order or creation.
       --password
       Path to password file to use with options and subcommands needing a password
       --genesis
       Inserts/Overwrites the genesis block (json format)
       --bootnodes
       Space-separated enode URLs for p2p discovery bootstrap
       --datadir "/Users/tron/Library/Ethereum"
       Data directory to be used
       --blockchainversion "3"                                              Blockchain version (integer)
       --jspath "."                                                         JS library path to be used with console and js subcommands
       --port "30303"                                                       Network listening port
       --maxpeers "25"                                                      Maximum number of network peers (network disabled if set to 0)
       --maxpendpeers "0"                                                   Maximum number of pending connection attempts (defaults used if set to 0)
       --etherbase "0"                                                      Public address for block mining rewards. By default the address first created is used
       --gasprice "1000000000000"                                           Sets the minimal gasprice when mining transactions
       --minerthreads "8"                                                   Number of miner threads
       --mine                                                               Enable mining
       --autodag                                                            Enable automatic DAG pregeneration
       --nat "any"                                                          NAT port mapping mechanism (any|none|upnp|pmp|extip:<IP>)
       --natspec                                                            Enable NatSpec confirmation notice
       --nodiscover                                                         Disables the peer discovery mechanism (manual peer addition)
       --nodekey                                                            P2P node key file
       --nodekeyhex                                                         P2P node key as hex (for testing)
       --rpc                                                                Enable the JSON-RPC server
       --rpcaddr "127.0.0.1"                                                Listening address for the JSON-RPC server
       --rpcport "8545"                                                     Port on which the JSON-RPC server should listen
       --rpcapi "db,eth,net,web3"                                           Specify the API's which are offered over the HTTP RPC interface
       --ipcdisable                                                         Disable the IPC-RPC server
       --ipcapi "admin,db,eth,debug,miner,net,shh,txpool,personal,web3"     Specify the API's which are offered over the IPC interface
       --ipcpath "/Users/tron/Library/Ethereum/geth.ipc"                    Filename for IPC socket/pipe
       --exec                                                               Execute javascript statement (only in combination with console/attach)
       --shh                                                                Enable whisper
       --vmdebug                                                            Virtual Machine debug output
       --networkid "1"                                                      Network Id (integer)
       --rpccorsdomain                                                      Domain on which to send Access-Control-Allow-Origin header
       --verbosity "3"                                                      Logging verbosity: 0-6 (0=silent, 1=error, 2=warn, 3=info, 4=core, 5=debug, 6=debug detail)
       --backtrace_at ":0"                                                  If set to a file and line number (e.g., "block.go:271") holding a logging statement, a stack trace will be logged
       --logtostderr                                                        Logs are written to standard error instead of to files.
       --vmodule ""                                                         The syntax of the argument is a comma-separated list of pattern=N, where pattern is a literal file name (minus the ".go" suffix) or "glob" pattern and N is a log verbosity level.
       --logfile                                                            Send log output to a file
       --logjson                                                            Send json structured log output to a file or '-' for standard output (default: no json output)
       --pprof                                                              Enable the profiling server on localhost
       --pprofport "6060"                                                   Port on which the profiler should listen
       --metrics                                                            Enables metrics collection and reporting
       --solc "solc"                                                        solidity compiler to be used
       --gpomin "1000000000000"                                             Minimum suggested gas price
       --gpomax "100000000000000"                                           Maximum suggested gas price
       --gpofull "80"                                                       Full block threshold for gas price calculation (%)
       --gpobasedown "10"                                                   Suggested gas price base step down ratio (1/1000)
       --gpobaseup "100"                                                    Suggested gas price base step up ratio (1/1000)
       --gpobasecf "110"                                                    Suggested gas price base correction factor (%)
       --help, -h                                                           show help




