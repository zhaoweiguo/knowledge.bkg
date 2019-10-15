influxd命令
####################

开启认证
-----------

配置文件::

    [http]  
      enabled = true  
      bind-address = ":8086"  
      auth-enabled = true 
      log-enabled = true  
      write-tracing = false  
      pprof-enabled = false  
      https-enabled = false  
      https-certificate = "/etc/ssl/influxdb.pem" 

登录::

    shell> influx -precision rfc3339 
    influx> auth
    username: root
    password: 

    or
    $> influx -username <user> -password <pwd> -precision rfc3339 


