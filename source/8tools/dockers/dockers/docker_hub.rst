常用Docker镜像
#####################

alpine::

    A minimal Docker image based on Alpine Linux with a complete package index and only 5 MB in size!



语言 [1]_
=========

* r-base语言::
  
    https://hub.docker.com/_/r-base
    $ docker pull r-base

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

* node::
  
    $ docker pull node:6-alpine

数据库
======

* 图数据库cayley::
  
    https://hub.docker.com/r/cayleygraph/cayley
    $ docker pull cayleygraph/cayley

* 图数据库dgraph::
  
    $ docker pull dgraph/dgraph

* 时序数据库influxdb::
  
    $ docker pull influxdb


工具
====

* 监控grafana::

    $ docker pull grafana/grafana

* 自动化部署jenkins::
  
    $ docker pull jenkins/jenkins

* nginx::
  
    $ docker pull nginx:alpine







.. [1] https://hub.docker.com/search/?q=language&type=image