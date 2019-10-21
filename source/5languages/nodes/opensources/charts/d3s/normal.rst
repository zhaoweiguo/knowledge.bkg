
选择元素
=========
::

    d3.select() 
    d3.selectAll()     

实例:

    var body = d3.select("body");//选择文档中的body元素
    var svg = body.select("svg");//选择body中的svg元素
    var p = body.selectAll("p");//选择body中所有的p元素
    var p1 = body.select("p");//选择body中第一个p元素

绑定数据data,datum
==================

::

    data()：讲一个数组绑定到选择集上，数组各项和选择集各元素绑定，也就是一一对应的关系
    datum()：将一个数据绑定到所有选择集上

datum()的使用::

    <body>
      <p>dog</p>
      <p>cat</p>
      <p>pig</p>
      
      <script>
        var str = "is an animal";//新建一个字符串
        var p = d3.select("body")
          .selectAll("p");
          
        p.datum(str)//绑定
          .text(function(d,i){
            return "第"+i+"个元素"+d;
          });
      </script>
    </body>

输出::

    第0个元素is an animal
    第1个元素is an animal
    第2个元素is an animal


data()的使用::

    <body>
      <p>dog</p>
      <p>cat</p>
      <p>pig</p>
      
      <script>
        var dataset = ["so cute","cute","fat"];
        var p = d3.select("body")
          .selectAll("p");
          
        p.data(dataset)
          .text(function(d,i){
            return "第"+i+"个动物"+d;
          });
      </script>
    </body>

输出::

    第0个动物so cute
    第1个动物cute
    第2个动物fat

Update、Enter、Exit
=========================

.. image:: /images/charts/common_force_directed2.png


Update与Enter的使用::

    <body>
      <p>dog</p>
      <p>cat</p>
      <p>pig</p>
      
      <script>
        var dataset = [3,6,9,12,15];
        var p = d3.select("body")
          .selectAll("p");
        var update = p.data(dataset)//绑定数据,并得到update部分
        var enter = update.enter();//得到enter部分
        //下面检验是否真的得到
        //对于update的处理
        update.text(function(d,i){
          return "update: "+d+",index: "+i;
        })
        //对于enter的处理
        //注意，这里需要先添加足够多的<p>，然后在添加文本
        var pEnter = enter.append("p")//添加足够多的<p>
        pEnter.text(function(d,i){
          return "enter: "+d+",index: "+i;
        })
      </script>
    </body>

结果::

    update: 3, index 0
    update: 6, index 1
    update: 9, index 2
    enter: 12, index 3
    enter: 15, index 4

Update与Exit的使用::

    <body>
      <p>dog</p>
      <p>cat</p>
      <p>pig</p>
      <p>rat</p>
      
      <script>
        var dataset = [3,6];
        var p = d3.select("body")
          .selectAll("p");
        var update = p.data(dataset)//绑定数据,并得到update部分
        var exit = update.exit();//得到exit部分
        //下面检验是否真的得到
        //对于update的处理
        update.text(function(d,i){
          return "update: "+d+",index: "+i;
        })
        //对于exit的处理通常是删除 ，但在这里我并没有这么做     
        exit.text(function(d,i){
          return "exit";
        })
      </script>
    </body>

结果::

    update: 3, index 0
    update: 6, index 1
    exit
    exit

选择元素select,selectAll
========================

实例::

    <p>dog</p>
    <p>cat</p>
    <p>pig</p>
    <p>rat</p>

::

    // 选择第一个元素<p>
    var p = d3.select("body")
      .select("p");
    p.style("color","red");

    // 选择全部元素
    var p = d3.select("body")
        .selectAll("p");
    p.style("color","red");






