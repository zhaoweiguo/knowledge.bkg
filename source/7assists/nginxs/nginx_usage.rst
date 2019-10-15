.. _nginx_usage2:

nginx完全使用说明
=======================


* 安装(增加参数 ``--with-http_stub_status_module`` 是为了启用 nginx 的 NginxStatus 功能，用来监控 Nginx 的当前状态)::

    ./configure --with-http_stub_status_module 

nginx配置::

         location /nginx_status {
                stub_status on;
                access_log off;
                allow 127.0.0.1;
                deny all;
            }

结果显示::

    active connections – 当前 Nginx 正处理的活动连接数。
    serveraccepts handled requests — 总共处理了 233851 个连接 , 成功创建 233851 次握手 (证明中间没有失败的 ), 总共处理了 687942 个请求 ( 平均每次握手处理了 2.94 个数据请求 )。
    reading — nginx 读取到客户端的 Header 信息数。
    writing — nginx 返回给客户端的 Header 信息数。
    waiting — 开启 keep-alive 的情况下，这个值等于 active – (reading + writing)， 意思就是 Nginx 已经处理完正在等候下一次请求指令的驻留连接。




常用的Nginx参数与控制
------------------------

* 程序运行参数::

    nginx - t - c conf/nginx2.conf

* 通过信号对 Nginx 进行控制::

    TERM, INT       快速关闭程序，中止当前正在处理的请求
    QUIT       处理完当前请求后，关闭程序
    HUP         重新加载配置，并开启新的工作进程，关闭就的进程，此操作不会中断请求
    USR1         重新打开日志文件，用于切换日志，例如每天生成一个新的日志文件
    USR2          平滑升级可执行程序
    WINCH          从容关闭工作进程

两种方式::

    kill -HUP `cat /var/nginx/run/nginx.pid`
    killall - s HUP nginx

配置Nginx:
------------
* 避免直接ip访问web::

    server {
           listen 80 default_server;
           server_name _;
           return 444;
    }

* 实例::

         user  nobody;# 工作进程的属主
         worker_processes  4;# 工作进程数，一般与 CPU 核数等同

         #error_log  logs/error.log; 
         #error_log  logs/error.log  notice; 
         #error_log  logs/error.log  info; 

         #pid        logs/nginx.pid; 

         events { 
            use epoll;#Linux 下性能最好的 event 模式
            worker_connections  2048;# 每个工作进程允许最大的同时连接数
         } 

         http { 
            include       mime.types; 
            default_type  application/octet-stream; 

            #log_format  main  '$remote_addr - $remote_user [$time_local] $request ' 
            #                  '"$status" $body_bytes_sent "$http_referer" ' 
            #                  '"$http_user_agent" "$http_x_forwarded_for"'; 

            #access_log  off; 
            access_log  logs/access.log;# 日志文件名

            sendfile        on; 
            #tcp_nopush     on; 
            tcp_nodelay     on; 

            keepalive_timeout  65; 

            include             gzip.conf; 
            
            # 集群中的所有后台服务器的配置信息
            upstream tomcats { 
               server 192.168.0.11:8080 weight=10; 
               server 192.168.0.11:8081 weight=10; 
               server 192.168.0.12:8080 weight=10; 
               server 192.168.0.12:8081 weight=10; 
               server 192.168.0.13:8080 weight=10; 
               server 192.168.0.13:8081 weight=10; 
            } 

            server { 
                listen       80;#HTTP 的端口
                server_name  localhost; 

                charset utf-8; 

                #access_log  logs/host.access.log  main; 

                location ~ ^/NginxStatus/ { 
                    stub_status on; #Nginx 状态监控配置
                    access_log off; 
                } 

                location ~ ^/(WEB-INF)/ { 
                    deny all; 
                 }       

                 location ~ \.(htm|html|asp|php|gif|jpg|jpeg|png|bmp|ico|rar|css|js|
                      zip|java|jar|txt|flv|swf|mid|doc|ppt|xls|pdf|txt|mp3|wma)$ { 
                     root /opt/webapp; 
                     expires 24h; 
                } 

                location / { 
                    proxy_pass http://tomcats;# 反向代理
                    include proxy.conf; 
                } 

                error_page 404 /html/404.html; 

                # redirect server error pages to the static page /50x.html 
                # 
                error_page 502 503 /html/502.html; 
                error_page 500 504 /50x.html; 
                location = /50x.html { 
                    root   html; 
                } 
            } 
         } 

Nginx 监控
-----------------

上述配置中，首先我们定义了一个 ``location ~ ^/NginxStatus/`` ,这样通过 http://localhost/NginxStatus/ 就可以监控到 Nginx 的运行信息，显示的内容如下::

    Active connections: 70     
    server accepts handled requests
     14553819 14553819 19239266 
    Reading: 0 Writing: 3 Waiting: 67 

NginxStatus 显示的内容意思如下:

    * active connections – 当前 Nginx 正处理的活动连接数
    * server accepts handled requests -- 总共处理了 14553819 个连接 , 成功创建 14553819 次握手 ( 证明中间没有失败的 ), 总共处理了 19239266 个请求 ( 平均每次握手处理了 1.3 个数据请求 )
    * reading -- nginx 读取到客户端的 Header 信息数。
    * writing -- nginx 返回给客户端的 Header 信息数。
    * waiting -- 开启 keep-alive 的情况下，这个值等于 active - (reading + writing)，意思就是 Nginx 已经处理完正在等候下一次请求指令的驻留连接。


静态文件处理
---------------------

    *  images 路径下的所有请求可以写为::

        location ~ ^/images/ {
            root /opt/webapp/images;
        }

    * 几种文件类型的请求处理方式::

        location ~ \.(htm|html|gif|jpg|jpeg|png|bmp|ico|css|js|txt)$ {
            root /opt/webapp;
            expires 24h;
        }

    * expires 指令可以控制 HTTP 应答中的“ Expires ”和“ Cache-Control ”的头标（起到控制页面缓存的作用）。您可以使用例如以下的格式来书写 Expires::

        expires 1 January, 1970, 00:00:01 GMT;
        expires 60s;
        expires 30m;
        expires 24h;
        expires 1d;
        expires max;
        expires off;

动态页面请求处理
----------------------

* 反向代理将请求发送到后端的服务器::

      location / {
         proxy_pass        http://localhost:8080;
         proxy_set_header  X-Real-IP  $remote_addr;
      }

* Nginx 通过 upstream 指令来定义一个服务器的集群，最前面那个完整的例子中我们定义了一个名为 tomcats 的集群，这个集群中包括了三台服务器共 6 个 Tomcat 服务。而 proxy_pass 指令的写法变成了::

       location / {
           proxy_pass        http://tomcats;
           proxy_set_header  X-Real-IP  $remote_addr;
       }


Nginx调试
-------------

* 编译时使用选项 ``./configure --with-debug`` 


Nginx加密
------------
::

  auth_basic "Authorized users only";
  auth_basic_user_file /usr/local/nginx/conf/auth.conf
  //auth_basic_user_file 为htpasswd文件的路径

  //密码文件使用如下命令:
  /usr/bin/htpasswd –c /path/pwdfile <username>

  补充一下，如果你使用了集群环境，那么还需要加Proxy_Pass:
  location /admin/ {
        proxy_pass http://cluster/mgmt/;
        auth_basic "QuanLei Auth.";
        auth_basic_user_file /usr/local/ngnix/conf/authdb;
  }

