常用Docker镜像
#####################

alpine::

    A minimal Docker image based on Alpine Linux with a complete package index and only 5 MB in size!



语言 [1]_
=========

* r-base语言::

    $ docker pull r-base
    $ docker pull registry.cn-hangzhou.aliyuncs.com/langs/r-base

* java::

    openjdk:
    // OpenJDK is an open-source implementation of the Java Platform, Standard Edition
    $ docker pull openjdk

    maven:
    // Apache Maven is a software project management and comprehension tool.
    $ docker pull maven

* golang::
    
    $ docker pull golang
    $ docker pull golang:1.12-alpine
    $ docker pull registry.cn-hangzhou.aliyuncs.com/langs/golang:1.12-alpine

* node::
  
    $ docker pull node:6-alpine

操作系统
========



数据库
======

* 图数据库cayley::
  
    https://hub.docker.com/r/cayleygraph/cayley
    $ docker pull cayleygraph/cayley
    $ docker pull registry.cn-hangzhou.aliyuncs.com/opensources/cayley
    $ docker run --rm -p 64210:64210 cayleygraph/cayley 

* 图数据库dgraph::
  
    $ docker pull dgraph/dgraph
    $ docker pull registry.cn-hangzhou.aliyuncs.com/opensources/dgraph

* 时序数据库influxdb::
  
    $ docker pull influxdb
    $ docker pull registry.cn-hangzhou.aliyuncs.com/opensources/influxdb

* 文档数据库mongoDB::

    $ docker pull mongo:4.2.1
    $ docker pull registry.cn-hangzhou.aliyuncs.com/opensources/mongo:4.2.1
    $ docker run --rm -p 27017:27017 mongo:4.2.1

* 关系数据库mysql::
    
    $ docker pull mysql:5.7

* key/value数据库redis::
    
    $ docker pull redis:5.0-alpine


工具
====

* 监控grafana::

    $ docker pull grafana/grafana:5.1.0
    $ docker pull registry.cn-hangzhou.aliyuncs.com/opensources/grafana:5.1.0

* 自动化部署jenkins::
  
    $ docker pull jenkins/jenkins
    $ docker pull registry.cn-hangzhou.aliyuncs.com/opensources/jenkins

* nginx::
  
    $ docker pull nginx:alpine
    $ docker pull registry.cn-hangzhou.aliyuncs.com/opensources/nginx:alpine







.. [1] https://hub.docker.com/search/?q=language&type=image