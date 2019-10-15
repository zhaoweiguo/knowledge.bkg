临时
#######


密钥交换算法有 RSA 和 ECDHE：RSA 历史悠久，支持度好，但不支持 PFS（Perfect Forward Secrecy）；而 ECDHE 是使用了 ECC（椭圆曲线）的 DH（Diffie-Hellman）算法，计算速度快，支持 PFS



::

    ALPN, server did not agree to a protocol
    ALPN, server agreed to some http protocol; TLS informed
    ALPN, server agreed to some http protocol; TLS ok.
    
    $> curl -v https://http2.golang.org
    ALPN, server accepted to use h2

