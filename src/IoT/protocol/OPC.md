## OPC协议
#### OPC概述
- OPC（全称：OLE for Process Control，用于过程控制的OLE）是自动化行业用于数据安全交换的互操作性标准。可以使多个厂商的设备之间无缝传输信息。
- OPC标准于1996年OPC基金会首次发布，其目的是把PLC特定的协议（如modbus，Profibus等）抽象成为标准化的接口，作为“中间人”的角色把其通用的“读”“写”要求转换成具体的设备协议；反之，以便HMI/SCADA系统可以对接控制设备。
- 最初，OPC标准仅限于Windows操作系统。我们普遍说的OPC规范指的是OPC Classic，它是基于OLE（对象连接与嵌入）、COM（部件对象模型） 和DCOM（分布式部件对象模型）技术发展而来，OPC规范是行业供应商、软件开发者和终端用户共同制定的一系列接口、属性和方法标准，在制造业、石油天然气、电力、可再生能源等领域被广泛应用。
- 基于OPC Classic的成功，OPC基金会在2008年推出了新的技术标准 OPC UA（Unified Architecture，统一架构），将各个OPC Classic规范的所有功能集成到一个可扩展的框架中，OPC UA基于TCP/ IP socket传输层，独立于平台并且面向对象，是下一代的OPC标准。

#### OPC结构
- OPC通信采用Client/Server的通信结构，OPC Server由设备生产厂商提供，用于连接他们的PLC、现场总线设备、HMI/SCADA系统等，OPC Client通过OPC标准接口对各OPC Server管理的设备进行操作，由客户端发出数据请求，当OPC Server接收到来自OPC Client的数据请求后会按照要求返回请求的数据。
- OPC的标准规范由“数据访问规范”、“报警与事件规范”、“批量过程规范”、“数据交换规范”、“安全性规范”等一系列标准组成。当前应用较为成熟的OPC规范主要是“数据访问规范”、“报警与事件处理规范”和“历史数据存取规范”。
	- OPC DA（数据访问）：应用最为广泛，可在多个供应商设备和控制应用程序之间实现数据交换，而不存在专有限制。在车间的 PLC、现场的 RTU、桌面 PC 上的软件应用程序等之间，OPC 服务器可以持续进行数据通信。
	- OPC HAD（历史数据访问）：历史数据访问规范定义了可应用于历史数据、时间数据的查询和分析的方法。它定义了很多聚合的行为，是一些在检索数据时可以汇总特定时间域内各数据值的方法。它可以用来创建简单的趋势数据服务器和比较复杂的数据压缩与分析服务器，这些服务器能够提供汇总数据、历史更新、历史数据注释和回填。
	- OPC AE（报警与事件）：是 OPC 基金会制定的用于将各系统之间共享报警和事件信息的方式标准化规范。借助这一标准，AE 客户端可以接收有关设备安全限制、系统错误和其他异常情况的警报和事件通知。

#### OPC对象
- OPC标准规定的OPC对象有三类
	- OPC Server对象维护服务器的相关信息，并作为OPC Group对象的包容器，管理组对象。
	- OPC Group对象作为OPC Item对象的包容器，管理OPC Item对象，向外提供OPC Item对象的数据访问服务。
	- OPC Item对象标识了与OPC服务器中数据的连接，不能直接访问。
#### 相关类库
- [github.com/FreeOpcUa/opcua-asyncio](https://github.com/FreeOpcUa/opcua-asyncio) OPC UA library for python >= 3.7
- [github.com/dathlin/OpcUaHelper](https://github.com/dathlin/OpcUaHelper) 一个通用的opc ua客户端类库，基于.net 4.6.1创建，基于官方opc ua基金会跨平台库创建，封装了节点读写，批量节点读写，引用读取，特性读取，历史数据读取，方法调用，节点订阅，批量订阅等操作。还提供了一个节点浏览器工具。
- [github.com/gopcua/opcua](https://github.com/gopcua/opcua) Native Go OPC-UA library
- [github.com/FreeOpcUa/freeopcua](https://github.com/FreeOpcUa/freeopcua) Open Source C++ OPC-UA Server and Client Library
- [github.com/qt/qtopcua](https://github.com/qt/qtopcua) Qt wrapper for existing OPC UA stacks