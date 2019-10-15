git其他
################

专用命令::

  git rebase:
  // 可以用来修改commit的内容
  $git rebase -i <branch>/<tag>/<version>
  //实例:
  git rebase -i master


  git stash: 将当前未提交的工作存入Git工作栈中，时机成熟的时候再应用回来


  //如果修改文件后想放弃修改可以使用:
  git checkout -- <fileName>

  //如果想忽略的文件进入git库:
  git rm -r --cached <folder>
  or
  git rm --cached <file>



