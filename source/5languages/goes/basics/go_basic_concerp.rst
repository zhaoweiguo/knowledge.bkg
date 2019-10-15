定义说明
===================

变量声明::

    var v1 int
    var v2 string
    var v3 [] int    // 数组
    var v4 []int     // 数组切片
    var v5 struct {
        f int
    }
    var v6 *int    // 指针
    var v7 map[string]int   //map类型: key为string类型，value为int类型
    var v8 func(a int) int 
    var (
       vv1 int
       vv2 string
    )


常量定义::

    const Pi float64 = 3.141592653589793
    const zero = 0.0   // 无类型浮点常量
    const (
        size int64 =1024
        eof = -1     // 无类型整形常量
    )
    const u, v float32 = 0, 3    // u=0.0, v=3.0   常量的多重赋值
    const a, b, c = 3, 4, "float"   //a=3, b=4, c="float", 无类型整形和字符串常量

预定义::

    true, false, iota

    iota:
    每个const出现是重置为0, 这期间每次iota, 其代表的数字都会+1
    const (
        c0 = iota         // iota:0, c0: 0
        c1 = iota         // iota:1, c1: 1
        c2 = 1 << iota     // iota:2, c2: 4
        c3 = 2 * iota     // iota:3, c3: 6
    )

枚举::

    const (
        Sunday = iota
        Monday
        Tuesday
        thursday   // 此变量没导出
    )

基础类型::

    //基础类型
    布尔: bool
    整形: int8, byte(uint8), int16, int(长度平台相关), uint, uintptr
    浮点: float32, float64
    复数: complex64, complex128
    字符串: string
    字符: rune   //代表unicode字符,bype代表utf8字符
    错误类型: error
    //复合类型
    指针: pointer
    数组: array
    切片: slice
    字典: map
    通道: chan
    结构体: struct
    接口: interface

位运算::

    x << y   左移
    x >> y   右移
    x ^ y    异或
    x & y    与
    x | y    或
    ^x       取反(c中为~c)

struct结构::

    type G struct {
        H int
        I string
    }

    type T struct{
        A bool
        B int "myb"  // go struct tag(用来辅助反射的)::
        D string `bson:",omitempty"json:"jsonkey"`

        G    //匿名字段，那么默认T就包含了G的所有字段,即: H, I
    }

    // 使用:
    t := T { false, "myb", "bson", G{1, "iii"} }
    fmt.Println(t.H)  // 1 访问结构G的字段H就像访问自己的字段一样


数组切片::

    1. 指向原生数组的指针
    2. 数组切片中元素个数
    3. 数组切片已分配的存储空间

    1. 基于数组创建切片
    2. 直接创建切片

    // 基于数组创建数组切片
    var mySlice1 int[] = myArray[:5]   // (前5个元素)
    var mySlice2 int[] = myArray[:]   // 基于所有元素创建数组

    // 直接创建数组切片
    var mySlice1 int[] = make([]int, 5)        // 初使元素个数为5, 初始值为0
    var mySlice2 int[] = make([]int, 5, 10)    // 初使元素个数为5, 初始值为10
    mySlice3 := []int{1, 2, 3, 4, 5}      // 创建并初使化包含5个元素的数组切片

    //基于数组切片创建数组切片
    oldSlice := []int{1, 2, 3, 4, 5}
    newSlice := oldSlice[:3]
    newSlice2 := oldSlice[:72]   // 超出部分置0(不能超出cap())

    // 内容复制
    slice1 := []int{1, 2, 3, 4, 5}
    slice2 := []int{1, 2, 3}

    copy(slice1, slice2)    // 只复制slice2的前3个元素到slice1
    copy(slice2, slice1)    // 只复制slice1的前3个元素到slice2的前三个位置

.. literalinclude:: ./codes/slice.go
   :language: go
   :linenos:

动态增减元素:

.. literalinclude:: ./codes/slice2.go
   :language: go
   :linenos:



map数据类型::

    1. 元素声明:
       var myMap map[string] PersonInfo
    2. 创建并初使化map代码如下:                                                                                         
        map[string] PeronsInfo {
            "1234" : PersonInfo{"1", "gordon"}
        } 
    3. 元素赋值:
       mapMyap["key"] = PersonInfo{"12", "gordon"}
    4. 元素删除:
       delete(myMap, "key")   // 如传入的key不存在,则不做任何操作; 如key为nil则抛异常
    5. 元素查找:
       value, ok := myMap["key"]
       if ok {  // 找到了
       } else { // 没找到
       }

.. interalinclude ../codes/map.go
   :languages: go
   :lineons:

流程控制::

    条件语句: if, else, else if
    选择语句: switch, case, select
    循环语句: for, range
    跳转语句: goto

函数::

    1. 函数组成: func, 函数名, 参数列表, 返回值, 函数体, 返回语句
    2. 不定参数: func myfunc(args ...int)
      2.1 不定参数传递:
        func myfunc(args ...int) {
           // 原样传递
           myfunc3(args...)
           // 传递片段
           myfunc3(args[1:]...)
        }

      2.2 任意类型的不定参数
        // 如果你想传任意类型,可指定类型为interface{}
        func Print(format string, args ...interface{}) {
        }

    3. 多返回值(如果对某一值不关心可以使用“_”代替)
    4. 匿名函数:
       f := func(x, y int) int {
          return x+y
       }
       // {}后直接跟参数列表表示函数调用
       func(ch chan int) {
           ch <- ACK
       }(reply_chan)

    5. 闭包:


错误处理::

    1. error接口
    type error interface {
        Error() string
    }
    // 如果要返回error, 将error作为多返回值的最后一个:
    func foo(param int)(n int, error error) {
    }
    // 使用:
    n, err := foo(0)
    if err != nil {  //有错误的情况
    }

    2. defer
       调用遵照先进后出的原则
    3. panic()
       func panic(interface{})
       当一个函数调用panic()时,正常执行流程将立即终止
       之后就会走defer流程

    4. recover()
       func recover() interface{}
       recover()用于终止错误处理流程
       一般会在defer中设定，便于处理panic产生的错误


反射(还需要进行详细了解@todo)::

    t := reflect.TypeOf(i)    //得到类型的元数据,通过t我们能获取类型定义里面的所有元素
    v := reflect.ValueOf(i)   //得到实际的值，通过v我们获取存储在里面的值，还可以去改变值

    tag := t.Elem().Field(0).Tag  //获取定义在struct里面的标签
    name := v.Elem().Field(0).String()  //获取存储在第一个字段里面的值


并发相关::

    ch := make(chan type, value)
    //value == 0 ! 无缓冲（阻塞）
    //value > 0 ! 缓冲（非阻塞，直到value 个元素）

    //技巧: 使用range
    c := make(chan int, 10)
    for i:= range c {
        fmt.Println(i)
    }

    //技巧:使用select, 超时与default(伪代码)
    select {
        case v := <-c:
            println(v)
        case <- time.After(5 * time.Second):
            println("time out")
            o <- true
            break
        default:
            println("default")
    }

    // runtime包几个处理goroutine的函数
    Goexit: 退出当前执行的goroutine，但是defer函数还会继续调用
    Gosched: 让出当前goroutine的执行权限，调度器安排其他等待的任务运行，并在下次某个时候从该位置恢复执行
    NumCPU: 返回 CPU 核数量
    NumGoroutine: 返回正在执行和排队的任务总数
    GOMAXPROCS: 用来设置可以并行计算的CPU核数的最大值，并返回之前的值。





