.. _tmp_linux:

linux
======


Linux 自检和 SystemTap 用于动态内核分析的接口和语言::

    $ sudo apt-get install systemtap

在安装完成之后，您可以测试内核看它是否支持 SystemTap。为此，使用以下简单的命令行脚本::

    $ sudo stap -ve 'probe begin { log("hello world") exit() }'


如果该脚本能够正常运行，您将在标准输出 [stdout] 中看到 “hello world”。如果没有看到这两个单词，则还需要其他工作。


把它设小linux就不倾向使用swap 反之则用swap. 最后推荐设为10::

    /proc/sys/vm/swappiness


    

