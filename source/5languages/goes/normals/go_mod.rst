Go包管理
############


* Go 模块idea使用指南 [1]_
* 介绍1 [2]_
* 介绍2 [3]_


go get引入私有git库 [4]_ ::

    git config --global url."git@gitee.com:".insteadof "https://gitee.com/"

    关掉 GO 代理 拉取代码

    export GOPROXY

    // 如果没有用https或证书
    go get -v   -insecure  gitcodecloud.zhaoweiguo.com.cn/tools/dauth

deps管理依赖 [5]_




.. [1] https://blog.jetbrains.com/cn/2019/03/go-%E6%A8%A1%E5%9D%97%E4%BD%BF%E7%94%A8%E6%8C%87%E5%8D%97/
.. [2] https://juejin.im/post/5c9c8c4fe51d450bc9547ba1
.. [3] http://copyfuture.com/blogs-details/c0da8fd286057159b61b483fa0e8a4c6
.. [4] https://golang.org/doc/faq#git_https
.. [5] https://github.com/golang/dep