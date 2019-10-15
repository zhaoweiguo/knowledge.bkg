代码片段
==================
``flag`` 解析命令参数:

.. literalinclude:: ./codes/flag.go
   :language: go
   :linenos:

``net`` 网络编程::

    conn, error = net.Dial("tcp", "192.168.0.1:8080")    // tcp请求
    conn, error = net.Dial("udp", "192.168.0.1:8090")    // udp请求
    conn, error = net.Dial("ip4:icmp", "www.baidu.com")  // icmp链接（使用协议名称）
    conn, error = net.Dial("ip4:1", "10.3.3.3")          // icmp链接（使用协议编号）

客户端 ``net/http`` http编程::

    func (c *Client) Get(url string) (r *Response, err error)
    e.x: resp, error := http.Get("http://www.baidu.com")
    func (c *Client) Post(url string, bodyType string, body io.Reader) (r *Response, err error)
    e.x: resp, error := http.Post("http://abc.com/upload", "image/jpeg", &imageDataBuf)

    func (c *Client) PostForm(url string, data url.Values) (r *Response, err error)
    // 实现标准编码格式为"application/x-www-form-urlencoded"的表单提交
    e.x: resp, error := http.PostForm("http://example.com/posts", url.Values{"title" : {"article title"}, "content" : {"content"} } )

    
    func (c *Client) Head(url string) (r *Response, err error)
    e.x: resp, error := http.Head("http://www.baidu.com")
    func (c *Client) Do(req *Request) (resp *Response, err error)
    // 个性化需求, 如: 自定义"user-Agent", 如传递cookie
    e.x:
       req, err := http.NewRequest("GET", "http://example.com", nil)
       req.Header.Add("User-Agent", "Go Customer User-Agent")
       req.Header.Add("If-None-Match", 'W/"TheFileEtag"')
       client := &http.Client{}
       resp, err := client.Do(req)

客户端 ``net/http`` http高级功能::

    // 前面的几个方法都是在http.DefaultClient的基础上进行的调用
    type Client struct {
       Transport RoundTripper    // Transport用于确定http的创建机制,默认为DefaultTransport
       CheckRedirect func(req *Request, via []*Request) error    // 定义重定向策略
       Jar CookieJar    // 若Jar为空,cookie不会在请求中发送,并在响应中忽略
    }

    // 自定义Transport
    type Transport struct {
        Proxy func(*Request) (*url.URL, error)   // 指定代理函数, 默认不使用代理
        Dial func(net, addr string) (c net.Conn, err error)     // 指定创建tcp连接的Dial()函数,默认为net.Dial()
        TLSClientConfig *tls.Config   // 指定tls.Client的TLS配置(SSL连接专用)
        DisableKeepAlives bool
        DisableCompression bool
        MaxIdleConnsPerHost int    // 控制每个host所需求保持的最大空闲连接数
    }

    type RoundTripper interface {
        RoundTrip(*Request) (*Response, error)
    }


服务端http请求::

    func ListenAndServe(addr string, handle Handle) error

    http.handle("/abc", abcHandle)
    http.handleFunc("/bar", func(w http.ResponseWriter, r *http.Request) {
       fmt.Fprintf(w, "hello %q", html.EscapeString(r.URL.Path))
    })
    log.Fatal(http.ListenAndServe(":8080", nil)

    // 更多控制
    s := &http.Server {
        Addr:        ":8080",
        Handle:      myHandle,
        ReadTimeout:      10 * time.Second,
        WriteTimeout:     10 * time.Second,
        MaxHeaderBytes:   1 << 20
    }
    log.Fatal(s.ListenAndServer())


服务端https请求::

    func ListenAndServeTLS(add string, certFile string, keyFile string, handle Handle) error
    // 实例和http请求一样
    //不过把ListenAndServe换为ListenAndServeTLS,如:
    ListenAndServeTLS(":10043", "cert.pem", "key.pem", nil)



