SVG [1]_
##########

SVG (Scalable Vector Graphics 可伸缩矢量图形)

在HTML文件中直接嵌入svg内容，也可以直接引入后缀名为.svg的文件 如::

    /* svg标签，这里的rect为矩形，在后面的图形元素中会详细说明  */
    <svg width="200" height="200">
      <rect width="20" height="20" fill="red"></rect>
    </svg>

    /* 引入后缀名为.svg的文件 */
    <img src="demo.svg" alt="测试svg图片">

SVG中的坐标系::

    y轴向下
    顺时针方向的角度为正值

颜色 RGB和HSL::

    RGB: 三个分量：红色、绿色、蓝色，每个分量的取值范围[0, 255]，优点是显示器更容易解析
    HSL: 三个分量：颜色h、饱和度s%、亮度l%，每个分量的取值范围分别是[0, 359], [0, 100%], [0, 100%],，其中，h=0表示红色， h=0表示120绿色，h=0表示240 蓝色
    基于HSL的配色方案http://paletton.com/


.. [1] https://github.com/junruchen/junruchen.github.io/wiki/SVG%E5%9F%BA%E7%A1%80