.. _python_string:

python字符串处理
############################

字符串截取::

    str = '12345678'
    print str[0:1]
    >> 1             # 输出str位置0开始到位置1以前的字符
    print str[1:6]
    >> 23456         # 输出str位置1开始到位置6以前的字符
    num = 18
    str = '0000' + str(num)# 合并字符串
    print str[-5:]   # 输出字符串右5位
    >> 00018


字符串替换::

    str = 'akakak'
    str = str.replace('k',' 8')      # 将字符串里的k全部替换为8
    print str
    >> 'a8a8a8'# 输出结果

字符串查找::

    str = 'a,hello'
    print str.find('hello')      # 在字符串str里查找字符串hello
    >> 2# 输出结果



字符分割::

    str = 'a,b,c,d'
    strlist = str.split(',')     # 用逗号分割str字符串，并保存到列表


字符合并::

    sep=":"
    items=sep.join(strlist)
    print items       # 'a:b:c:d'


字符串的方法::

    name = 'Swaroop'
    if name.startswith('Swa'):
        print 'Yes, the string starts with "Swa"'
    if 'a' in name:
        print 'Yes, it contains the string "a"'
    if name.find('war') != -1: #得到字符串里含有子字符串对应的位置,没有为-1
        print 'Yes, it contains the string "war"'

    delimiter = '_*_'
    mylist = ['Brazil', 'Russia', 'India', 'China']
    print delimiter.join(mylist)  # Brazil_*_Russia_*_India_*_China

说明::

    单引号指示字符串,所有的空白，即空格和制表符都照原样保留
    双引号中的字符串与单引号中的字符串的使用完全相同
    三引号，你可以指示一个多行的字符串;在三引号中自由的使用单引号和双引号

    自然字符串——不需要如转义符那样的特别处理的字符串:

        r"Newlines are indicated by \n"
        # '\\1'或r'\1'一样

    Unicode字符串——国际文本的标准方法(要在字符串前加上前缀u或U)::

        u"This is a Unicode string."