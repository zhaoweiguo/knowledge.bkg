代码实例
=================

类型与接口::

   type Bird struct {
      ...
   }
   func (b *Bird) Fly() {
   }

   type IFly interface {
      Fly()
   }

   func main() {
      var fly IFly = new(Bird)   // 在这儿定义Bird类具有IFly接口
      fly.Fly()
   }


并发编程
------------
::

    package main
    import "fmt"
    
    func sum(vaules []int, resultChan chan int) {
       sum := 0;
       for _,value := range values {
          sum += value
       }
       result <- sum
    }
    func main() {
        values := [] int{1, 2, 3, 4, 5, 6, 7}
        resultChan := make(chan int, 2)
        go sum(values[:len(values)/2], resultChan)
        go sum(values[len(values)/2:], resultChan)
        sum1, sum2 := <- resultChan, <- resultChan
        fmt.Println("Result:", sum1, sum2, sum1 + sum2)
    }

反射
--------
.. literalinclude:: ./codes/reflect.go
   :language: go
   :linenos:

    
日期相关
-------------
.. literalinclude:: ./codes/utils/date.go
   :language: go
   :linenos:



