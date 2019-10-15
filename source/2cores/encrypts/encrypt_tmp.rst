encrypt临时
================================

验证证书请求是否与秘钥匹配::

	#!/bin/sh
	if [[ "$1" = "" || "$2" = ""  ]]; then
		echo "certRequestCheck.sh  requestfile keyfile "  
		exit 0;
	else
		value=`openssl req -text -noout -in $1  | grep "Public Key Algorithm:" | awk  -F ':'  'BEGIN {}  {print $2} END {}'`
	 
	 
		if [ "$value" = " rsaEncryption" ] ; then
			echo $value
			
			requestModuleMd5=`openssl req -modulus -in $1 | grep Modulus | openssl md5`
			privateModuleMd5=`openssl rsa -noout -modulus -in $2 | openssl md5`
		
		else
			`openssl ec -in $2 -pubout -out ecpubkey.pem `
			privateModuleMd5=`cat ecpubkey.pem | openssl md5`
			requestModuleMd5=`openssl req -in $1  -pubkey  -noout | openssl md5`
		
		fi
		if [  "$requestModuleMd5" = "$privateModuleMd5" ] ; then 
			echo "ok"
		fi 
	 
	 
	fi

验证公钥证书是否和秘钥匹配::

	#!/bin/sh
	if [[ "$1" = "" || "$2" = "" ]]; then
		echo "certCheck.sh  certfile keyfile"  
		exit 0;
	else
		#certModuleMd5=`openssl x509 -noout -modulus -in $1 | openssl md5`
		#privateModuleMd5=`openssl rsa -noout -modulus -in $2 | openssl md5`
	 
	 
	        #if [  "$certModuleMd5" = "$privateModuleMd5" ] ; then
	        #        echo "ok"
		#else
		#	echo "not ok"
	        #fi
	        value=`openssl x509 -text -noout -in $1  | grep "Public Key Algorithm:" | awk  -F ':'  'BEGIN {}  {print $2} END {}'`
	 
	        if [ "$value" = " rsaEncryption" ] ; then
	                echo $value
	 
	                requestModuleMd5=`openssl x509 -modulus -in $1 | grep Modulus | openssl md5`
	                privateModuleMd5=`openssl rsa -noout -modulus -in $2 | openssl md5`
	 
	        else
	                `openssl ec -in $2 -pubout -out ecpubkey.pem `
	                privateModuleMd5=`cat ecpubkey.pem | openssl md5`
	                requestModuleMd5=`openssl x509 -in $1  -pubkey  -noout | openssl md5`
	 
	        fi
	        if [  "$requestModuleMd5" = "$privateModuleMd5" ] ; then
	                echo "ok"
	        fi
	 
	 
	fi

openssl 命令自动创建证书请求
'''''''''''''''''''''''''''''''''''''''''

ecc 算法证书请求::

	#!/bin/sh
	 
	`openssl ecparam -out private.pem -name secp384r1 -genkey `
	 
	if [[ "$1" = ""  || "$2" = ""  || "$3" = "" || "$4" = "" || "$5" = "" || "$6" = "" || "$7" = "" ]] ; then
		echo "certRequestCreate.sh  country state location organization organizationUnit commonName  email"  
		exit 0;
	else
		if [ "$8" = "" ] ; then 
			`openssl req -new -key private.pem -passin pass:123456  -subj /C=$1/ST=$2/L=$3/O=$4/OU=$5/CN=$6/emailAddress=$7    -out client.pem `
		else	
			sed -i '/\[SAN\]*/d' /etc/pki/tls/openssl.cnf
			sed -i '/subjectAltName*/d' /etc/pki/tls/openssl.cnf
			`echo "[SAN]" >> /etc/pki/tls/openssl.cnf `
			`echo "subjectAltName=DNS:$8" >> /etc/pki/tls/openssl.cnf `
			`openssl req -new -key private.pem -passin pass:123456 -subj /C=$1/ST=$2/L=$3/O=$4/OU=$5/CN=$6/emailAddress=$7 -reqexts SAN -config  /etc/pki/tls/openssl.cnf  -out client.pem `
			sed -i '/\[SAN\]*/d' /etc/pki/tls/openssl.cnf
			sed -i '/subjectAltName*/d' /etc/pki/tls/openssl.cnf
		fi
	fi


rsa 算法证书请求::


	#!/bin/sh
	 
	`openssl genrsa   -out private.pem 2048`
	 
	 
	 
	 
	if [[ "$1" = ""  || "$2" = ""  || "$3" = "" || "$4" = "" || "$5" = "" || "$6" = "" || "$7" = "" ]] ; then
		echo "certRequestCreate.sh  country state location organization organizationUnit commonName  email"  
		exit 0;
	else
		if [ "$8" = "" ] ; then 
			`openssl req -new -key private.pem -passin pass:123456  -subj /C=$1/ST=$2/L=$3/O=$4/OU=$5/CN=$6/emailAddress=$7   -extensions v3_ca -out client.pem `
		else	
			sed -i '/\[SAN\]*/d' /etc/pki/tls/openssl.cnf
			sed -i '/subjectAltName*/d' /etc/pki/tls/openssl.cnf
			`echo "[SAN]" >> /etc/pki/tls/openssl.cnf `
			`echo "subjectAltName=DNS:$8" >> /etc/pki/tls/openssl.cnf `
			`openssl req -new -key private.pem -passin pass:123456  -subj /C=$1/ST=$2/L=$3/O=$4/OU=$5/CN=$6/emailAddress=$7 -extensions v3_ca -reqexts SAN -config  /etc/pki/tls/openssl.cnf  -out client.pem `
			sed -i '/\[SAN\]*/d' /etc/pki/tls/openssl.cnf
			sed -i '/subjectAltName*/d' /etc/pki/tls/openssl.cnf
		fi
	fi


aes
------

高级加密标准（英语：Advanced Encryption Standard，缩写：AES），在密码学中又称Rijndael加密法，是美国联邦政府采用的一种区块加密标准。这个标准用来替代原先的DES，已经被多方分析且广为全世界所使用。经过五年的甄选流程，高级加密标准由美国国家标准与技术研究院（NIST）于2001年11月26日发布于FIPS PUB 197，并在2002年5月26日成为有效的标准。2006年，高级加密标准已然成为对称密钥加密中最流行的算法之一

Rijndael密码的设计力求满足以下3条标准：
① 抵抗所有已知的攻击。
② 在多个平台上速度快，编码紧凑。
③ 设计简单。












