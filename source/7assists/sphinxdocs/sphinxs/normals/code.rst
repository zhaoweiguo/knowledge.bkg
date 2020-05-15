代码
####


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
