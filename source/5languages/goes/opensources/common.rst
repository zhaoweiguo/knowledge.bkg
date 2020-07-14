常用
##########

官网
----

* golang: https://github.com/golang/go

配置文件相关
----------------

* https://github.com/go-ini/ini
* xml: https://github.com/tealeg/xlsx
* yaml: https://github.com/go-yaml/yaml/
* 兼容 json，toml，yaml，hcl 等格式的日志库: https://github.com/spf13/viper
* replacement for Go's flag package: https://github.com/spf13/pflag

AI
-----

* Brings SQL and AI together: https://github.com/sql-machine-learning/sqlflow
* Kubernetes-native Deep Learning Framework: https://github.com/sql-machine-learning/elasticdl
* Brings SQL and AI together: https://github.com/sql-machine-learning/sqlflow

Golang工具包
------------

* 总地址: golang.org/x/tools
* mirror: https://github.com/golang/tools/
* 文档: https://godoc.org/golang.org/x/tools
* stringer: https://golang.org/x/tools/cmd/stringer
* godoc.org: https://github.com/golang/gddo

通知
---------

* email: https://gopkg.in/gomail.v2
* email: https://github.com/jordan-wright/email
* chat: https://github.com/tinode/chat


日志log
-------

* https://github.com/sirupsen/logrus ::
  
    可以设定日志颜色
    可以设定只打印指定级别日志
    可以设定打印日志到文件、hook等
    注:
    v1.2.0后可打印当前文件和当前行

* 分布式链路追踪: https://github.com/opentracing/opentracing-go
* CNCF Jaeger, a Distributed Tracing Platform: https://github.com/jaegertracing/jaeger.git
* rolling log: https://github.com/natefinch/lumberjack
* Leveled execution logs for Go: https://github.com/golang/glog
* zerolog: https://github.com/rs/zerolog (项目 https://github.com/alibaba/kt-connect 中使用)
* go-kit: https://github.com/go-kit/kit (阿里一个人推荐 https://www.cnblogs.com/alisystemsoftware/p/12408258.html)

环境变量
-----------

* 可读取文件.env来设定环境变量: https://github.com/joho/godotenv
* 把环境变量的值自动赋值给自定义类型的变量: https://github.com/kelseyhightower/envconfig

cli命令
-------

* https://github.com/urfave/cli
* https://github.com/spf13/cobra

辅助代码生成工具
----------------

* https://github.com/golang/mock
    * gomock库: github.com/golang/mock/gomock
    * 辅助代码生成工具mockgen: github.com/golang/mock/mockgen
* https://github.com/google/wire
* https://github.com/jarcoal/httpmock


数据库
------
* 图数据库: https://github.com/dgraph-io/dgraph
* 图数据库: https://github.com/cayleygraph/cayley
* 时序数据库: https://github.com/influxdata/influxdb
* 经济图数据库: https://github.com/degdb/degdb
* 嵌入式k/v数据库: https://github.com/boltdb/bolt
    * https://github.com/etcd-io/bbolt
* A realtime distributed messaging platform: https://github.com/nsqio/nsq

* 分布式k/v数据库: https://github.com/etcd-io/etcd
* consul: https://github.com/hashicorp/consul
* Programmatic lb backend(inspired by Hystrix): https://github.com/vulcand/vulcand
* Global Distributed Client Side Rate Limiting: https://github.com/youtube/doorman

数据库驱动
----------

* sql通用扩展： https://github.com/jmoiron/sqlx
* orm: https://github.com/jinzhu/gorm
* mysql: https://github.com/go-xorm/xorm
* es: https://github.com/elastic/elasticsearch
* proxy based rediscluster solution: https://github.com/CodisLabs/codis

* redis: https://github.com/gomodule/redigo
* mongo: https://github.com/mongodb/mongo-go-driver
* kafka: https://github.com/Shopify/sarama
* sqlite: https://github.com/mattn/go-sqlite3
* mysql: https://github.com/go-sql-driver/mysql
* psql: https://github.com/lib/pq

* 数据结构: https://github.com/emirpasic/gods

并发
----

* https://github.com/Jeffail/tunny
* https://github.com/benmanns/goworke
* https://github.com/rafaeldias/async

lib工具
--------

* 针对结构体的校验逻辑: https://github.com/asaskevich/govalidator
* https://github.com/bytedance/go-tagexpr
* protobuf 文件动态解析的接口，可以实现反射相关的能力: https://github.com/jhump/protoreflect
* 字符串处理: https://github.com/huandu/xstrings
* 表达式引擎工具: https://github.com/Knetic/govaluate
* 表达式引擎工具: https://github.com/google/cel-go
* ratelimit 工具::

    https://github.com/uber-go/ratelimit
    https://blog.csdn.net/chenchongg/article/details/85342086
    https://github.com/juju/ratelimit

* golang 熔断的库::

    熔断除了考虑频率限制，还要考虑 qps，出错率等其他东西.
    https://github.com/afex/hystrix-go
    https://github.com/sony/gobreaker

* 表格: https://github.com/chenjiandongx/go-echarts
* tail 工具库: https://github.com/hpcloud/taglshi



框架
-------

* web框架: https://github.com/go-chi/chi
* web框架: https://github.com/gin-gonic/gin
* web框架: https://github.com/astaxie/beego
* web框架: https://github.com/caddyserver/caddy
* web框架: https://github.com/go-martini/martini
* https://github.com/gorilla/mux
* web框架(cayley): https://github.com/gobuffalo/packr
* https://github.com/grpc/grpc-go

* 后台框架: https://github.com/flipped-aurora/gin-vue-admin
* https://github.com/wenjianzhang/go-admin

