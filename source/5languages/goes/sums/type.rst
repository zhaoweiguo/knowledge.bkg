类型
####

基础类型
========

基础类型有下面几种::

    bool byte complex64 complex128 error float32 float64
    int int8 int16 int32 int64 rune string
    uint uint8 uint16 uint32 uint64 uintptr

自定义类型
==========

type 关键字::
    
    type IZ int

类型别名::

    type IZ = int
    // 类型别名在1.9中实现，可将别名类型和原类型这两个类型视为完全一致使用

自定义类型不会继承原有类型的方法，但接口方法或组合类型的内嵌元素则保留原有的方法::


    //  Mutex 用两种方法，Lock and Unlock。
    type Mutex struct         { /* Mutex fields */ }
    func (m *Mutex) Lock()    { /* Lock implementation */ }
    func (m *Mutex) Unlock()  { /* Unlock implementation */ }

    1. NewMutex和 Mutex 一样的数据结构，但是其方法是空的。
    type NewMutex Mutex

    2. PtrMutex 的方法也是空的
    type PtrMutex *Mutex

    3. *PrintableMutex 拥有Lock and Unlock 方法
    type PrintableMutex struct {
        Mutex
    }







