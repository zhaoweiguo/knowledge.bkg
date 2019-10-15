go mod相关疑问
==============

ambiguous import
---------------------

错误::

    build dispatcher: cannot load github.com/ugorji/go/codec: 
        ambiguous import: found github.com/ugorji/go/codec in multiple modules:

原因::

    报错的字面意思是有一个包多个地方引用但版本不一致。
    详见 https://github.com/ugorji/go/issues/279 
    应该是github.com/ugorji/go这个库的问题，1.1.2版本修复了该问题

解决::

    执行: go get github.com/ugorji/go@v1.1.2

git 私有仓库如何使用 [1]_
-------------------------

因为golang拉取依赖都按照预定义策略，例如https，如果依赖仓库是私有仓库怎么完成自动构建？例如::

    我们有多个私有项目,项目之间也存在包依赖关系,可以通过修改.gitconfig配置完成,例如:
    如果你使用的是gerrit做为代码审核工具的话，可以通过命令

    git config --global url."ssh://你的用户名@example.com:29418/".insteadOf "https://example.com/"
    如:
    git config --global url."git@gitee.com:".insteadof "https://gitee.com/"

本质是~/.gitconfig 增加如下的配置::

    [url "ssh://你的用户名@example:29418/"]
        insteadOf = https://example.com/

    [url "git@gitee.com:"]
        insteadof = http://gitee.com/

如何依赖未提交的库最新代码进行开发
-----------------------------------

可以使用replace配置，替换成本地的路径::

    module example.com/go_service.git
        replace (
        example.com/server/common/go/pub.git => /localpath
    )

    require (
        example.com/server/common/go/pub.git v0.0.0-20181226054539-bec28798b114
    )

parsing go.mod: unexpected module path
--------------------------------------

错误::

    go: github.com/h2non/gock@v1.0.15: parsing go.mod: 
        unexpected module path "gopkg.in/h2non/gock.v1"

原因::

    开源项目地址是github.com/h2non/gock
    但里面代码中import用的却是gopkg.in/h2non/gock.v1

解决方法::

    在go.mod文件中增加:
    replace github.com/h2non/gock => gopkg.in/h2non/gock.v1 v1.0.14





.. [1] http://blog.ipalfish.com/?p=443