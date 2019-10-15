其他
#######

EOF错误
-----------

详情::

    consumer/broker disconnecting due to error processing FetchRequest: EOF


1. 原因与解决::

    Version版本不对

    // 解决:
    Version   = "2.1.1"
    =>
    Version   = "0.10.2.1"

debugserver or lldb-server not found
-------------------------------------------

::

    debugserver or lldb-server not found: install XCode's command line tools or lldb-server


解决::

    重新安装下xcode-select就好了
    xcode-select --install






