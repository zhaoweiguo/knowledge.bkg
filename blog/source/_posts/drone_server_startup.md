---
title: 使用Drone搭建CICD服务
date: 2019-11-18 10:11:12
tags:
- drone
- cicd
categories:
- drone
---

## 概要

#### 需求

1. 开源软件。可用于商业相关服务的自动化部署
2. 尽量少一些运维部署操作。我们团队都是开发人员，没有专门的运维，开发人员主要工作是编码而不是其它
3. 较好的支持k8s微服务。目前使用了比较多k8s部署服务
4. 尽量简单，适合小团队使用。服务部署完成后，项目组其他成员可以快速掌握使用。

#### 调研

CI/CD已经形成了一套标准流程，有多个开源不开源的工具可以实现。常用的CI/CD工具有:

```
Jenkins
gitlab-ci
prow
Strider

Travis
teamcity
Codeship
```

这其中:

```
1. Travis、Codeship、teamcity使用商用协议,其他Travis只适用于github平台
2. Strider不适用k8s环境的自动化部署
3. prow是专用于k8s项目，是Kubernetes测试框架test-infra的一部分,目前好像只适用于github平台

只剩下Jenkins和gitlab-ci适合我们目前开发团队的使用
```

Jenkins优缺点:
```
优点:
  功能完善、插件丰富: 有1000多个插件可供选择
  权限控制粒度高: 可以精确控制每个用户的权限
  稳定性高、文档丰富、使用人数多: 出现问题好解决
缺点:
  复杂: 1000多个插件, 不下大功夫, 如何知道应该用哪个插件
  权限控制复杂: 精确控制每个用户的权限, 但需要花大量时间配置
  需要对
```

gitlab-ci的优缺点:
```

```




## 参考

轻量快速的 CI 工具 Drone


