简单使用
==============
语言特点::

    自动垃圾回收
    更丰富的内置类型
    函数多返回值
    错误处理
    匿名函数与闭包
    类型与接口
    并发编程
    反射
    语言交互性

语法特点::

    函数头一字母大写时可以类外调用
    var hello string    变量声明
    := 不需要声明变量
    参数类型放在变量后面

命令列表::

    go version
    go run <file>.go
    go build <file>.go
    go clean
    go list
    go test
    go install
    go get
    go tool
    go fmt <package>   // 对包排版: go fmt hello.go | gofmt hello.go

    godoc

go get说明::

    // flag -u: 
    go get -u github.com/zhaoweiguo/foodchain

import相关::

    import(
        "fmt"
        "github.com/zhaoweiguo/chain
    )
    // 要执行: go get github.com/zhaoweiguo/chain

GOPATH::

    export GOPATH=~/work/go-proj1:~/work2/goproj2:~/work3/work4/go-proj3
    // 之后可以在任意目录对以上3个工程进行构建

工程管理::

    export GOPATH=<gopath>
    设定好GOPATH后,可以在任意目录执行:
    go build <file>
    go test <file>

    <gopath>目录结构: 
    |--README
    |--LICENSE
    |--<bin>
        |--calc
    |--<pkg>
        |--<linux_amd64>
           |--simplematch.a
    |--<src>
        |--<calc>
            |--calc.go'
        |--<simplepath>
            |--add.go
            |--add_test.go
            |--sqrt.go
            |--sqrt_test.go
         |--<github.com>
             |--<zhaoweiguo>
                 |--util.go


单元测试::

    文件命名规则: <file>_test.go
    import "testing"

    // 单元测试
    函数命名规则: Test<fun>(t *testing.T) {}
    命令: go test <package>

    级联单元测试命令:
    go test <package>/...
    or 
    go test <folder>/...

    import "github.com/bmizerany/assert"

    assert.Equal(t, <yourData>, <testData>)

    Error, Errorf, FailNow, Fatal, FatalIf方法可以指定此单元测试未通过
    // 性能测试
    函数命名规则: Benchmark<fun>(b *testing.B) {}
    命令: go test -test.bench <file>.go
    go test -test.bench=".*"   // 表示测试全部的压力测试函数

性能测试实例:

.. literalinclude:: ./codes/benchmark_test.go
   :language: go
   :linenos:





