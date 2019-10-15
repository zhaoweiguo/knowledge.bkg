VMware
############




Installing VMware Tools::

    通过VMware菜单,点击Virtual Machine -> Install VMware Tools
    $ mkdir /mnt/cdrom
    $ mount /dev/cdrom /mnt/cdrom
    $ cp /mnt/cdrom/VMwareTools-<version>.tar.gz /tmp/
    $ cd /tmp
    $ tar -zxvf VMwareTools-version.tar.gz
    $ cd vmware-tools-distrib
    $ ./vmware-install.pl

    注: 无界面的好像安装上也没用


常见问题
==============

NAT方式可联网，Birdged方式不可联网::

    1. 可能主机的网络需要身份验证






