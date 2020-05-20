常见知识
=================

板子::
  
  51单片机
  AVR单片机
  arm板

  
芯片-WiFi模块（六大Wi-Fi芯片厂商）::

  1.乐鑫
    ESP8266、ESP8285
  2.新岸线
    NL6621
  3.联盛德微电子
    W500
  4.南方硅谷
    SSV6060P
  5.澜起科技
    M88WI6032D、M88WI6800-K
  6.上海庆科
    EMW3162、EMW5088、EMW3081、EMW3088、EMW3165、EMW1088、EMW3240、EMW1062、EMW3081A、EMW3238

芯片、串口、接口::
  
  232接口
  RS-422

  CH340:CH340 是一个USB 总线的转接芯片，实现USB 转串口、USB 转IrDA 红外或者USB 转打印口。
  CP2102:CP2102其集成度高，内置USB2.0全速功能控制器、USB收发器、晶体振荡器、EEPROM及异步串行数据总线（UART），支持调制解调器全功能信号，无需任何外部的USB器件。CP2102与其他USB-UART转接电路的工作原理类似，通过驱动程序将PC的USB口虚拟成COM口以达到扩展的目的。

  -- 稳压器
  AMS1117:AMS1117系列稳压器有可调版与多种固定电压版

线::
  
  杜板线

配置::

    smartconfig
    softAP

常见::
  
  Raspberry Pi：树莓派
  Tessel：JavaScript做嵌入式
  Ruff：JavaScript做嵌入式2
  Arduino：开源电子原型平台
  ESP8266

文件后缀::
  
  印制电路板.PCB
  物料清单BOM
  原理图文件 .SCH
  工程文件 .DDB

简称::

  TX发送端
  RX接收端
  GND是地
  VCC是电源
  NC就是没有连接
  UART通用异步收发传输器（Universal Asynchronous Receiver/Transmitter)是一种异步收发传输器，是电脑硬件的一部分。它将要传输的资料在串行通信与并行通信之间加以转换。


开发环境::

  LabVIEW
  Keil C51

设备相关术语
============

* 北向接口：提供给其他厂家或运营商进行接入和管理的接口，即向上提供的接口
* 南向接口：管理其他厂家网管或设备的接口，即向下提供的接口

A northbound interface is an interface that conceptualizes lower level details. It interfaces to higher level layers and is normally drawn at the top of an architectural overview.
A southbound interface decomposes concepts in the technical details, mostly specific to a single component of the architecture. Southbound interfaces are drawn at the bottom of an architectural overview.
Northbound interfaces normally talk to southbound interfaces of higher level components and vice versa.

从英文定义可以看出来::

    1.北向接口是某个模块的顶层抽象接口
    2.南向接口是某个模块之内部子模块的接口
    3.北向接口因处于架构图的顶部而得名,南向接口则因处于架构图的底部而得名,所谓上北下南
    4.另外,北向和南向也是相对的,相对于更顶级的模块,某个模块的北向接口就相对来说是南向接口了





