引用,链接,图片
##############


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

       『图片标题』



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







