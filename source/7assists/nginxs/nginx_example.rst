.. _nginx_example:

实例
========

* 主nginx文件 ``nginx.conf`` ::

    user www www;
    worker_processes  1;

    error_log  /var/nginx/log/error.log;
    pid        /var/nginx/run/nginx.pid;

    events {
        worker_connections  1024;
        # multi_accept on;                                                                                                              
    }

    http {
         include       /etc/nginx/mime.types;

         access_log  /var/log/nginx/access.log;

         server_names_hash_bucket_size 128;
         client_header_buffer_size 32k;
         large_client_header_buffers 4 32k;
         client_max_body_size 8m;


         sendfile        on;
         tcp_nopush     on;

         #keepalive_timeout  0;                                                                                                          
         keepalive_timeout  65;
         tcp_nodelay        on;

         fastcgi_connect_timeout 300;
         fastcgi_send_timeout 300;
         fastcgi_read_timeout 300;
         fastcgi_buffer_size 64k;
         fastcgi_buffers 4 64k;
         fastcgi_busy_buffers_size 128k;
         fastcgi_temp_file_write_size 128k;

         gzip  on;
         gzip_min_length 1k;
         gzip_buffers 4 16k;
         gzip_http_version 1.0;
         gzip_comp_level 2;
         gzip_types text/plain application/x-javascript text/css application/xml;
         gzip_vary on;

         #gzip_disable "MSIE [1-6]\.(?!.*SV1)";                                                                                          

         include /etc/nginx/conf.d/*.conf;
         include /etc/nginx/sites-enabled/*;
    }


* 重定向::

    server {
        listen       80;
        server_name  game.programfan.info;

        location / {
            proxy_pass http://199.83.92.190:9001;
        }
        # redirect server error pages to the static page /50x.html                                                                  
        #                                                                                                                           
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        log_format game '$remote_addr - $remote_user [$time_local]"$request" '
              '$status $body_bytes_sent "$http_refer" '
              '"$http_user_agent" $http_x_forwarded_for'
        access_log /etc/nginx/log/game.log game;

    }

* php-fpm实例::

    server {
        listen      80;
        server_name bbs.programfan.info;
        index index.html index.htm index.php;
        root /var/www/bbs.programfan.info;

        location ~ .*\.(php|php5)?$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            include fcgi.conf;
        }

        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$ {
            expires 30d;
        }

        location ~ .*\.(js|css)?$ {
            expires 1h;
        }

        log_format bbs '$remote_addr - $remote_user [$time_local]"$request" '
                  '$status $body_bytes_sent "$http_refer" '
                  '"$http_user_agent" $http_x_forwarded_for'
        access_log /etc/nginx/log/bbs.log bbs;
    }

* fcgi.conf::

        fastcgi_param   GATEWAY_INTERFACE   CGI/1.1;
        fastcgi_param   SERVER_SOFTWARE     nginx;

        fastcgi_param   QUERY_STRING        $query_string;
        fastcgi_param   REQUEST_METHOD      $request_method;
        fastcgi_param   CONTENT_TYPE        $content_type;
        fastcgi_param   CONTENT_LENGTH      $content_length;

        fastcgi_param   SCRIPT_FILENAME     $document_root$fastcgi_script_name;
        fastcgi_param   SCRIPT_NAME     $fastcgi_script_name;

        fastcgi_param   REQUEST_URI     $request_uri;
        fastcgi_param   DOCUMENT_URI        $document_uri;
        fastcgi_param   DOCUMENT_ROOT       $document_root;
        fastcgi_param   SERVER_PROTOCOL     $server_protocol;

        fastcgi_param   REMOTE_ADDR     $remote_addr;
        fastcgi_param   REMOTE_PORT     $remote_port;
        fastcgi_param   SERVER_ADDR     $server_addr;
        fastcgi_param   SERVER_PORT     $server_port;
        fastcgi_param   SERVER_NAME     $server_name;

        fastcgi_param   REDIRECT_STATUS     200;


* 所有 ``*.zhaoweiguo.com`` 转向到 ``*.programfan.info``::

    server {
        listen          80;
        server_name     *.zhaoweiguo.com;

        location / {
            resolver 8.8.8.8;  #注意这儿
            client_max_body_size 5m;
            if ( $host ~ (.*).zhaoweiguo.com ) {
                set $secondhost $1;
                proxy_pass http://$secondhost.programfan.info;
            }
        }
    }



在nginx日志中显示post的请求参数::

    log_format access '$remote_addr - $remote_user [$time_local] \
        "$request" $status $body_bytes_sent $request_body \
        "$http_referer" "$http_user_agent" $http_x_forwarded_for';
    access_log logs/test.access.log access;




