代理
#########

一、replace 方式来指定替换包的地址::

    module github.com/exercise
    require (
        golang.org/x/text v0.3.0
        gopkg.in/yaml.v2 v2.1.0 
    )

    replace (
        golang.org/x/text => github.com/golang/text v0.3.0
    )

二、goproxy.io [1]_ ::

    // For Linux
    export GOPROXY=https://goproxy.io
    // For windows
    $env:GOPROXY = "https://goproxy.io"


.. image:: /images/golangs/goproxy1.png


Athens [2]_

三、Idea设置:

.. image:: /images/emacs/idea_golang_proxy.png






.. [1] https://goproxy.io/
.. [2] https://docs.gomods.io/