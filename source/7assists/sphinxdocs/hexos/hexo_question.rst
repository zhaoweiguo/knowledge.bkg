hexo常见问题
==================

执行hexo deploy -g没有反应::

  hexo使用的配置文件是yml，而yml需要在key和value间的:号后有个空格
  deploy:
    type: git
    repo: ssh://git@github.com:zhaoweiguo/abc123.git
    branch: master

