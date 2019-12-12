.. _mod:

go mod命令
##########

Usage::

    $ go mod <command> [arguments]
    $ go help mod <command>

<command>::

    download    download modules to local cache
    edit        edit go.mod from tools or scripts
    graph       print module requirement graph
    init        initialize new module in current directory
    tidy        add missing and remove unused modules
    vendor      make vendored copy of dependencies
    verify      verify dependencies have expected content
    why         explain why packages or modules are needed

init::

    $ go mod init example.com/m

    // 下载缺少的、移除不用的module
    $ go mod tidy




参考
====

* `Go Modules : v2 及更高版本 <https://juejin.im/post/5de7c00d518825122b0f7113>`_


