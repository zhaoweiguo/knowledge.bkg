通知
###########

常用标志::

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

todo
====

添加Sphinx支持::

    在conf.py中修改如下配置项

    extensions = [
        'sphinx.ext.todo',
    ]


使用::

    .. todo::


.. todo::

   todo 1

   todo 2

   todo 3



使用::

    .. seealso::

seealso
=======

.. seealso::

   Module :py:mod:`zipfile`
      Documentation of the :py:mod:`zipfile` standard module.

   `GNU tar manual, Basic Tar Format <http://link>`_
      Documentation for tar archive files, including GNU tar extensions.

centered
========

使用::

    .. centered::


.. centered:: LICENSE AGREEMENT





