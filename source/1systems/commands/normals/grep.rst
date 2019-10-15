.. _grep:

grep使用方法
==================

grep <字符串>|”<正则表达式>” [文件名]

* 查找对应目录下的所有文件(包括子目录)中的内容::

    grep -R <keyword> <path>

* 使用正则需要加-E::

    grep -E <正则> <文件>


* 取出不含<string>的列表::

    <list> | grep -v <string>







实例::

    // 查询以"Aug 17"开头的内容
    grep "Aug 17.*" <file>





