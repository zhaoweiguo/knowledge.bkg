.. _ab:

ab命令使用方法
=================

* 使用方法::

    Usage: ./ab [options] [http://]hostname[:port]/path
    Options are:
    -n 请求次数
    -c 请求的并发数
    -t timelimit Seconds to max. wait for responses
    -p post请求的文件(内含post参数)
    -T Content-type header for POSTing:如application/x-www-form-urlencoded
    -v 日志级别.当n>2时，可以显示发送的http请求头和响应的http头的内容。并且，n越大显示的内容会越全，比如，－v4
    -w Print out results in HTML tables
    -i Use HEAD instead of GET
    -x attributes String to insert as table attributes
    -y attributes String to insert as tr attributes
    -z attributes String to insert as td or th attributes
    -C attribute Add cookie, eg. ‘Apache=1234. (repeatable)
    -H attribute Add Arbitrary header line, eg. ‘Accept-Encoding: gzip’
    Inserted after all normal header lines. (repeatable)
    -A attribute Add Basic WWW Authentication, the attributes
    are a colon separated username and password.
    -P attribute Add Basic Proxy Authentication, the attributes
    are a colon separated username and password.
    -X proxy:port Proxyserver and port number to use
    -V Print version number and exit
    -k Use HTTP KeepAlive feature
    -d Do not show percentiles served table.
    -S Do not show confidence estimators and warnings.
    -g filename Output collected data to gnuplot format file.
    -e filename Output CSV file with percentages served
    -h Display usage information (this message)

* 实例(同时处理1000个請求并运行100次index.php)::

    // 最简单实例
    ./ab -c 1000 -n 100 http://blog.programfan.info/index.php
    // post请求实例:以4个并发数请求40个请求
    ab -c 4 -n 40 -v2 -p "post.json" -T "application/x-www-form-urlencoded" "http://zgapi.taojoy.com.cn/3/goods/multibuy2"


