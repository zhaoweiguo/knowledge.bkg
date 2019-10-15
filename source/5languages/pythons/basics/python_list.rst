

python列表处理
###########################

::

    shoplist.sort()     #自排序

列表综合::

    listone = [2, 3, 4]
    listtwo = [2*i for i in listone if i > 2]
    print listtwo

    //結果
    [6, 8]


列表list::

    shoplist = ['apple', 'mango', 'carrot', 'banana']   #列表
    print '一共', len(shoplist), '个列表'   #打印列表个数
    for item in shoplist:        #打印列表中的各值
        print item
    shoplist.sort()     #自排序
    del shoplist[0]     #从列表中删除一条


序列::

    shoplist = ['apple', 'mango', 'carrot', 'banana']
    print 'Item 0 is', shoplist[0]          #'apple'
    print 'Item -2 is', shoplist[-2]        #'carrot'
    print 'Item 1 to 3 is', shoplist[1:3]   #['mango', 'carrot']
    print 'Item 0 to 3 is', shoplist[:3]   #['apple', 'mango', 'carrot']
    print 'Item 1 to 3 is', shoplist[1:]   #['mango', 'carrot', 'banana']

    name = 'swaroop'
    print 'characters 1 to 3 is', name[1:3]     #'wa'

    //参考:
    shoplist = ['apple', 'mango', 'carrot', 'banana']
    mylist = shoplist    #此乃引用
    mylist = shoplist[:] #此乃全复制
    