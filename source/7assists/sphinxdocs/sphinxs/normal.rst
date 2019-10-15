基本格式查询
#######################


基本格式::

    字体:
        黑体 : **binary catalogs**
        斜体 : *text*
        变颜色:
            :unsure:`文本`


引用，链接::


    链接:
        `链接显示名 <http://blog.programfan.info/>`_

    另一形式:
    Test hyperlink: SO_
    .. _SO: http://stackoverflow.com/


    站内链接:
        :ref:`链接显示，右面是文件开头的索引 <header_1>`

        这是链接的另一形式,链接到ablog.rst
        :doc:`ablog`

    引用:
        使用: xxxxx [1]_
        展示: .. [1]  xxxxx

    // 章节引用
    .. _my-reference-label:

    Section to cross-reference
    --------------------------

    This is the text of the section.
    It refers to the section itself, see :ref:`my-reference-label`.

    // 图片引用 
    .. _my-figure:

    .. figure:: whatever

       Figure caption



图片::

    .. figure:: image/photo.jpg
       :width: 20%, 12.0cm  % image宽度
       :figwidth:  % 图片宽度
       :scale: 50 %
       :alt: map to buried treasure
       :align : left, center, or right   % 指定「标题」位置

       「图片标题」

    width说明:
      +---------------------------+
      |        figure             |
      |                           |
      |<------ figwidth --------->|
      |                           |
      |  +---------------------+  |
      |  |     image           |  |
      |  |                     |  |
      |  |<--- width --------->|  |
      |  +---------------------+  |
      |                           |
      |The figure's caption should|
      |wrap at this width.        |
      +---------------------------+

    注释:
        .. -*- coding:utf-8 -*-

    .. image:: https://travis-ci.org/rtfd/sphinx_rtd_theme.svg?branch=master
       :target: https://travis-ci.org/rtfd/sphinx_rtd_theme
       :alt: Build Status
    .. image:: https://img.shields.io/pypi/l/sphinx_rtd_theme.svg
       :target: https://pypi.python.org/pypi/sphinx_rtd_theme/
       :alt: License
    .. image:: https://readthedocs.org/projects/sphinx-rtd-theme/badge/?version=latest
      :target: http://sphinx-rtd-theme.readthedocs.io/en/latest/?badge=latest
      :alt: Documentation Status


代码格式::

    1.局部代码格式:
    ``usage.rst``
    2.段落代码格式:

        代码段格式::

            xxxx xxx xxx

    3.另一种代码格式:
    .. code-block:: erlang
       :linenos:
       :emphasize-lines: 3,5
       :dedent: 4

        -module(abc).
        -export([ex/0]).

        ex() ->
            ok.

    // 语言有:
    erlang
    matlab

    4.全局
    .. highlight:: console    // 在文件最前面加上，代码段能更好显示
        :linenothreshold: 5


各种标志::

    .. note::

    // 警告
    .. warning::

      这是警告的书写方法

    // 函数
    .. function:: erlang:memory/0

        这是函数的标志

    // 配置文件选项类型:
    .. program:: sphinx-apidoc

    .. option:: -o outputdir

       这儿写此选项的一些介绍


