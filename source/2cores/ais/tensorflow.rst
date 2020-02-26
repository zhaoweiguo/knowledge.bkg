tensorflow
===============

* 官网 [1]_
* 官网2 [2]_
* github [3]_

tensorflow是由Jeff Dean领头的谷歌大脑团队基于谷歌内部第一代深度学习系统DistBelief改进而来的通用计算框架。

lenet-5模型简介：LeNet-5模型是Yann LeCun教授于1988年在论文Gradient-based learning applied to document recognition中提出的，并且是第一个成功应用于数字识别问题的卷积神经网络。LeNet-5模型总共有七层。分别是卷积层-池化层-卷积层-池化层-全连接层-全连接层-全连接层。

* 虽然DistBelief已经被谷歌内部很多产品所使用，但是DistBelief过于依赖谷歌内部的系统架构，很难对外开源。为了将这样一个在谷歌内部已经获得了巨大成功的系统开源，谷歌大脑团队对DistBelief进行了改进，并于2015年11月正式公布了基于Apache 2.0开源协议的计算框架TensorFlow。相比DistBelief，TensorFlow的计算模型更加通用、计算速度更快、支持的计算平台更多、支持的深度学习算法更广而且系统的稳定性也更高。关于TensorFlow平台本身的技术细节可以参考谷歌的论文 ``TensorFlow: Large-Scale Machine Learning on Heterogeneous Distributed Systems``


docker::

    $ docker pull tensorflow/tensorflow                     # latest stable release
    $ docker pull tensorflow/tensorflow:devel-gpu           # nightly dev release w/ GPU support
    $ docker pull tensorflow/tensorflow:latest-gpu-jupyter  # latest release w/ GPU support and Jupyter

启动 TensorFlow Docker 容器::
    
    $ docker run [-it] [--rm] [-p hostPort:containerPort] tensorflow/tensorflow[:tag] [command]

    $ docker run -it --rm tensorflow/tensorflow \
       python -c "import tensorflow as tf; tf.enable_eager_execution(); print(tf.reduce_sum(tf.random_normal([1000, 1000])))"

    $ docker run -it --rm -v $PWD:/tmp -w /tmp tensorflow/tensorflow python ./script.py







.. [1] https://www.tensorflow.org/
.. [2] https://tensorflow.google.cn/
.. [3] https://github.com/tensorflow