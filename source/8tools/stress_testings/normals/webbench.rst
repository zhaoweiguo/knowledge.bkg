.. _webbench:

webbench的使用
================

* 安装::

    tar zxvf webbench-<version>.tar.gz
    cd webbench-<version>
    make && make install

* 用法::

    webbench -c 并发数 -t 运行时间 <URL>

* 实例::

    webbench -c 5000 -t 120 http://bbs.programfan.info




