Golang安装相关
====================

安装命令::

  // 先下载指定os的包
  tar -C /usr/local -xzf go$VERSION.$OS-$ARCH.tar.gz


修改文件$HOME/.profile::

  // 设置GOPATH
  export GOPATH=$HOME/9tool/go

  // 设置PATH
  // 默认GOROOT是$HOME/go
  export PATH=$PATH:/usr/local/go/bin
  //如果不安装到/usr/local目录下，则要指定GOROOT
  export GOROOT=$HOME/go1.X
  export PATH=$PATH:$GOROOT/bin









