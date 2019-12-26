其他
========


提示
=======

::

    Last login: Wed Oct  9 14:04:16 on ttys003
    The default interactive shell is now zsh.
    To update your account to use zsh, please run `chsh -s /bin/zsh`.
    For more details, please visit https://support.apple.com/kb/HT208050.



系统相关::

    xcode-select --install
    

常见软件::

   mactex:  pdf生成工具

   Proxifier: 1.37版本的sn: SNYVP-2RQK0-0QKR1-AFC77-V2J90(用户名随便填)

安全性相关::

   //第三方应用都无法打开了，提示无法打开或者扔进废纸篓
   //大家都知道，macOS Sierra之前的系统也是需要手动去打开应用程序-系统偏好设置-安全性和隐私-通用里勾选任何来源，这样操作之后才能打开第三方应用
   sudo spctl master-disable

::

    $ brew install graphviz
    $ brew install wrk


安装wrk时报::

    A CA file has been bootstrapped using certificates from the system
    keychain. To add additional certificates, place .pem files in
      /usr/local/homebrew/etc/openssl@1.1/certs

    and run
      /usr/local/homebrew/opt/openssl@1.1/bin/c_rehash

    openssl@1.1 is keg-only, which means it was not symlinked into /usr/local/homebrew,
    because openssl/libressl is provided by macOS so don't link an incompatible version.

    If you need to have openssl@1.1 first in your PATH run:
      echo 'export PATH="/usr/local/homebrew/opt/openssl@1.1/bin:$PATH"' >> ~/.zshrc

    For compilers to find openssl@1.1 you may need to set:
      export LDFLAGS="-L/usr/local/homebrew/opt/openssl@1.1/lib"
      export CPPFLAGS="-I/usr/local/homebrew/opt/openssl@1.1/include"

    For pkg-config to find openssl@1.1 you may need to set:
      export PKG_CONFIG_PATH="/usr/local/homebrew/opt/openssl@1.1/lib/pkgconfig"


$ brew remove openssl::

    Error: Refusing to uninstall /usr/local/homebrew/Cellar/openssl@1.1/1.1.1d
    because it is required by aspcud, cairo, clingo, emacs, erlang@19, glib, gnuplot, gobject-introspection, harfbuzz, ideviceinstaller, imap-uw, ios-webkit-debug-proxy, libevent, libimobiledevice, mercurial, meson, mysql, nginx, nmap, openvpn, pango, pkcs11-helper, python, python@2, rrdtool, sphinx-doc, sysbench, thrift, tmux, w3m, wget and wrk, which are currently installed.





