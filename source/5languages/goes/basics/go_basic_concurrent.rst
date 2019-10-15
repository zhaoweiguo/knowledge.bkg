并发编程
==================
语法::

    go <fun>

管道chan定义::

    ch chan int   // 通道建立（var <chanName> chan <ElementType>）
    ch <- <data>  // 把数据传入管道
    <- ch         // 把管道里的数据传出

    ch := make(chan int)

    // 关闭channel
    close(ch)
    // 判断channel是否已正常关闭
    x, ok := <-ch

select语法::

    select {
        case <- ch:
            //如成功读取管道数据, 则执行
        case ch <- 1:
            // 如成功写入管道, 则执行
        default:
            // default
    }

缓冲机制::

    chs := make(chan int, 1024)

    for i:= range chs {
        fmt.Print("Received:", i)
    }

超时机制::

    timeout := make(chan bool, 1)
    go func() {
        time.Sleep(1e9)   // 等待一秒
        timeout <- true
    }

    select {
        case <- ch:
            // 从ch取得数据
        case <- timeout:
            // 1秒后得到数据
    }

channel的传递::

    type PipeData struct {
        value int
        handle func(int) int
        next chan int
    }

    func handle(queue chan *PipeData) {
        for data := range queue {
            data.next <- data.handler(data.value)
        }
    }


单向channel::

    var ch1 chan int    // 正常chan
    var ch2 chan<- int  // 单写chan
    var ch3 <-chan int  // 单读chan

同步::

    // 同步锁(sync.Mutex读锁, sync.RWMutex写锁)
    var l sync.Mutex

    // 全局唯一性操作
    var once sync.Once
    once.Do(<fun>)


实例:

.. literalinclude ./codes/go.go
