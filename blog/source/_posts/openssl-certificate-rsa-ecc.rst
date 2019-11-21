---
title: 如何从头做一个
date: 2019-01-13 13:22:09
categories:
- 安全
tags:
- 证书
- 安全
---


###

第一步，生成ca密钥和ca证书::

	# 生成ca密钥
	openssl genrsa -out ca.key 2048
	# 生成ca证书
	openssl req -new nodes -key ca.key -subj "//CN=zwg.com" -days 5000 -out ca.crt


第二步，生成server密钥和证书::

	openssl genrsa -out server.key 2048
	openssl req -new -key server.key -subj "//CN=server" -out server.csr

第三步，生成client密钥和证书::

	openssl genrsa -out client.key 2048
	openssl req -new -key server.key -subj "//CN=client" -out client.csr
	
	echo extendedkeyUsage=clientAuth > ./extfile.cnf
	openssl x509 -req -in client.csr -CA ca.crt -CAkey ca.key -CAcreateserial -extfile ./extfile.cnf -out client.crt -days 5000




