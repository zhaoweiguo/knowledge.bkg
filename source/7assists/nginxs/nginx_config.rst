.. _nginx_config:

配置简介
############

HTTP配置
-----------
``ngx_http_core_module`` 模块支持内置变量

* ``$http_user_agent``, ``$http_cookie``
* ``$args`` 請求行上的参数
* ``$content_length`` 等于請求头的"Content-Length", ``$content_type`` 为"Content-Type", ``$document_root`` 为当前請求的指令根
* ``document_uri`` 等于 $uri
* ``$host`` 
* ``$limit_rate`` 限定的连接比例
* ``$request_method``, ``$remote_addr``, ``$remote_port``
* ``$remote_user``: 由 ``ngx_http_auth_basic_module`` 认证
* ``$request_filename``, ``$request_body_file``, ``$request_uri``
* ``$query_string``, 同 ``$args``
* ``scheme``: http or https
* ``$server_protocol``: "HTTP/1.0", "HTTP/1.1"
* ``$server_addr``
* ``$server_name``, ``$server_port``, ``$uri``


HTTP选项
-----------
::

    ......
    fastcgi_connect_timeout 300;
    fastcgi_send_timeout 300;
    fastcgi_read_timeout 300;
    ......
    fastcgi_buffer_size 128k;
    fastcgi_buffers 8 128k;

    proxy_buffer_size 128k;
    proxy_buffers   32 32k;
    proxy_busy_buffers_size 128k;

    client_header_buffer_size(默认1k)
    large_client_header_buffers(默认4k)

    client_max_body_size

    [php.ini]post_max_size = 8M
    [php.ini]upload_max_filesize = 2M






文件实例
==================


.. literalinclude:: /files/nginx_config_full.conf
    :language: nginx
    :emphasize-lines: 12,15-18
    :linenos:


.. literalinclude:: /files/nginx_config_server_full.conf
    :language: nginx
    :emphasize-lines: 12,15-18
    :linenos:





具体实例
=================

主配置文件
-------------

.. literalinclude:: /files/nginx_config_nginx.conf
    :language: nginx
    :emphasize-lines: 12,15-18
    :linenos:

默认的配置文件
---------------------

.. literalinclude:: /files/nginx_config_default.conf
    :language: nginx
    :emphasize-lines: 2,4-5
    :linenos:

PHP对应的配置文件
---------------------

.. literalinclude:: /files/nginx_config_php.conf
    :language: nginx
    :emphasize-lines: 12,15-18
    :linenos:

PHP对应的包含文件fastcgi_params
------------------------------------

.. literalinclude:: /files/nginx_config_fastcgi_params
    :language: nginx
    :emphasize-lines: 12,15-18
    :linenos:


mobapi(ssl相关)
------------------------------------

.. literalinclude:: /files/nginx_config_mobapi.conf
    :language: nginx
    :emphasize-lines: 12,15-18
    :linenos:




