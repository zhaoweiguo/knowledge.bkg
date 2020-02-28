.. _python_tmp:

python临时
####################

python中获取当前位置所在的行号和函数名::

    def get_cur_info(): 
        print sys._getframe().f_code.co_name 
        print sys._getframe().f_back.f_lineno 

    get_cur_info()  

Flash::

  Flask is a microframework for Python based on Werkzeug, Jinja 2 and good intentions.
  http://flask.pocoo.org/
  $> pip install Flask


Flask-SocketIO::

  Flask-SocketIO gives Flask applications access to low latency bi-directional communications between the clients and the server. The client-side application can use any of the SocketIO official clients libraries in Javascript, C++, Java and Swift, or any compatible client to establish a permanent connection to the server.
  $> pip install flask-socketio
  http://flask-socketio.readthedocs.io/en/latest/
