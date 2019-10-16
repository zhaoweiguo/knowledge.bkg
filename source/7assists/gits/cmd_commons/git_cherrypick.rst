git_cherrypick
####################

git cherry-pick可以选择某一个分支中的一个或几个commit(s)来进行操作(操作的对象是commit)
例如，假设我们有个稳定版本的分支，叫v2.0，另外还有个开发版本的分支v3.0，我们不能直接把两个分支合并
这样会导致稳定版本混乱，但是又想增加一个v3.0中的功能到v2.0中，这里就可以使用cherry-pick了

.. note::

    就是对已经存在的commit 进行 再次提交
    注意：当执行完 cherry-pick 以后，将会生成一个新的提交
    这个新的提交的哈希值和原来的不同，但标识名 一样(commit id会变)



使用方法::

    git cherry-pick <commit id>

详细的git log 语法如下::

    git log [<options>] [<since>..<until>] [[--] <path>...]
    主要参数选项如下:
    -p：按补丁显示每个更新间的差异
    --stat：显示每次更新的修改文件的统计信息
    --shortstat：只显示--stat中最后的行数添加修改删除统计
    --name-only：尽在已修改的提交信息后显示文件清单
    --name-status：显示新增、修改和删除的文件清单
    --abbrev-commit：仅显示SHA-1的前几个字符，而非所有的40个字符
    --relative-date：使用较短的相对时间显示（例如："two weeks ago"）
    --graph：显示ASCII图形表示的分支合并历史
    --pretty：使用其他格式显示历史提交信息











