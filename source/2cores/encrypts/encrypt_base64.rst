.. _base64:

baseXX命令使用
##########################

* 常用的Base64算法的实现有三种方式::
  
    1. 第一种是sun公司提供的Base64算法
    2. 第二种是bouncycastle提供的加密算法（以下简称BC包）
    3. 第三种是apache的codec包（以下简称codec包）
       
其中codec提供了 :ref:`RFC2045 <rfc2045>` 标准的Base64实现，每76个字符加一个换行符，如果当前行不足76个字符，也要在最后加上加换行符！

说明::

    Base64是常见的可读性编码算法，所谓Base64，即是说在编码过程中使用了64种字符：大写A到Z、小写a到z、数字0到9、“+”和“/”

    Base58是Bitcoin中使用的一种编码方式，主要用于产生Bitcoin的钱包地址。相比Base64，Base58不使用数字"0"，字母大写"O"，字母大写"I"，和字母小写"i"，以及"+"和"/"符号。

    IPFS 也使用了 Base58





加密::

    base64 <file>
    echo "<str>" | base64

    // 让base64输出在单行上，避免折行
    cat ~/.docker/config.json |base64 -w 0


解密::

    base64 -d <file>
    echo "<str>" | base64 -d



使用常用算法进行加、解密操作
===================================

其他算法的对称加密
--------------------------

Base64::

    $ echo "zhaohang" |openssl base64
    $ echo "emhhb2hhbmcK" |openssl base64 -d


des 算法::

    $ echo "zhaohang" |openssl enc -des -pass pass:123 -base64
    U2FsdGVkX19j45kavF9gFXUU6uHs2bOC8WyppMHbSNw=
    $ echo "U2FsdGVkX19j45kavF9gFXUU6uHs2bOC8WyppMHbSNw="|openssl enc -des -pass pass:123 -base64 -d 
    zhaohang

aes算法::

    $ echo "zhaohang" | openssl enc -aes-128-cbc -pass pass:123456 -base64
    U2FsdGVkX18YLuqf5Puu3JINbRNEKi9+IiThXFP2mCw=
    $ echo "U2FsdGVkX18YLuqf5Puu3JINbRNEKi9+IiThXFP2mCw=" | openssl enc -aes-128-cbc -pass pass:123456 -base64 -d 
    zhaohang

aes算法对文件::

    $ openssl enc -aes-128-cbc -in <filename.txt> -out <file.bin> -pass pass:123456
    $ openssl enc -aes-128-cbc -d -in <file.bin> -out <file.out> -pass pass:123456

使用常用算法进行非对称加密(加密(非对称，不能解密)
----------------------------------------------------------------
::

    $ cat filename.txt 
    zhaohang

sha1对文件或字符串加密::

    $ openssl sha1 filename.txt 
    SHA1(filename.txt)= cf017022db32f04cb57d2ec1ae6b39751a6155e4

    $ echo "zhaohang" |openssl dgst -sha1 
    cf017022db32f04cb57d2ec1ae6b39751a6155e4

    $ sha1sum filename.txt 
    cf017022db32f04cb57d2ec1ae6b39751a6155e4 filename.txt

MD5对文件或字符串加密::

    $ openssl md5 filename.txt 
    MD5(filename.txt)= c47df1e95ae452e959fcc73cda1a3e77

    $ echo "zhaohang" |openssl dgst -md5
    c47df1e95ae452e959fcc73cda1a3e77

    $ md5sum filename.txt 
    c47df1e95ae452e959fcc73cda1a3e77 filename.txt

常用算法列举
=====================

openssl 各种算法::

    $ openssl -h
    Standard commands
    asn1parse      ca             ciphers        crl            crl2pkcs7      
    dgst           dh             dhparam        dsa            dsaparam       
    enc            engine         errstr         gendh          gendsa         
    genrsa         nseq           ocsp           passwd         pkcs12         
    pkcs7          pkcs8          rand           req            rsa            
    rsautl         s_client       s_server       s_time         sess_id        
    smime          speed          spkac          verify         version        
    x509   

    非对称：Message Digest commands (see the `dgst' command for more details)
    md2            md4            md5            rmd160         sha            sha1          
    对 称：Cipher commands (see the `enc' command for more details)
    aes-128-cbc    aes-128-ecb    aes-192-cbc    aes-192-ecb    aes-256-cbc    
    aes-256-ecb    base64         bf             bf-cbc         bf-cfb         
    bf-ecb         bf-ofb         cast           cast-cbc       cast5-cbc      
    cast5-cfb      cast5-ecb      cast5-ofb      des            des-cbc        
    des-cfb        des-ecb        des-ede        des-ede-cbc    des-ede-cfb    
    des-ede-ofb    des-ede3       des-ede3-cbc   des-ede3-cfb   des-ede3-ofb   
    des-ofb        des3           desx           rc2            rc2-40-cbc     
    rc2-64-cbc     rc2-cbc        rc2-cfb        rc2-ecb        rc2-ofb        
    rc4            rc4-40      

创建随机密语
------------

OpenSSL还能创建非常强壮的随机密语::

    $ openssl rand 15 -base64 
    wGcwstkb8Er0g6w1+Dm+ 

* 如果你运行了这个例子，你的输出将与这里的输出不同，因为密语是随机产生的。 
* 第一个参数15是产生的二进制字节数，第二个参数-base64指出那些二进制字节应该用基于64位字符编码，对于15字节而言，输出总是20个字符，加上一个新行字符
* 基于64位字符设定了只由大写和小写的字母A-Z，数字1-9和3个标点字符：加号、斜线号和等号。这是一个有意的字符限制设置，更复杂的字符设置不是必需的，仅仅增加一个额外的字符使得安全变得不同，例如：一个8位字符完全可打印的ASCII密码大约与一个9位字符基于64位字符编码的密码强度相当
  

Base64编码
==========

Shell中使用
-----------

base64 命令::

    $ echo "you are so cool"|base64
    eW91IGFyZSBzbyBjb29sCg==

    $ echo "eW91IGFyZSBzbyBjb29sCg=="|base64 -d
    you are so cool
    //中文
    $ echo "你真帅"|base64
    5L2g55yf5biFCg==

    $ echo "5L2g55yf5biFCg=="|base64 -d
    你真帅

openssl命令::

    $ openssl enc -base64 <<< "good boy"
    Z29vZCBib3kK

    $ openssl enc -base64 -d <<< "Z29vZCBib3kK"
    good boy

Python 使用base64
-----------------
编码 和 解码::

    $ python -c "import base64; print base64.b64encode('you are so cool')"
    eW91IGFyZSBzbyBjb29s

    $ python -c "import base64; print base64.b64decode('eW91IGFyZSBzbyBjb29s')"
    you are so cool

注意无法对unicode直接base64编码, 所以请注意字符编码问题::

    $ python -c "import base64; print base64.b64encode('酷')"
    6YW3

    $ python -c "import base64; print base64.b64encode(u'酷')"
    Traceback (most recent call last):
      File "<string>", line 1, in <module>
      File "/System/Library/Frameworks/Python.framework/Versions/2.7/lib/python2.7/base64.py", line 53, in b64encode
        encoded = binascii.b2a_base64(s)[:-1]
    UnicodeEncodeError: 'ascii' codec can't encode characters in position 0-2: ordinal not in range(128)






