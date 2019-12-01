mac相关
#######

dyld: malformed mach-o image: segment __DWARF has vmsize < filesize
===================================================================

说明::

    升级到Catalina 10.15后，golang编译完成后，执行二进制文件报错：
    dyld: malformed mach-o image: segment __DWARF has vmsize < filesize

解决::

    升级到1.13.4后问题被修复


