.. _prottocol_ftp:

FTP协议
=============

1xx-肯定的初步答复
----------------------

这些状态代码指示一项操作已经成功开始，但客户端希望在继续操作新命令前得到另一个答复。

    * 110重新启动标记答复。
    * 120服务已就绪，在nnn分钟后开始。
    * 125数据连接已打开，正在开始传输。
    * 150文件状态正常，准备打开数据连接。

2xx-肯定的完成答复
--------------------

一项操作已经成功完成。客户端可以执行新命令。

    * 200命令确定。
    * 202未执行命令，站点上的命令过多。
    * 211系统状态，或系统帮助答复。
    * 212目录状态。
    * 213文件状态。
    * 214帮助消息。
    * 215NAME系统类型，其中，NAME是AssignedNumbers文档中所列的正式系统名称。
    * 220服务就绪，可以执行新用户的请求。
    * 221服务关闭控制连接。如果适当，请注销。
    * 225数据连接打开，没有进行中的传输。
    * 226关闭数据连接。请求的文件操作已成功（例如，传输文件或放弃文件）。
    * 227进入被动模式(h1,h2,h3,h4,p1,p2)。
    * 230用户已登录，继续进行。
    * 250请求的文件操作正确，已完成。
    * 257已创建“PATHNAME”

3xx-肯定的中间答复
-----------------------
该命令已成功，但服务器需要更多来自客户端的信息以完成对请求的处理。331用户名正确，需要密码。

    * 332需要登录帐户
    * 350请求的文件操作正在等待进一步的信息

4xx-瞬态否定的完成答复
--------------------------

该命令不成功，但错误是暂时的。如果客户端重试命令，可能会执行成功。421服务不可用，正在关闭控制连接。如果服务确定它必须关闭，将向任何命令发送这一应答。

    * 425无法打开数据连接。
    * 426Connectionclosed;transferaborted.
    * 450未执行请求的文件操作。文件不可用（例如，文件繁忙）。
    * 451请求的操作异常终止：正在处理本地错误。
    * 452未执行请求的操作。系统存储空间不够

5xx-永久性否定的完成答复
-------------------------------

该命令不成功，错误是永久性的。如果客户端重试命令，将再次出现同样的错误。500语法错误，命令无法识别。这可能包括诸如命令行太长之类的错误。

    * 501在参数中有语法错误
    * 502未执行命令
    * 503错误的命令序列
    * 504未执行该参数的命令
    * 530未登录
    * 532存储文件需要帐户
    * 550未执行请求的操作。文件不可用（例如，未找到文件，没有访问权限)
    * 551请求的操作异常终止：未知的页面类型
    * 552请求的文件操作异常终止：超出存储分配（对于当前目录或数据集)
    * 553未执行请求的操作。不允许的文件名。

常见的FTP状态代码及其原因
--------------------------------


    * 150-FTP使用两个端口：21用于发送命令，20用于发送数据。状态代码150表示服务器准备在端口20上打开新连接，发送一些数据
    * 226-命令在端口20上打开数据连接以执行操作，如传输文件。该操作成功完成，数据连接已关闭。
    * 230-客户端发送正确的密码后，显示该状态代码。它表示用户已成功登录
    * 331-客户端发送用户名后，显示该状态代码。无论所提供的用户名是否为系统中的有效帐户，都将显示该状态代码。
    * 426-命令打开数据连接以执行操作，但该操作已被取消，数据连接已关闭
    * 530-该状态代码表示用户无法登录，因为用户名和密码组合无效。如果使用某个用户帐户登录，可能键入错误的用户名或密码，也可能选择只允许匿名访问。如果使用匿名帐户登录，IIS的配置可能拒绝匿名访问
    * 550-命令未被执行，因为指定的文件不可用。例如，要GET的文件并不存在，或试图将文件PUT到您没有写入权限的目录
