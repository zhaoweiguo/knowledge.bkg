mock
######


GoMock是用于Go编程语言的模拟框架。 它与Go的内置测试包testing很好地集成在一起，但是也可以在其他环境中使用。


安装::

    $ go get github.com/golang/mock/mockgen
    // 建议: GO111MODULE=on

    //文档
    go doc github.com/golang/mock/gomock
    or
    https://godoc.org/github.com/golang/mock/gomock

两种模式
========

源码模式(source mod)::

    // Source mode从源文件中生成mock interface
    格式:
    $ mockgen -source=<source>.go [other options]
    例:
    $ mockgen -source=foo.go [other options]
    // [other options]: -imports and -aux_files.

反射模式(reflect mod)::

    // Reflect mode通过构建使用反射的程序了解interfaces来生成mock interfaces
    格式:
    mockgen <package> <Type1>,<Type2>
    例:
    mockgen database/sql/driver Conn,Driver

参数说明
========

::

    -source： 指定接口文件
    -destination: 生成的文件名
    -package:生成文件的包名
    -imports: 依赖的需要import的包
    -aux_files:接口文件不止一个文件时附加文件
    -build_flags: 传递给build工具的参数


实例

::

    $ mockgen -destination spider/mock_spider.go -package spider -source spider/spider.go

drone实例::

    $ mockgen -package=mock -destination=mock_gen.go github.com/drone/drone/core Pubsub,Canceler,ConvertService,ValidateService,NetrcService,Renewer,HookParser,UserService,RepositoryService,CommitService,StatusService,HookService,FileService,Batcher,BuildStore,CronStore,LogStore,PermStore,SecretStore,GlobalSecretStore,StageStore,StepStore,RepositoryStore,UserStore,Scheduler,Session,OrganizationService,SecretService,RegistryService,ConfigService,Triggerer,Syncer,LogStream,WebhookSender,LicenseService

参考
====

* 参考1: https://www.jianshu.com/p/598a11bbdafb
* 官方文档: https://godoc.org/github.com/golang/mock/gomock

