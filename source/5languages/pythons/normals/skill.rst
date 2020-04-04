技巧
####


python中获取当前位置所在的行号和函数名::

    def get_cur_info(): 
        print sys._getframe().f_code.co_name 
        print sys._getframe().f_back.f_lineno 

    get_cur_info()  



python使用小技巧::

  shell> python -v
  python>>> import sys
  python>>> print sys.path    # 打印系统安装路径



