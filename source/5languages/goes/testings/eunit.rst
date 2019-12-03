单元测试
########

::

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



Subtests
========

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
========

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






