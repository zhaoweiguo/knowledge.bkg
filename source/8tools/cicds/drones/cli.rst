cli命令
###########

::

    // 设置全局密钥
    $ drone orgsecret add [organization] [name] [data]

Encrypted::

    Encrypted secrets are used to store sensitive information, 
      such as passwords, tokens, and ssh keys 
      directly in your configuration file as an encrypted string

    用法:
    $ drone encrypt <repository> <secret>
    实例:
    $ drone encrypt secret octocat/hello-world top-secret-password
    hl3v+FODjduX0UpXBHgYzPzVTppQblg51CVgCbgDk4U=

    kind: pipeline
    name: default

    steps:
    - name: build
      image: alpine
      environment:
        USERNAME:
          from_secret: username
    ---
    kind: secret
    name: username
    data: hl3v+FODjduX0UpXBHgYzPzVTppQblg51CVgCbgDk4U=




