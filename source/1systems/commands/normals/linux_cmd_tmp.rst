.. _simple:

临时命令
=============

* hostname:

    * 得到当前os的hostname::

        hostname

    * 临时修改hostname::

        hostname <newhostname>

* export <变量名称>. 将变量导出为环境变量,常写变量赋值一同使用,例如::

     export PATH=”$PATH:xxx”

* finger [用户名]
    显示用户信息
* mount | column -t #这样看的更清楚些(主要是看column命令)
* telnet "miku.acm.uiuc.edu" #这个telnet其实是ssh之前时实现远程登录的命令，明碼显示，不安全



