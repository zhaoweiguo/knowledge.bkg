常用
####

组件
====

Server: 主要负责数据采集和存储，提供PromQL查询语言的支持

Push Gateway: 支持临时性Job主动推送指标的中间网关

DashBoard: 使用rails开发的dashboard，用于可视化指标数据

AlertManager: 实验性组件、用来进行报警「除了添加新配置之后要Reload下别的也没啥蛋疼的，这个东西是可以自动化下点功夫的」

Exporter:支持其他数据源的指标导入到Prometheus，支持数据库、硬件、消息中间件、存储系统、http服务器、jmx等「啥都有简直神器，如果没有也可以自行开发」



