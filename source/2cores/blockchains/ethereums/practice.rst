实操
#######

::

    > geth --datadir="~/ethereum/data" --rpc=true --rpcport 8545 --rpccorsdomain "*" --rpcaddr="10.140.2.17" console

    > personal.unlockAccount(eth.accounts[0], "q1w2e3r4");
    true
    > eth.sendTransaction({from: eth.accounts[0], data : "0x0c"});
    "0x5f5b0227108511f91db89f0aae641183856c4f2987158fb75aed6bb2fc12b3cc"

    > trans = "0x5f5b0227108511f91db89f0aae641183856c4f2987158fb75aed6bb2fc12b3cc";
    > eth.getTransaction(trans);
    {
      blockHash: "0x0000000000000000000000000000000000000000000000000000000000000000",
      blockNumber: null,
      from: "0xfd13005f4d9415b1c5cacecbedeb7d8f94468750",
      gas: 90000,
      gasPrice: 1000000000,
      hash: "0x5f5b0227108511f91db89f0aae641183856c4f2987158fb75aed6bb2fc12b3cc",
      input: "0x0c",
      nonce: 10,
      r: "0x88985aed98d6a1835fcf071e40448e72b7b7038bd7f0ab1d2754d8855089f336",
      s: "0x428c137455a6b083045b4a218cf82cb7fa3902a609cdc71eb2cb67e4248ac395",
      to: null,
      transactionIndex: 0,
      v: "0x41",
      value: 0
    }
    // 一段时间后
    > eth.getTransaction(trans);
    {
      blockHash: "0x1009e504e9088eb88342924aa383ac951ec0438bee58fa761dbd9f2def270e85",
      blockNumber: 3299,
      from: "0xfd13005f4d9415b1c5cacecbedeb7d8f94468750",
      gas: 90000,
      gasPrice: 1000000000,
      hash: "0x5f5b0227108511f91db89f0aae641183856c4f2987158fb75aed6bb2fc12b3cc",
      input: "0x0c",
      nonce: 10,
      r: "0x88985aed98d6a1835fcf071e40448e72b7b7038bd7f0ab1d2754d8855089f336",
      s: "0x428c137455a6b083045b4a218cf82cb7fa3902a609cdc71eb2cb67e4248ac395",
      to: null,
      transactionIndex: 0,
      v: "0x41",
      value: 0
    }



::

    > personal.unlockAccount(eth.accounts[0], "q1w2e3r4");
    true
    > eth.sendTransaction({from: eth.accounts[0], data : "0x0ca175b9c0f726a831d895e269332461"});
    "0x1c3950f2e70c6d237cb39bb73bc529fdd1f0c7da5c95761f3c44aff7e5bc6791"
    > eth.getTransaction("0x1c3950f2e70c6d237cb39bb73bc529fdd1f0c7da5c95761f3c44aff7e5bc6791");
    {
      blockHash: "0x0000000000000000000000000000000000000000000000000000000000000000",
      blockNumber: null,
      from: "0xed141ec55ceebd8606838f8579155c2acacc2279",
      gas: 90000,
      gasPrice: 1000000000,
      hash: "0x1c3950f2e70c6d237cb39bb73bc529fdd1f0c7da5c95761f3c44aff7e5bc6791",
      input: "0x0ca175b9c0f726a831d895e269332461",
      nonce: 0,
      r: "0x26ce75e0d79fd623f75862540686fbbcf93a5c79e73462d67a3bc89c9d829b48",
      s: "0x3451ccb338c03ff984812cc2466afd5251c2f28bd042349f66c4436550f9a301",
      to: null,
      transactionIndex: 0,
      v: "0x42",
      value: 0
    }



