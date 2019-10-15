.. _siege:

siege命令的使用方法
=====================


* 官网:

    `siege官网 <http://www.joedog.org>`_

* 下载:

    源码安装

* 使用::

    siege -c 200 -r 10 -f example.url

* 参数说明:

    * -c: 并发量
    * -r: 重复次数
    * -f: 指定文件
    * example.url文件内容::

        http://bbs.programfan.info
        http://blog.programfan.info
        http://www.programfan.info

    * 每行都是一个url，它会从中随机选一个访问

* 結果说明::

    Lifting the server siege… done.
    Transactions: 3419263 hits //完成419263次处理
    Availability: 100.00 % //100.00 % 成功率
    Elapsed time: 5999.69 secs //总共用时
    Data transferred: 84273.91 MB //共数据传输84273.91 MB
    Response time: 0.37 secs //相应用时1.65秒：显示网络连接的速度
    Transaction rate: 569.91 trans/sec //均每秒完成 569.91 次处理：表示服务器后
    Throughput: 14.05 MB/sec //平均每秒传送数据
    Concurrency: 213.42 //实际最高并发数
    Successful transactions: 2564081 //成功处理次数
    Failed transactions: 11 //失败处理次数
    Longest transaction: 29.04 //每次传输所花最长时间
    Shortest transaction: 0.00 //每次传输所花最短时间





