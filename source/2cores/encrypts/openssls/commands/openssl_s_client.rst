openssl s_client命令
########################

::

    openssl s_client -connect gateway.sandbox.push.apple.com:2195 -cert PushChatCert.pem -key PushChatKey.pem

    // 指定使用ssl3协议
    openssl s_client -connect 127.0.0.1:5000 -ssl3
    // 指定使用tls1协议
    openssl s_client -connect 127.0.0.1:5000 -tls1




