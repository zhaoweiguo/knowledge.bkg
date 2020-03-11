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

函数
====

pyplot [4]_
-----------

matplotlib.pyplot.subplots::

    from matplotlib import pyplot as plt
    plt.subplots(1, len(images), figsize=(12, 12))   # 

matplotlib.pyplot.scatter::

    参数:
    x, y:
        scalar or array-like, shape (n, )
        The data positions.
    s: 
        scalar or array-like, shape (n, ), optional
        The marker size in points**2. Default is rcParams['lines.markersize'] ** 2.
    c:
        color, sequence, or sequence of colors, optional
    alpha:
        scalar, optional, default: None
        The alpha blending value, between 0 (transparent) and 1 (opaque).

    实例:
    plt.scatter(features[:, 1].asnumpy(), labels.asnumpy(), s=15, c=colors, alpha=0.1);





.. [1] http://matplotlib.org/
.. [2] https://matplotlib.org/users/index.html
.. [3] https://github.com/matplotlib/matplotlib
.. [4] https://matplotlib.org/api/pyplot_summary.html