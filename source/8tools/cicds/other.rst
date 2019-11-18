其他
#########

travis-cli
===============

简介::

    授权协议: MIT
    开发语言: Ruby
    Travis-CI 使用 PostgreSQL 数据库
    现在开始商用, github最新版本已经没有源码

* Travis CI也是开源的，不过Travis和Github集成非常紧密
* 官方的集成测试托管只支持Github项目， 不过你也可以搭建一套自己的方案
* 目前托管在Github上的大部分知名项目都使用了Travis来做集成测试, 比如::
  
    Ruby的：Rails, Rack, Sinatra, RSpec, Cumber, Node.js
    PHP的：Symfony2, Doctrine2, Zend Framework 2

* 官网 [1]_
* github [9]_

prow
======

k8s官方使用的prow，Kubernetes 相关的项目，则会使用 prow 进行 CI:

* prow是k8s测试框架test-infra [2]_ 中使用的CICD工具(在目录prow中)
* 实例: 机器人 [6]_

* K8s 的 Prow 系统: https://prow.k8s.io/
* Prow 官方文档: https://github.com/kubernetes/test-infra/blob/master/prow/README.md
* Prow 快速入门向导 [10]_
* 基于Kubernetes的CI/CD利器 — Prow 入门指南 [11]_


codeship
========

简介::

    商用软件非开源

::

    Codeship是一种快速且安全的托管连续集成服务，可根据您的需求进行扩展
    它支持GitHub，Bitbucket和Gitlab项目
    目标为让使用者专注于开发，其余的工作如管理基础架构、释出流程，则交由Codeship执行

    CodeShip是一个简单优雅且适合中小规模开发团队的CI/CD平台，部署快，易损耗、成本低.
    易用性比肩Travis，而更胜一筹的是集成了相当数量的选项，可以根据自身的工作流程和开发工具定制化CI/CD工作流


* 官网 [3]_
* 非开源, 使用文档, github [4]_

teamcity
========

简介::

    授权协议: 商业软件
    开发语言: Java .NET

* 官网 [5]_

Strider
=======

简介::

    授权协议: MIT
    开发语言: JavaScript

* 官网 [7]_
* github [8]_

安装方法::

    $ npm install -g strider
    $ strider addUser
    $ strider


.. [1] https://travis-ci.com/
.. [2] https://github.com/kubernetes/test-infra
.. [3] https://codeship.com/
.. [4] https://github.com/codeship
.. [5] https://www.jetbrains.com/teamcity/
.. [6] https://github.com/k8s-ci-robot
.. [7] http://strider-cd.github.io/
.. [8] https://github.com/Strider-CD/strider
.. [9] https://github.com/travis-ci/travis-ci
.. [10] https://app.yinxiang.com/fx/20235d10-84e5-4f38-80a1-0c616c5d7192
.. [11] http://note.youdao.com/noteshare?id=9dd773a2c0e6e8d6ff35c653e04fa110