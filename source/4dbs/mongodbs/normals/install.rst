安装
####



安装::

    wget https://repo.mongodb.org/yum/redhat/7/mongodb-org/4.0/x86_64/RPMS/mongodb-org-shell-4.0.10-1.el7.x86_64.rpm
    wget https://repo.mongodb.org/yum/redhat/7/mongodb-org/4.0/x86_64/RPMS/mongodb-org-tools-4.0.10-1.el7.x86_64.rpm
    yum remove mongodb-org-shell-3.6.3-1.el7.x86_64
    yum remove mongodb-org-tools-3.6.3-1.el7.x86_64
    yum localinstall mongodb-org-*
    mongo --version
    /usr/bin/mongo --version




