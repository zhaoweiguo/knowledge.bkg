字典
============

::

    ab = {
       'key1' : 'value1',
       'key2' : 'value2',
       'key3' : 'value3',
       'key4' : 'value4'
     }
     print "key1's value is %s" % ab['key1']
     # 增加一条记录
     ab['key5'] = 'value5'
     # 删除一条记录
     del ab['key3']
     # 打印字典组中数据
     for key, value in ab.items():
         print 'key %s 's value is %s' % (key, value)

     if 'key1' in ab:   # 或 ab.has_key('Guido')
         print "\nkey1's value is %s" % ab['key1']
