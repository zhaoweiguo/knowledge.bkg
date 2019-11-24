Golang安装相关
====================

安装命令::

    // 先下载指定os的包
    tar -C /usr/local -xzf go$VERSION.$OS-$ARCH.tar.gz


修改文件$HOME/.profile::

    // 设置GOPATH(指定Golang的安装目录)
    export GOPATH=$HOME/9tool/go
    // 设置GOROOT(指定Golang的项目根目录)
    export GOROOT=$HOME/go1.X


Installing extra Go versions::

    $ go get golang.org/dl/go1.10.7
    $ go1.10.7 download

    # 使用
    $ go1.10.7 version
    go version go1.10.7 linux/amd64


GOPATH::

    export GOPATH=~/work/go-proj1:~/work2/goproj2:~/work3/work4/go-proj3
    // 之后可以在任意目录对以上3个工程进行构建


