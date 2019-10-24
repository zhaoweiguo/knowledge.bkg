hexo常见问题
==================

执行hexo deploy -g没有反应::

  hexo使用的配置文件是yml，而yml需要在key和value间的:号后有个空格
  deploy:
    type: git
    repo: ssh://git@github.com:zhaoweiguo/abc123.git
    branch: master

hexo categories和tags页面不显示解决办法::

    1. scaffolds/draft.md
    ---
    title: {{ title }}
    tags: {{ tags }}
    ---

    2. scaffolds/post.md

    ---
    title: {{ title }}
    date: {{ date }}
    tags: {{ tags }}
    ---

    3. 默认是没有 categories 和 tags 的需要

    hexo new page "tags" 
    hexo new page "categories"

    编辑 /tags/index.md /categories/index.md
    type: "tags"
    layout: "tags"


    type: "categories"
    layout: "categories"

