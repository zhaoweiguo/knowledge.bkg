.. _go_build:

go build命令
###################

usage::

    $ go build [-o output] [-i] [build flags] [packages]
    $ go help build


实例::

    $ go build      // 默认packages为当前目录
    $ go build flysnow.org/tools

    // 3个点表示匹配所有字符串，这样go build就会编译tools目录下的所有包
    $ go build flysnow.org/tools/...



跨平台编译
==========

查看编译环境::

    ➜  ~ go env
    GOARCH="amd64"
    GOEXE=""
    GOHOSTARCH="amd64"
    GOHOSTOS="darwin"
    GOOS="darwin"
    GOROOT="/usr/local/go"
    GOTOOLDIR="/usr/local/go/pkg/tool/darwin_amd64"
    // 注意里面两个重要的环境变量GOOS和GOARCH

编译链工具::

    // 可以让我们在任何一个开发平台上，编译出其他平台的可执行文件
    GOOS=linux GOARCH=amd64 go build flysnow.org/hello






