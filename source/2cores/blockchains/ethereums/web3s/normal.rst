基本
####


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