toc树相关::

    // 普通树
   .. toctree::
       :caption: 此目录树的标题
       :name: mastertoc
       :numbered:   % 树显示1.2.3.4列表数
       :titlesonly: % 只展示主标题,里面的子标题不展示
       :glob:       % 主要用于生成sitemap

       foo

    // 递归
    .. toctree::
        :glob:
        :reversed:

        recipe/*

    // 隐藏树
    .. toctree::
       :hidden:
       :maxdepth: 2

       hiddens/simple

    // 内置树
    .. contents::
       :depth: 1
       :local:
       :backlinks: none

sidebar::

    // 普通使用
    .. sidebar:: Sidebar标题

       siderbar 内容
        
       * **内容1**: `链接1 <http://zhaoweiguo.com/>`_
       * **内容2**: `链接2 <https://zhaoweiguo.com/>`_
       * **github**: ` <https://github.com/zhaoweiguo>`


    // 接合页内目录使用
    .. sidebar:: 本地目录

    .. contents::
       :depth: 1
       :local:
       :backlinks: none

段落相关::

    列表格式:
         1,  
            * 这是一个符号列表
            * 它有两项，其中第
              二行占两行
         2,
            1. 这是一个编号列表
            2. 它也只有两项(只占一行)
         3,
            #. 这是一个(自动的)编号列表
            #. 它也有两行


    章节:
        =================
        This is a heading
        =================
        //以下是其他章节说明
        # with overline, for parts
        * with overline, for chapters
        =, for sections
        -, for subsections
        ^, for subsubsections
        ", for paragraphs
 
    脚注:
        \ [#] \
        or
        \ [1] \

        脚注说明::
        .. rubric:: 脚注
        .. [#] 具体说明


文件包含::

    1.包含另一个reStructuredText文件:
    .. include:: path/to/file.rst

    2.包含代码文件:
    实例一:

       .. literalinclude:: /path/to/file.erl
           :language: erlang
           :emphasize-lines: 12,15-18  //亮显
           :linenos: //显示行号
           :encoding: latin-1
           :pyobject: Timer.start
           :lines: 1,3,5-10,20-    % 显示指定行
           :dedent: 4


        language选项:
            erlang
            php
            matlab
            sh
            ruby
            bash

        emphasize-lines（加亮行）::
            12, 13, 14
            12-14
            12-

        encoding::
            latin-1


替换::

    # 1. 本地版
    // 在最后做如下定义, 在整个文中可用 |logo|代替此图片
    .. |logo| image:: ../images/wiki_logo_openalea.png  
      :width: 20pt
      :height: 20pt
      :align: middle

    // 代替一段话
    .. |longtext| replace:: this is a longish text to include within a table and which is longer than the width of the column.

    # 2. 全局版
    // In your conf.py:
    my_config_value = 42
    rst_epilog = '.. |my_conf_val| replace:: %d' % my_config_value

    // In your .rst source:
    My config value is |my_conf_val|!

    // In your output:
    My config value is 42!


表格相关::

    格式1:
    +------------------------+------------+----------+----------+
    | Header row, column 1   | Header 2   | Header 3 | Header 4 |
    | (header rows optional) |            |          |          |
    +========================+============+==========+==========+
    | body row 1, column 1   | column 2   | column 3 | column 4 |
    +------------------------+------------+----------+----------+
    | body row 2             | ...        | ...      |          |
    +------------------------+------------+----------+----------+

    格式2:
    .. table:: Truth table for "not"
       :widths: auto

        =====  =====  =======
        A      B      A and B
        =====  =====  =======
        False  False  False
        True   False  False
        False  True   False
        True   True   True
        =====  =====  =======

    格式3:
    .. csv-table:: 表3  应用目录下的子目录
        :widths: 10 90
        :header: 目录, 描述

            doc,     用于存放文档
            ebin,    用于存放编译后的代码（.beam文件）
            include, 用于存放公共头文件

    格式4:
    .. list-table:: 表4 list-table 表
       :widths: 15 10 30
       :header-rows: 1

       * - Treat
         - Quantity
         - Description
       * - Albatross
         - 2.99
         - On a stick!
       * - Crunchy Frog
         - 1.49
         - If we took the bones out, it wouldn't be
           crunchy, now would it?
       * - Gannet Ripple
         - 1.99
         - On a stick!


Cross-referencing::

    See :download:`this example script <../example.py>`
    :doc:`parrot` 
    :doc:`/people` or :doc:`../people`
    like usual: :doc:`Monty Python members </people>`

    .. only:: builder_html

        See :download:`this example script <../example.py>`.

    :abbr:
    :command:
    :dfn:
    :file:
        ... is installed in :file:`/usr/lib/python2.{x}/site-packages` ...
    :guilabel:
    :kbd:
    :mailheader:
    :makevar:
    :manpage:
    :menuselection:
        :menuselection:`Start --> Programs`
    :mimetype:
    :newsgroup:
    :program:
    :regexp:
    :samp:

Substitutions::

    |release|
    |version|
    |today|

Meta-information markup::

    .. sectionauthor:: name <email>
    .. sectionauthor:: Guido van Rossum <guido@python.org>
    .. codeauthor:: name <email>

Index-generating markup::

    .. index:: <entries>
    // 例
    .. index::
       single: execution; context
       module: __main__
       module: sys
       triple: module; search; path

    The execution context
    ---------------------

    ...

颜色


其他::

    .. productionlist::
       try_stmt: try1_stmt | try2_stmt
       try1_stmt: "try" ":" `suite`
                : ("except" [`expression` ["," `target`]] ":" `suite`)+
                : ["else" ":" `suite`]
                : ["finally" ":" `suite`]
       try2_stmt: "try" ":" `suite`
                : "finally" ":" `suite`


    % 索引与查询
    * :ref:`genindex`
    * :ref:`search`







