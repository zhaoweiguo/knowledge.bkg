基本
####


MongoDB Atlas::

  a cloud-hosted service for provisioning, running, monitoring, and maintaining MongoDB deployments.


::

  The maximum BSON document size is 16 megabytes.


Data Directories and Permissions::

  数据存储: /var/lib/mongo        对应配置:storage.dbPath
  日志文件: /var/log/mongodb      对应配置:systemLog.path
  配置文件: /etc/mongod.conf


常用知识
========

_id 字段其值为一个 12 字节的 ObjectId 类型::

    ObjectId = 4 个字节的 unix 时间戳 + 3 个字节的机器信息 + 2 个字节的进程 id + 3 个字节的自增随机数

    实例:
    5b72c9169db571c8ab7ee374
    前4个字节为: 5b72c916
    16进制转10进制后为: 1,534,249,238
    timestamp转为日期为: 2018/8/14 20:20:38





