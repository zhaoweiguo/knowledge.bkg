简单命令
===============
::

    args := os.Args   //命令行参数数组
    len(args)   // 测试指定数组长度


    v, error := strconv.Atoi(args[0])   // 把第一个参数转化为int


fmt打印格式::

    %T: 变量类型
    %t: boole类型
    %d: int类型
    %s: string类型
    %b: 二进制类型
    %c: unicode码点值
    %v: 使用默认格式的内置或者自定义类型的值, 或者是此类型的String()输出




