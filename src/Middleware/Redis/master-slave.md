## Redis master-slave
- 背景
	- 假设我们生产环境使用了一台redis，redis挂了怎么办？如果等到运维重启redis，并恢复好数据，可能需要花费很长时间。那么在这期间，我们的服务是不可用的，这应该是不能容忍的。假设我们做了主从，主库挂了之后，运维让从库接管，那么服务可以继续运行，正所谓有备无患。

https://segmentfault.com/a/1190000006619753
https://segmentfault.com/a/1190000002692598
http://www.cnblogs.com/chenmh/p/5121849.html
http://www.cnblogs.com/linuxbug/p/5131504.html