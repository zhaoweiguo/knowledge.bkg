lsof命令
================
一个列出当前系统打开文件的工具
官网: http://people.freebsd.org/~abe/

命令参数::

  -a 列出打开文件存在的进程
  -c<进程名> 列出指定进程所打开的文件
  -g 列出GID号进程详情
  -d<文件号> 列出占用该文件号的进程
  +d<目录> 列出目录下被打开的文件
  +D<目录> 递归列出目录下被打开的文件
  -n<目录> 列出使用NFS的文件
  -i<条件> 列出符合条件的进程。（4、6、协议、:端口、 @ip ）
  -p<进程号> 列出指定进程号所打开的文件
  -u 列出UID号进程详情
  -h 显示帮助信息
  -v 显示版本信息


lsof各列信息::

  COMMAND：进程的名称
  PID：进程标识符
  PPID：父进程标识符（需要指定-R参数）
  USER：进程所有者
  PGID：进程所属组
  FD：文件描述符，应用程序通过文件描述符识别该文件。如cwd、txt等:
  TYPE：文件类型，如DIR、REG等，常见的文件类型:
  DEVICE：指定磁盘的名称
  SIZE：文件的大小
  NODE：索引节点（文件在磁盘上的标识）
  NAME：打开文件的确切名称

FD列说明::

  （1）cwd：表示current work dirctory，即：应用程序的当前工作目录，这是该应用程序启动的目录，除非它本身对这个目录进行更改
  （2）txt ：该类型的文件是程序代码，如应用程序二进制文件本身或共享库，如上列表中显示的 /sbin/init 程序
  （3）lnn：library references (AIX);
  （4）er：FD information error (see NAME column);
  （5）jld：jail directory (FreeBSD);
  （6）ltx：shared library text (code and data);
  （7）mxx ：hex memory-mapped type number xx.
  （8）m86：DOS Merge mapped file;
  （9）mem：memory-mapped file;
  （10）mmap：memory-mapped device;
  （11）pd：parent directory;
  （12）rtd：root directory;
  （13）tr：kernel trace file (OpenBSD);
  （14）v86  VP/ix mapped file;
  （15）0：表示标准输出
  （16）1：表示标准输入
  （17）2：表示标准错误
  一般在标准输出、标准错误、标准输入后还跟着文件状态模式：r、w、u等
  （1）u：表示该文件被打开并处于读取/写入模式
  （2）r：表示该文件被打开并处于只读模式
  （3）w：表示该文件被打开并处于
  （4）空格：表示该文件的状态模式为unknow，且没有锁定
  （5）-：表示该文件的状态模式为unknow，且被锁定
  同时在文件状态模式后面，还跟着相关的锁
  （1）N：for a Solaris NFS lock of unknown type;
  （2）r：for read lock on part of the file;
  （3）R：for a read lock on the entire file;
  （4）w：for a write lock on part of the file;（文件的部分写锁）
  （5）W：for a write lock on the entire file;（整个文件的写锁）
  （6）u：for a read and write lock of any length;
  （7）U：for a lock of unknown type;
  （8）x：for an SCO OpenServer Xenix lock on part      of the file;
  （9）X：for an SCO OpenServer Xenix lock on the      entire file;
  （10）space：if there is no lock.


TYPE列说明::

  （1）DIR：表示目录
  （2）CHR：表示字符类型
  （3）BLK：块设备类型
  （4）UNIX： UNIX 域套接字
  （5）FIFO：先进先出 (FIFO) 队列
  （6）IPv4：网际协议 (IP) 套接字


::

   // 列表使用此文件的进程
   lsof /path/to/file

   // 递归查找某个目录中所有打开的文件
   lsof +D /usr/lib

   // 递归查找某个目录中所有打开的文件
   lsof +D /usr/lib
   lsof | grep '/usr/lib'     // 这个反应快

   // 列出某个用户打开的所有文件; -u 选项，u是user的缩写
   lsof -u pkrumins
   lsof -u rms,root

   // 查找某个程序打开的所有文件
   lsof -c apache   //-c选项限定只列出以apache开头的进程打开的文件
   lsof -c apache -c python   // 列出所有由apache和python打开的文件

   //列出除root用户外的所有用户打开的文件
   lsof -u ^root

   // 列出所有由某个PID对应的进程打开的文件
   lsof -p <pid>
   lsof -p <pid1>,<pid2>,<pid3>

   lsof -p ^1   // 取反

   // 列出网络连接
   lsof -i   // 全部
   lsof -i tcp
   lsof -i :25   // 找到使用某个端口的进程
   lsof -i :smtp
   lsof -i udp:53

   //列出所有UNIX域Socket文件
   lsof -U   // -U就对应UNIX

   // 输出使用某些资源的进程pid
   lsof -t -i
   
   // 循环列出文件
   lsof -r 1

其他::

  //列出某个用户的所有活跃的网络端口
  $lsof -a -u test -i
  

   
