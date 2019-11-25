类型 [1]_
#########

常用类型::

    Boolean types
    String types
    Array types
    Slice types
    Struct types
    Pointer types
    Function types
    Interface types
    Map types
    Channel types
    Numeric types

Numeric types::

    uint8       the set of all unsigned  8-bit integers (0 to 255)
    uint16      the set of all unsigned 16-bit integers (0 to 65535)
    uint32      the set of all unsigned 32-bit integers (0 to 4294967295)
    uint64      the set of all unsigned 64-bit integers (0 to 18446744073709551615)

    int8        the set of all signed  8-bit integers (-128 to 127)
    int16       the set of all signed 16-bit integers (-32768 to 32767)
    int32       the set of all signed 32-bit integers (-2147483648 to 2147483647)
    int64       the set of all signed 64-bit integers (-9223372036854775808 to 9223372036854775807)

    float32     the set of all IEEE-754 32-bit floating-point numbers
    float64     the set of all IEEE-754 64-bit floating-point numbers

    complex64   the set of all complex numbers with float32 real and imaginary parts
    complex128  the set of all complex numbers with float64 real and imaginary parts

    byte        alias for uint8
    rune        alias for int32

    uint     either 32 or 64 bits
    int      same size as uint
    uintptr  an unsigned integer large enough to store the uninterpreted bits of a pointer value

算数相关::

    x     x / 4     x % 4     x >> 2     x & 3
     11      2         3         2          3
    -11     -2        -3        -3          1

运算操作::

    ==    equal
    !=    not equal
    <     less
    <=    less or equal
    >     greater
    >=    greater or equal


Iota::

    const (
      c0 = iota  // c0 == 0
      c1 = iota  // c1 == 1
      c2 = iota  // c2 == 2
    )

    const (
      a = 1 << iota  // a == 1  (iota == 0)
      b = 1 << iota  // b == 2  (iota == 1)
      c = 3          // c == 3  (iota == 2, unused)
      d = 1 << iota  // d == 8  (iota == 3)
    )

    const (
      u         = iota * 42  // u == 0     (untyped integer constant)
      v float64 = iota * 42  // v == 42.0  (float64 constant)
      w         = iota * 42  // w == 84    (untyped integer constant)
    )

    const x = iota  // x == 0
    const y = iota  // y == 0

    const (
      bit0, mask0 = 1 << iota, 1<<iota - 1  // bit0 == 1, mask0 == 0  (iota == 0)
      bit1, mask1                           // bit1 == 2, mask1 == 1  (iota == 1)
      _, _                                  //                        (iota == 2, unused)
      bit3, mask3                           // bit3 == 8, mask3 == 7  (iota == 3)
    )

类型转换
========

::

    *Point(p)        // same as *(Point(p))
    (*Point)(p)      // p is converted to *Point
    <-chan int(c)    // same as <-(chan int(c))
    (<-chan int)(c)  // c is converted to <-chan int
    func()(x)        // function signature func() x
    (func())(x)      // x is converted to func()
    (func() int)(x)  // x is converted to func() int
    func() int(x)    // x is converted to func() int (unambiguous)

常量转化会产生一个类型化的常量::

    uint(iota)               // iota value of type uint
    float32(2.718281828)     // 2.718281828 of type float32
    complex128(1)            // 1.0 + 0.0i of type complex128
    float32(0.49999999)      // 0.5 of type float32
    float64(-1e-1000)        // 0.0 of type float64
    string('x')              // "x" of type string
    string(0x266c)           // "♬" of type string
    MyString("foo" + "bar")  // "foobar" of type MyString
    string([]byte{'a'})      // not a constant: []byte{'a'} is not a constant
    (*int)(nil)              // not a constant: nil is not a constant, *int is not a boolean, numeric, or string type
    int(1.2)                 // illegal: 1.2 cannot be represented as an int
    string(65.0)             // illegal: 65.0 is not an integer constant

字符串相关转换::

    1. 有效unicode会转化成串, 无效unicode会转化为\uFFFD
    string('a')       // "a"
    string(-1)        // "\ufffd" == "\xef\xbf\xbd"
    string(0xf8)      // "\u00f8" == "ø" == "\xc3\xb8"
    type MyString string
    MyString(0x65e5)  // "\u65e5" == "日" == "\xe6\x97\xa5"

    2. []byte -> string
    string([]byte{'h', 'e', 'l', 'l', '\xc3', '\xb8'})   // "hellø"
    string([]byte{})                                     // ""
    string([]byte(nil))                                  // ""
    type MyBytes []byte
    string(MyBytes{'h', 'e', 'l', 'l', '\xc3', '\xb8'})  // "hellø"

    3. []runes -> string
    string([]rune{0x767d, 0x9d6c, 0x7fd4})   // "\u767d\u9d6c\u7fd4" == "白鵬翔"
    string([]rune{})                         // ""
    string([]rune(nil))                      // ""

    type MyRunes []rune
    string(MyRunes{0x767d, 0x9d6c, 0x7fd4})  // "\u767d\u9d6c\u7fd4" == "白鵬翔"

    4. string -> []byte
    []byte("hellø")   // []byte{'h', 'e', 'l', 'l', '\xc3', '\xb8'}
    []byte("")        // []byte{}
    MyBytes("hellø")  // []byte{'h', 'e', 'l', 'l', '\xc3', '\xb8'}

    5. string -> []runes
    []rune(MyString("白鵬翔"))  // []rune{0x767d, 0x9d6c, 0x7fd4}
    []rune("")                 // []rune{}
    MyRunes("白鵬翔")           // []rune{0x767d, 0x9d6c, 0x7fd4}

常数表达式(自动格式转换)::

    const a = 2 + 3.0          // a == 5.0   (untyped floating-point constant)
    const b = 15 / 4           // b == 3     (untyped integer constant)
    const c = 15 / 4.0         // c == 3.75  (untyped floating-point constant)
    const Θ float64 = 3/2      // Θ == 1.0   (type float64, 3/2 is integer division)
    const Π float64 = 3/2.     // Π == 1.5   (type float64, 3/2. is float division)
    const d = 1 << 3.0         // d == 8     (untyped integer constant)
    const e = 1.0 << 3         // e == 8     (untyped integer constant)
    const f = int32(1) << 33   // illegal    (constant 8589934592 overflows int32)
    const g = float64(2) >> 1  // illegal    (float64(2) is a typed floating-point constant)
    const h = "foo" > "bar"    // h == true  (untyped boolean constant)
    const j = true             // j == true  (untyped boolean constant)
    const k = 'w' + 1          // k == 'x'   (untyped rune constant)
    const l = "hi"             // l == "hi"  (untyped string constant)
    const m = string(k)        // m == "x"   (type string)
    const Σ = 1 - 0.707i       //            (untyped complex constant)
    const Δ = Σ + 2.0e-4       //            (untyped complex constant)
    const Φ = iota*1i - 1/1i   //            (untyped complex constant)

语句
====

Terminating statements::

    return
    goto
    panic
    以及正常结束

Empty statements::

    The empty statement does nothing.

Labeled statements::

    A labeled statement may be the target of a goto, break or continue statement.

Expression statements::

    h(x+y)
    f.Close()
    <-ch
    (<-ch)
    len("foo")  // illegal if len is the built-in function







.. [1] https://golang.org/ref/spec