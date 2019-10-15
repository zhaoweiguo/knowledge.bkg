常用
#########


介绍::

    Alpine Linux is a security-oriented, lightweight Linux distribution 
        based on musl libc and busybox. 
    The Alpine image is only 5MB in size, making it a popular image base.


安装软件::

    $ apk --help
    $ apk update
    $ apk list
    $ apk search xxx
    $ apk add zip

    update命令会从各个镜像源列表下载APKINDEX.tar.gz并存储到本地缓存
    一般在/var/cache/apk/(Alpine在该目录下)、 /var/lib/apk/ 、/etc/apk/cache/下

常用软件安装::

    $ apk add zip curl openssl

增加国内源::

    $ echo "https://mirror.tuna.tsinghua.edu.cn/alpine/v3.4/main" > /etc/apk/repositories



