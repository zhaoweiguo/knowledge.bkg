tmp问题
###########

线上问题解决::

    - [ ] time_wait很奇怪的在超过5000后不再增长
        - 查看当前系统下所有连接状态的数：netstat -n | awk '/^tcp/ {++S[$NF]} END {for(a in S) print a, S[a]}'
        - [root@aaa1 ~]# sysctl -a|grep net.ipv4.tcp_tw
        - [root@aaa1 ~]# vim /etc/sysctl.conf





