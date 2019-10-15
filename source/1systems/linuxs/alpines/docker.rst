docker专用
################

::

    FROM       docker.io/golang:alpine

    // 更新源
    RUN echo "https://mirror.tuna.tsinghua.edu.cn/alpine/v3.4/main" > /etc/apk/repositories
    RUN apk add --update curl bash && \
        rm -rf /var/cache/apk/*

    // 增加证书
    RUN apk add ca-certificates

    // 无cache更新
    RUN apk add --no-cache curl openssl emacs





