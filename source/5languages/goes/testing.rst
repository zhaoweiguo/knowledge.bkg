.. _go_testing:

单元测试 [1]_
#################

综述
========

::

    import "testing"
    func TestXxx(*testing.T)

实例::

    func TestAbs(t *testing.T) {
        got := Abs(-1)
        if got != 1 {
            t.Errorf("Abs(-1) = %d; want 1", got)
        }
    }


    

Benchmarks
=================

::

    func BenchmarkXxx(*testing.B)

实例::

    func BenchmarkHello(b *testing.B) {
        for i := 0; i < b.N; i++ {
            fmt.Sprintf("hello")
        }
    }

If a benchmark needs some expensive setup before running, the timer may be reset::

    func BenchmarkBigLen(b *testing.B) {
        big := NewBig()
        b.ResetTimer()
        for i := 0; i < b.N; i++ {
            big.Len()
        }
    }

If a benchmark needs to test performance in a parallel setting::

    func BenchmarkTemplateParallel(b *testing.B) {
        templ := template.Must(template.New("test").Parse("Hello, {{.}}!"))
        b.RunParallel(func(pb *testing.PB) {
            var buf bytes.Buffer
            for pb.Next() {
                buf.Reset()
                templ.Execute(&buf, "World")
            }
        })
    }


Subtests and Sub-benchmarks
================================

::

    func TestFoo(t *testing.T) {
        // <setup code>
        t.Run("A=1", func(t *testing.T) { ... })
        t.Run("A=2", func(t *testing.T) { ... })
        t.Run("B=1", func(t *testing.T) { ... })
        // <tear-down code>
    }

命令::

    go test -run ''      # Run all tests.
    go test -run Foo     # Run top-level tests matching "Foo", such as "TestFooBar".
    go test -run Foo/A=  # For top-level tests matching "Foo", run subtests matching "A=".
    go test -run /A=1    # For all top-level tests, run subtests matching "A=1".

实例
========
demo1::

    package main

    import "testing"

    func TestAdd(t *testing.T) {
        if Add(1,2) == 3 {
            t.Log("1+2=3")
        }

        if Add(1,1) == 3 {
            t.Error("1+1=3")
        }
    }

表组测试
===========

有好几个输入，同时对应的也有好几个输出，这种一次性测试很多个输入输出场景的测试，就是表组测试。

例::

    func TestAdd(t *testing.T) {
        sum := Add(1,2)
        if sum == 3 {
            t.Log("the result is ok")
        } else {
            t.Fatal("the result is wrong")
        }
        
        sum=Add(3,4)
        if sum == 7 {
            t.Log("the result is ok")
        } else {
            t.Fatal("the result is wrong")
        }
    }

模拟调用
==========

单元测试的原则，就是你所测试的函数方法，不要受到所依赖环境的影响，比如网络访问等，因为有时候我们运行单元测试的时候，并没有联网，那么总不能让单元测试因为这个失败吧？所以这时候模拟网络访问就有必要了。

方案1::

    针对模拟网络访问，标准库了提供了一个httptest包，可以让我们模拟http的网络调用:
    首先我们创建一个处理HTTP请求的函数，并注册路由:
    详情见go_demo中的testing/demo2_http_test

方案2::

    真的在测试机上模拟一个服务器，然后进行调用测试:
    模拟服务器的创建使用的是httptest.NewServer函数，它接收一个http.Handler处理API请求的接口。 代码示例中使用了Hander的适配器模式，http.HandlerFunc是一个函数类型，实现了http.Handler接口，这里是强制类型转换，不是函数的调用

    这个创建的模拟服务器，监听的是本机IP127.0.0.1，端口是随机的。接着我们发送Get请求的时候，不再发往/sendjson，而是模拟服务器的地址server.URL，剩下的就和访问正常的URL一样了，打印出结果即可。
    详情见go_demo中的testing/demo3_http_test

测试覆盖率
============

我们尽可能的模拟更多的场景来测试我们代码的不同情况，但是有时候的确也有忘记测试的代码，这时候我们就需要测试覆盖率作为参考了。

由单元测试的代码，触发运行到的被测试代码的代码行数占所有代码行数的比例，被称为测试覆盖率，代码覆盖率不一定完全精准，但是可以作为参考，可以帮我们测量和我们预计的覆盖率之间的差距，go test工具，就为我们提供了这么一个度量测试覆盖率的能力。

main.go::

    func Tag(tag int){
        switch tag {
        case 1:
            fmt.Println("Android")
        case 2:
            fmt.Println("Go")
        case 3:
            fmt.Println("Java")
        default:
            fmt.Println("C")

        }
    }

main_test.go::

    func TestTag(t *testing.T) {
        Tag(1)
        Tag(2)

    }




现在我们使用go test工具运行单元测试，和前几次不一样的是，我们要显示测试覆盖率，所以要多加一个参数-coverprofile,所以完整的命令为：go test -v -coverprofile=c.out，-coverprofile是指定生成的覆盖率文件，例子中是c.out，这个文件一会我们会用到。现在我们看终端输出，已经有了一个覆盖率。

结果::

    === RUN   TestTag
    Android
    Go
    --- PASS: TestTag (0.00s)
    PASS
    coverage: 60.0% of statements
    ok      flysnow.org/hello       0.005s

coverage: 60.0% of statements，60%的测试覆盖率，还没有到100%，那么我们看看还有那些代码没有被测试到。这就需要我们刚刚生成的测试覆盖率文件c.out生成测试覆盖率报告了。生成报告有go为我们提供的工具，使用go tool cover -html=c.out -o=tag.html，即可生成一个名字为tag.html的HTML格式的测试覆盖率报告，这里有详细的信息告诉我们哪一行代码测试到了，哪一行代码没有测试到。


.. figure:: /images/golangs/testing_cover_report.png
   :width: 80%

从上图中可以看到，标记为绿色的代码行已经被测试了；标记为红色的还没有测试到，有2行的，现在我们根据没有测试到的代码逻辑，完善我的单元测试代码即可::

    func TestTag(t *testing.T) {
        Tag(1)
        Tag(2)
        Tag(3)
        Tag(6)

    }


单元测试完善为如上代码，再运行单元测试，就可以看到测试覆盖率已经是100%了，大功告成。

覆盖度
======

::

    go test -cover github.com/drone/go-scm/scm/...



.. [1] https://golang.org/pkg/testing/


