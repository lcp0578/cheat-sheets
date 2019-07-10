## RabbitMQ
> RabbitMQ是一个开源的消息代理和队列服务器。

- Exchange的类型
	- direct: 根据交换器名称与routingkey来找队列
	- fanout: 忽略Routingkey，广播模式
	- topic: 根据RoutingKey的设置，来匹配
	- headers
- Client for RabbitMQ
	- [github.com/php-amqplib/php-amqplib](https://github.com/php-amqplib/php-amqplibs) PHP Client
	- [github.com/streadway/amqp](https://github.com/streadway/amqp) Go Client