* 爬虫: http://github.com/henrylee2cn/pholcus
* 文件上传断点续传: https://github.com/tus/tusd
* websocket: https://github.com/olahol/melody

混沌工程
--------

* https://github.com/chaosblade-io/chaosblad

web服务器
---------

* caddy(类nginx,自动支持http2,內建了 Let’s Encrypt): https://github.com/caddyserver/caddy/tree/v2
* traefik(可以跟 Docker 很深度的結合): https://github.com/containous/traefik
* Tiny WebSocket library for Go: https://github.com/gobwas/ws

DEVOPS
------

* 监控&统计: https://github.com/prometheus/prometheus
* alertmanager: https://github.com/prometheus/alertmanager
* prometheus规模部署方案: https://github.com/thanos-io/thanos
* 监控: https://github.com/grafana/grafana
* 统计: https://github.com/rcrowley/go-metrics
* 统计A well tested and comprehensive Golang statistics library: https://github.com/montanaflynn/stats
* Status Page for monitoring your websites and applications: https://github.com/hunterlong/statping


微服务
------

* rancher: https://github.com/rancher/rancher
* rancher os: https://github.com/rancher/os
* k3s: https://github.com/rancher/k3s
* https://github.com/derailed/k9s
* helm: https://github.com/helm/helm

* docker: https://github.com/docker
* kubernetes: https://github.com/kubernetes/kubernetes
* linuxkit: https://github.com/linuxkit/linuxkit
* 超轻量级: https://github.com/hashicorp/nomad
* Connect, secure, control, and observe services: https://github.com/istio/istio
* https://github.com/kubeedge/kubeedge
* automated deployment and declarative configuration: https://github.com/box/kube-applier
* kustomize: https://github.com/kubernetes-sigs/kustomize
* kubedog: https://github.com/flant/kubedog
* clientGo: https://github.com/kubernetes/client-go
* kubeflow: https://github.com/kubeflow/kubeflow
* ks命令: https://github.com/ksonnet/ksonnet
* cadvisor: https://github.com/google/cadvisor
* ube-state-metrics: https://github.com/kubernetes/kube-state-metrics
* node_exporter: https://github.com/prometheus/node_exporter

网络工具
--------

* 新型的http反向代理、负载均衡软件: https://github.com/containous/traefik
* Google 开源的一个基于 Linux 的负载均衡系统: https://github.com/google/seesaw
* 简单 HTTP 流量复制工具(原来名gor): https://github.com/buger/goreplay
* 穿墙的 HTTP 代理服务器: https://github.com/cyfdecyf/cow
* 家庭或者企业网络的透明代理,可用来翻墙等: https://github.com/xjdrew/kone
* 负载工具类似ab: https://github.com/rakyll/hey
* 高速的 P2P 端口映射工具，同时支持Socks5代理: https://github.com/vzex/dog-tunnel

CI&CD&Git
---------

* gitlab-runner: https://gitlab.com/gitlab-org/gitlab-runner
* drone: https://github.com/drone/drone
* werf: https://github.com/flant/werf
* makes git easier to use with GitHub: https://github.com/github/hub

索引
----

* 全文索引: https://github.com/huichen/wukong


开发工具类
----------

* 跨平台解压缩: https://github.com/mholt/archiver
* 查看某一个库的依赖情况: https://github.com/KyleBanks/depth
* 通过监听当前目录下的相关文件变动，进行实时编译: https://github.com/silenceper/gowatch
* 代码质量检测工具(代替golint): https://github.com/mgechev/revive
* 代码调用链可视化工具: https://github.com/TrueFurby/go-callvis
* 开发流程改进工具: https://github.com/oxequa/realize
* 自动生成测试用例工具(已集成至各ide): https://github.com/cweill/gotests

调试工具
--------

* debugger: https://github.com/go-delve/delve
* perf 工具(go版ps命令): https://github.com/google/gops
* go-torch 工具(deprecated, use pprof): https://github.com/uber-archive/go-torch
* 打印deep pretty printer: https://github.com/davecgh/go-spew
* 网络代理工具: https://github.com/snail007/goproxy
* 抓包工具: https://github.com/40t/go-sniffer
* 反向代理工具，快捷开放内网端口供外部使用: https://github.com/inconshreveable/ngrok
* 配置化生成证书: https://github.com/cloudflare/cfssl
* 免费的证书获取工具: https://github.com/Neilpang/acme.sh
* 敏感信息和密钥管理工具: https://github.com/hashicorp/vault
* 高度可配置化的 http 转发工具，基于 etcd 配置: https://github.com/gojek/weaver
* 分布式任务系统: https://github.com/shunfei/cronsun/blob/master/README_ZH.md
* 定时任务管理系统: https://github.com/ouqiang/gocron
* 定时: https://github.com/robfig/cron
* 自动化运维平台 Gaia: https://github.com/gaia-pipeline/gaia

git版本控制
-----------

* https://github.com/go-git/go-git
* 使用sql查git commit: https://github.com/augmentable-dev/gitqlite

P2P
---

* https://github.com/libp2p/go-libp2p


其他
----

* URL短链接服务: https://github.com/andyxning/shortme
* 静态文件打包到一个go文件: https://github.com/bradrydzewski/togo
* 从一个源配置为多平台创建相同镜像: https://github.com/hashicorp/packer
* updating terminal output in realtime: https://github.com/gosuri/uilive
* Go CGO cross compiler: https://github.com/karalabe/xgo
* A JavaScript interpreter in Go: https://github.com/robertkrimen/otto
* 下载: https://github.com/iawia002/annie
  
开源项目收集
------------

* A curated list of awesome Go frameworks, libraries and software: https://github.com/avelino/awesome-go
* 压测工具: https://github.com/link1st/go-stress-testing

参考
----

* https://juejin.im/post/5de082a95188256f9a25384f


