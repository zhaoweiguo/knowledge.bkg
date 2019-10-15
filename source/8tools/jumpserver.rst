JumpServer
###################

文档 [1]_
github [2]_


::

    启动脚本：/opt/jumpserver-0.3.1/service.sh
    网站界面：/opt/jumpserver-0.3.1/templates
    css、js：/opt/jumpserver-0.3.1/static


管理用户::

    是资产（被控服务器）上的root，或拥有 NOPASSWD: ALL sudo权限的用户
    Jumpserver使用该用户来 推送系统用户、获取资产硬件信息 等。
    暂不支持 Windows或其它硬件， 可以随意设置一个

系统用户::

    是 Jumpserver跳转登录资产时使用的用户，可以理解为登录资产用户，如 web, sa, dba(ssh web@some-host), 
    而不是使用某个用户的用户名跳转登录服务器(ssh xiaoming@some-host); 
    简单来说是 用户使用自己的用户名登录Jumpserver, Jumpserver使用系统用户登录资产。
    
    系统用户创建时，如果选择了自动推送 Jumpserver会使用ansible自动推送系统用户到资产中，
    如果资产(交换机、windows)不支持ansible, 请手动填写账号密码。目前还不支持Windows的自动推送





.. [1] http://docs.jumpserver.org/zh/docs/index.html
.. [2] https://github.com/jumpserver/jumpserver




