.. _go_doc:

go doc命令
##########

格式::

    $ go doc [-u] [-c] [package|[package.]symbol[.methodOrField]]

无参命令::

    $ go doc
    默认是当前目录

一个参数命令::

    go doc <pkg>
    go doc <sym>[.<methodOrField>]
    go doc [<pkg>.]<sym>[.<methodOrField>]
    go doc [<pkg>.][<sym>.]<methodOrField>

 two arguments::

    go doc <pkg> <sym>[.<methodOrField>]

.. note:: 大写字母只匹配大写，小写字母可以匹配大写也可以匹配小写

实例::

    go doc
        Show documentation for current package.
    go doc Foo
        Show documentation for Foo in the current package.
        (Foo starts with a capital letter so it cannot match a package path.)
    go doc encoding/json
        Show documentation for the encoding/json package.
    go doc json
        Shorthand for encoding/json.
    go doc json.Number (or go doc json.number)
        Show documentation and method summary for json.Number.
    go doc json.Number.Int64 (or go doc json.number.int64)
        Show documentation for json.Number's Int64 method.
    go doc cmd/doc
        Show package docs for the doc command.
    go doc -cmd cmd/doc
        Show package docs and exported symbols within the doc command.
    go doc template.new
        Show documentation for html/template's New function.
        (html/template is lexically before text/template)
    go doc text/template.new # One argument
        Show documentation for text/template's New function.
    go doc text/template new # Two arguments
        Show documentation for text/template's New function.

    At least in the current tree, these invocations all print the documentation for json.Decoder's Decode method:

    go doc json.Decoder.Decode
    go doc json.decoder.decode
    go doc json.decode
    cd go/src/encoding/json; go doc decode


Flags::

    -all
        Show all the documentation for the package.
    -c
        Respect case when matching symbols.
    -cmd
        Treat a command (package main) like a regular package.
        Otherwise package main's exported symbols are hidden
        when showing the package's top-level documentation.
    -src
        Show the full source code for the symbol. This will
        display the full Go source of its declaration and
        definition, such as a function definition (including
        the body), type declaration or enclosing const
        block. The output may therefore include unexported
        details.
    -u
        Show documentation for unexported as well as exported
        symbols, methods, and fields.




