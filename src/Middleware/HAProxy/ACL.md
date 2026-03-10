## HAProxy ACL详解
- HAProxy 通过ACL 规则完成两种主要的功能，分别是：
	- 通过设置的ACL 规则检查客户端请求是否合法。如果符合ACL 规则要求，那么就将放行，反正，如果不符合规则，则直接中断请求。
	- 符合ACL 规则要求的请求将被提交到后端的backend 服务器集群，进而实现基于ACL 规则的负载均衡。
- HAProxy 中的ACL 规则经常使用在frontend 段中，使用方法如下：
	
    	acl  自定义的acl名称  acl方法 -i  [匹配的路径或文件]
- 参数说明，其中：
    - acl：是一个关键字，表示定义ACL 规则的开始。后面需要跟上自定义的ACL 名称 。
    - acl 方法 : 这个字段用来定义实现ACL 的方法，HAProxy 定义了很多ACL 方法，经常使用的方法如下：
        - `hdr_beg (host)` #精确匹配主机, 表示以什么开头的域名
        - `hdr_reg (host)` #正则匹配主机,表示以什么开头的域名
        - `path_beg` #匹配路径，表示以什么路径开头
        - `path_end` #匹配路径结尾，表示以什么路径结尾
        - `url_sub` : 表示请求url 中包含什么字符串，例如：`acl file_req url_sub -i killall=`，表示在请求url 中包含`killall=`，则此控制策略返回true
        - `url_dir` : 表示请求url 中存在哪些字符串作为部分地址路径，例如 `acl dir_req url_dir -i allow`，表示在请求url 中存在`allow`作为部分地址路径，则此控制策略返回true,否则返回false
    - `-i`：表示忽略大小写，后面需要跟上匹配的路径或文件或正则表达式。
- 与ACL 规则一起使用的HAProxy 参数还有`use_backend`，`use_backend` 后面需要跟上一个backend 实例名，表示在满足ACL 规则后去请求哪个backend实例，与use_backend 对应的还有`default_backend` 参数，它表示在没有满足ACL 条件的时候默认使用哪个后端backend。
- 配置示例
