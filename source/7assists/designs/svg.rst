svg相关
###########

* SVG (Scalable Vector Graphics 可伸缩矢量图形)
* SVG基础 [1]_



继承了W3C标准(DOM XSL)； 在HTML中使用SVG有两种方式，可以在HTML文件中直接嵌入svg内容，也可以直接引入后缀名为.svg的文件 如::

    /* svg标签，这里的rect为矩形，在后面的图形元素中会详细说明  */
    <svg width="200" height="200">
      <rect width="20" height="20" fill="red"></rect>
    </svg>

    /* 引入后缀名为.svg的文件 */
    <img src="demo.svg" alt="测试svg图片">

特殊元素
==========

foreignObject::

    <svg>
      <switch>
        <foreignObject x="20" y="0" width="50">
          <p>测试换行文本，测试换行文本，测试换行文本</p>
        </foreignObject>
        <text x="20" y="20">Your SVG viewer cannot display html.</text>
      </switch>
    <svg>









.. [1] https://github.com/junruchen/junruchen.github.io/wiki/SVG基础