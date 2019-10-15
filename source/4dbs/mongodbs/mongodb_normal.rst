mongo基本
=============

官网: https://www.mongodb.com/

说明::

  当前最新版本4.x
  公司使用版本3.6.3，测试版3.6.5
  3.x最新版本3.7.9


MongoDB Atlas::

  a cloud-hosted service for provisioning, running, monitoring, and maintaining MongoDB deployments.


::

  The maximum BSON document size is 16 megabytes.


Data Directories and Permissions::

  数据存储: /var/lib/mongo        对应配置:storage.dbPath
  日志文件: /var/log/mongodb      对应配置:systemLog.path
  配置文件: /etc/mongod.conf

Mongod的启动
------------------
mongo的启动与关闭::

    // 启动
    mongod
    //关闭
    kill -2 <pid>    # SIGINT
    or
    kill <pid>  #SIGTERM


mongod启动的选项::


  --dbpath
  指定数据目录, 默认是 ``/data/db/`` (windows下是 ``C:\data\db``)

  --port
  指定服务器端口, 默认端口是27017

  --fork
  以保护进程的方式运行MongoDB, 创建服务器进程

  --logpath
  指定日志输出路径,而不是输出到命令行(想保留原来日志,还需要使用 ``--logappend`` )

  --config
   指定配置文件,加载命令行未指定的各种选项


实例::

  mongodb --port 5586 --fork --logpath mongodb.log

  //通过配置文件配置:
  linux> mongodb --config ~/mongodb.conf
  linux> vi ~/mongodb.conf
  port = 5586
  fork = true

  logpath = mongodb.log


安装::

    wget https://repo.mongodb.org/yum/redhat/7/mongodb-org/4.0/x86_64/RPMS/mongodb-org-shell-4.0.10-1.el7.x86_64.rpm
    wget https://repo.mongodb.org/yum/redhat/7/mongodb-org/4.0/x86_64/RPMS/mongodb-org-tools-4.0.10-1.el7.x86_64.rpm
    yum remove mongodb-org-shell-3.6.3-1.el7.x86_64
    yum remove mongodb-org-tools-3.6.3-1.el7.x86_64
    yum localinstall mongodb-org-*
    mongo --version
    /usr/bin/mongo --version






