Apache JMeter
======================

网站:

* https://github.com/apache/jmeter
* http://jmeter.apache.org


支持格式::

  Web - HTTP, HTTPS (Java, NodeJS, PHP, ASP.NET,...)
  SOAP / REST Webservices
  FTP
  Database via JDBC
  LDAP
  Message-oriented Middleware (MOM) via JMS
  Mail - SMTP(S), POP3(S) and IMAP(S)
  Native commands or shell scripts
  TCP
  Java Objects

与Tsung对比::

  1、压力生成原理对比
   Jmeter采用多线程的方式来设置并发度,对CPU和内存的消耗比较大
   tsung采用面向高并发的erlang语言开发的，轻量级的进程方式，在并发方面有天然优势
  2、多client的压力器支持
      都可以进行分布式的部署多个压力器，来承担大并发的压力，当然应对大并发首先需要先对系统做调优，如tcp/ip的相关参数、文件句柄等
      Jmeter不支持按照不同的机器的能力进行分担，所以压力器承担的压力是一样的；
      Tsung可以分配权重。
  3、对linux服务器资源的监控支持
      tsung，可以对远程机器用erlang或者SNMP协议监控CPU、网络、内存，并生成相应的图表
      jmeter， 需要用户自己开发监控程序
  4、测试报告的生成
     JMeter由于内存的限制，对于长时间生成的大数据文件加载解析时，效率要差一些要注意防止OOM,以及卡死的问题
           对图标的生成的支持不全面，目前只看到响应时间，其他的类似tps是表格，曲线图不太清晰
     Tsung在压力测试完成后，可用单独命令生成Html报告，报告比较全面
  5、对压力脚本的支持
     都支持脚本配置和脚本录制
     tsung对脚本录制非常方便，并且支持手动修改，脚本格式和loadrunner是一样的。
     jmeter支持对脚本的录制，但是对脚本的手工修改支持的不好，格式比较乱，难以手工修改。
           业界一般用Badboy进行录制，再转为JMeter脚本

  6、对测试数据的支持
     都支持csv和数据库作为压力测试的数据源
     需要嵌入自己的代码，动态生成数据，签名？？？？

  7、UI界面支持

      jmeter支持通过UI界面方式进行相关的配置和执行情况显示，生成的报告有点土

      tsung无客户端方式的UI界面，在压力测试过程中，无界面动态显示，可以通过日志观察执行情况

  8、多协议的支持
     Tsung：http、WebDav、SOAP、PostgreSql、mysql、LDAP
     Jmeter：Http、SOAP、FTP、JDBC、LDAP、JMS、java









