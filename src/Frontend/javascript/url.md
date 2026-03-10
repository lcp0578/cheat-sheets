## 监听URL的变化
- 无刷新改变路由的两种方法
	- 通过hash改变路由

			window.location.hash='edit'
	效果

		http://xxxx/#edit
	- 通过history改变路由
		- `history.back()`: 返回浏览器会话历史中的上一页，跟浏览器的回退按钮功能相同
		- `history.forward()`:指向浏览器会话历史中的下一页，跟浏览器的前进按钮相同
		- `history.go()`: 可以跳转到浏览器会话历史中的指定的某一个记录页
		- `history.pushState()`可以将给定的数据压入到浏览器会话历史栈中，该方法接收3个参数，对象，title和一串url。pushState后会改变当前页面url
		- `history.replaceState()`将当前的会话页面的url替换成指定的数据，replaceState后也会改变当前页面的url
- 监听url变化
	- 监听hash变化
		- 通过hash改变了url，会触发hashchange事件，只要监听hashchange事件，就能捕获到通过hash改变url的行为。

				window.onhashchange=function(event){
				  console.log(event);
				}
				//或者
				window.addEventListener('hashchange',function(event){
				   console.log(event);
				})
	- 监听back/forward/go
		- 如果是history.back(),history.forward()、history.go()那么会触发popstate事件

				window.addEventListener('popstate', function(event) {
				     console.log(event);
				})
		- 但是，history.pushState()和history.replaceState()不会触发popstate事件，所以需要自己手动增加事件

	- 监听pushState/replaceState
		- history.replaceState和pushState不会触发popstate事件，那么如何监听这两个行为呢。可以通过在方法里面主动的去触发popstate事件。另一种就是在方法中创建一个新的全局事件。
		- 改造
		
				const _historyWrap = function(type) {
				  const orig = history[type];
				  const e = new Event(type);
				  return function() {
				    const rv = orig.apply(this, arguments);
				    e.arguments = arguments;
				    window.dispatchEvent(e);
				    return rv;
				  };
				};
				history.pushState = _historyWrap('pushState');
				history.replaceState = _historyWrap('replaceState');
		- 监听
		
				window.addEventListener('pushState', function(e) {
				  console.log('change pushState');
				});
				window.addEventListener('replaceState', function(e) {
				  console.log('change replaceState');
				});