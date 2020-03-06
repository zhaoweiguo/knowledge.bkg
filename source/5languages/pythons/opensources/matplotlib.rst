matplotlib
##########

* 官网 [1]_
* 文档 [2]_
* github [3]_

::

    授权协议: 自定义
    开发语言: Ruby

Matplotlib: Visualization with Python。Matplotlib is a comprehensive library for creating static, animated, and interactive visualizations in Python.

安装::

    pip安装
    $ python -m pip install -U pip
    $ python -m pip install -U matplotlib

    conda安装
    $ conda install matplotlib
    $ conda install matplotlib=2.2.2

Dependencies
============

Matplotlib requires the following dependencies::

    Python (>= 3.6)
    FreeType (>= 2.3)
    libpng (>= 1.2)
    NumPy (>= 1.11)
    setuptools
    cycler (>= 0.10.0)
    dateutil (>= 2.1)
    kiwisolver (>= 1.0.0)
    pyparsing

Optionally, you can also install a number of packages to enable better user interface toolkits::

    Tk (>= 8.3, != 8.6.0 or 8.6.1): for the Tk-based backends;
    PyQt4 (>= 4.6) or PySide (>= 1.0.3) [1]: for the Qt4-based backends;
    PyQt5: for the Qt5-based backends;
    PyGObject: for the GTK3-based backends [2];
    wxPython (>= 4) [3]: for the wx-based backends;
    cairocffi (>= 0.8) or pycairo: for the cairo-based backends;
    Tornado: for the WebAgg backend;



.. [1] http://matplotlib.org/
.. [2] https://matplotlib.org/users/index.html
.. [3] https://github.com/matplotlib/matplotlib