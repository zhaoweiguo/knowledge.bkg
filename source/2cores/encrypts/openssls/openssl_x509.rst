x509相关
############
查看证书签名算法::

    $ openssl x509 -in chained.pem -noout -text | grep 'Signature Algorithm'
    Signature Algorithm: sha256WithRSAEncryption








