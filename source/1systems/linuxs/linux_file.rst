.. _os_linux:

linux相关
============

.. toctree::
   :maxdepth: 2

   linux_files/linux_normal
   linux_files/linux_sudo
   linux_files/linux_init.d


bash的几个初始化文件::

    /etc/profile
    /ect/bashrc(主要修改对象)
    ~/.profile
    ~/.bash_login
    ~/.bash_profile(主要修改对象)
    ~/.bashrc
    ~/.bash_logout


bash如何更改环境变量PATH的值::

    ~/.bash_profile
    ~/.bashrc

zsh如何更改环境变量PATH的值::

    ~/.zprofile
    ~/.zshrc

字符目录::

    Locale是根据计算机用户所使用的语言，所在国家或者地区，以及当地的文化传统所定义的一个软件运行时的语言环境
    /usr/share/i18n/locales/
    /usr/share/i18n/charmaps/    字符集

path路径::

    /etc/profile
    %or
    ~/.bash_profile
    %添加如下命令
    PATH=/sbin:$PATH





